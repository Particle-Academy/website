<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * In-memory MCP relay broker — lets external Model Context Protocol clients
 * connect to in-browser MicroMcpServer instances running in the /ui/demos/*
 * surfaces. Sister to the WhiteboardShareController in the pa-ux-sandbox
 * monorepo; same protocol, just rebranded for the marketing site so the URL
 * shape reflects the broader "any agent-hookable demo" use case.
 *
 * Endpoints (all under /ui/mcp-relay/):
 *
 *   POST /ui/mcp-relay/register
 *     body: { session: <id>, token: <secret> }
 *     effect: claim a session id with a shared secret. Both the browser
 *             host and external agents prove access by presenting the token.
 *
 *   POST /ui/mcp-relay/{session}/inbox?token=…
 *     body: a JSON-RPC frame
 *     effect: enqueue for delivery to all browser SSE subscribers
 *             (direction=inbound).
 *
 *   POST /ui/mcp-relay/{session}/outbox?token=…
 *     body: a JSON-RPC frame
 *     effect: enqueue for delivery to all external agent SSE subscribers
 *             (direction=outbound).
 *
 *   GET  /ui/mcp-relay/{session}/events?token=…&direction=inbound|outbound
 *     response: SSE stream, each pending frame as `event: mcp\ndata: …\n\n`
 *
 *   POST /ui/mcp-relay/{session}/unregister?token=…
 *     effect: tear down the session
 *
 * Storage is Laravel cache (file in dev, redis in prod). Sessions auto-expire
 * after 4h of inactivity; every authenticated touch slides the TTL forward.
 * CSRF-exempt because external agents won't carry session cookies (see
 * bootstrap/app.php).
 */
class McpRelayController extends Controller
{
    private const TTL_SECONDS = 14400; // 4h — refreshed on every authenticated touch.
    private const POLL_INTERVAL_MS = 200;

    /** Inbound frames from external MCP clients → forwarded to all browser subscribers. */
    public function inbox(Request $request, string $session): JsonResponse
    {
        if (! $this->validateToken($session, (string) $request->query('token'))) {
            return response()->json(['error' => 'invalid_token'], 401);
        }

        $payload = $request->getContent();
        if ($payload === '' || ! str_contains($payload, '"jsonrpc"')) {
            return response()->json(['error' => 'invalid_frame'], 400);
        }

        $this->fanOut($session, 'inbound', $payload);

        return response()->json(['ok' => true]);
    }

    /** Outbound frames from the browser-side server → forwarded to all external clients. */
    public function outbox(Request $request, string $session): JsonResponse
    {
        if (! $this->validateToken($session, (string) $request->query('token'))) {
            return response()->json(['error' => 'invalid_token'], 401);
        }

        $payload = $request->getContent();
        if ($payload === '' || ! str_contains($payload, '"jsonrpc"')) {
            return response()->json(['error' => 'invalid_frame'], 400);
        }

        $this->fanOut($session, 'outbound', $payload);

        return response()->json(['ok' => true]);
    }

    /**
     * SSE stream. The `direction` query param decides which side this
     * subscriber is on: `inbound` for browsers (they want to RECEIVE frames
     * from external clients) or `outbound` for external clients (they want
     * to RECEIVE frames the browser-side server sent).
     */
    public function events(Request $request, string $session): StreamedResponse
    {
        $token = (string) $request->query('token');
        if (! $this->validateToken($session, $token)) {
            return response()->stream(
                fn () => print "event: error\ndata: invalid_token\n\n",
                401,
                ['content-type' => 'text/event-stream'],
            );
        }

        $direction = $request->query('direction', 'inbound') === 'outbound' ? 'outbound' : 'inbound';
        $subscriberId = bin2hex(random_bytes(8));

        return response()->stream(function () use ($session, $direction, $subscriberId) {
            @set_time_limit(0);
            @ini_set('output_buffering', 'off');
            @ini_set('zlib.output_compression', '0');

            $key = $this->queueKey($session, $direction, $subscriberId);
            $subsKey = $this->subscribersKey($session, $direction);
            $subs = Cache::get($subsKey, []);
            $subs[$subscriberId] = time();
            Cache::put($subsKey, $subs, self::TTL_SECONDS);

            // Notify the browser when an outbound subscriber (= external agent) joins.
            if ($direction === 'outbound') {
                $this->fanOut($session, 'inbound', json_encode([
                    'jsonrpc' => '2.0',
                    'method' => 'notifications/peer_joined',
                    'params' => ['subscriberId' => $subscriberId, 'ts' => time() * 1000],
                ]));
            }

            echo "retry: 2000\n\n";
            $this->flush();

            $lastBeat = time();
            while (! connection_aborted()) {
                $frames = Cache::pull($key, []);
                foreach ($frames as $frame) {
                    echo "event: mcp\n";
                    echo 'data: '.$frame."\n\n";
                }
                if (! empty($frames)) {
                    $this->flush();
                }
                if ((time() - $lastBeat) >= 15) {
                    echo ": keepalive\n\n";
                    $this->flush();
                    $lastBeat = time();
                }
                usleep(self::POLL_INTERVAL_MS * 1000);
            }

            $subs = Cache::get($subsKey, []);
            unset($subs[$subscriberId]);
            Cache::put($subsKey, $subs, self::TTL_SECONDS);
            Cache::forget($key);

            if ($direction === 'outbound') {
                $this->fanOut($session, 'inbound', json_encode([
                    'jsonrpc' => '2.0',
                    'method' => 'notifications/peer_left',
                    'params' => ['subscriberId' => $subscriberId, 'ts' => time() * 1000],
                ]));
            }
        }, 200, [
            'content-type' => 'text/event-stream',
            'cache-control' => 'no-cache',
            'x-accel-buffering' => 'no',
        ]);
    }

    /** Register a session token. Browsers POST here on share start. */
    public function register(Request $request): JsonResponse
    {
        $data = $request->validate([
            'session' => ['required', 'string', 'regex:/^[A-Za-z0-9_-]{4,64}$/'],
            'token' => ['required', 'string', 'min:16', 'max:128'],
        ]);
        Cache::put($this->tokenKey($data['session']), hash('sha256', $data['token']), self::TTL_SECONDS);

        return response()->json(['ok' => true]);
    }

    /** Unregister a session (host stops sharing). */
    public function unregister(Request $request, string $session): JsonResponse
    {
        if (! $this->validateToken($session, (string) $request->query('token'))) {
            return response()->json(['error' => 'invalid_token'], 401);
        }
        Cache::forget($this->tokenKey($session));

        return response()->json(['ok' => true]);
    }

    private function fanOut(string $session, string $direction, string $payload): void
    {
        $subsKey = $this->subscribersKey($session, $direction);
        $subs = Cache::get($subsKey, []);
        foreach (array_keys($subs) as $subscriberId) {
            $key = $this->queueKey($session, $direction, $subscriberId);
            $existing = Cache::get($key, []);
            $existing[] = $payload;
            Cache::put($key, $existing, self::TTL_SECONDS);
        }
        Cache::put($subsKey, $subs, self::TTL_SECONDS);
    }

    private function validateToken(string $session, string $token): bool
    {
        if ($session === '' || $token === '') {
            return false;
        }
        $key = $this->tokenKey($session);
        $stored = Cache::get($key);
        if ($stored === null) {
            return false;
        }
        if (! hash_equals((string) $stored, hash('sha256', $token))) {
            return false;
        }
        // Slide the TTL forward on every authenticated touch.
        Cache::put($key, $stored, self::TTL_SECONDS);

        return true;
    }

    private function tokenKey(string $session): string
    {
        return "mcp-relay:token:{$session}";
    }

    private function subscribersKey(string $session, string $direction): string
    {
        return "mcp-relay:subs:{$session}:{$direction}";
    }

    private function queueKey(string $session, string $direction, string $subscriberId): string
    {
        return "mcp-relay:queue:{$session}:{$direction}:{$subscriberId}";
    }

    private function flush(): void
    {
        if (function_exists('ob_get_level') && ob_get_level() > 0) {
            @ob_flush();
        }
        @flush();
    }
}
