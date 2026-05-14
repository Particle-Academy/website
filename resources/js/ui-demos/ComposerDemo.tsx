import { useCallback, useEffect, useMemo, useRef, useState } from "react";
import {
  InputTag,
  textareaAdapter,
} from "@particle-academy/react-fancy";
import {
  MicroMcpServer,
  attachInProcess,
  attachSseRelay,
  createSessionDescriptor,
  buildShareUrl,
  textResult,
  type InProcessTransport,
  type SessionDescriptor,
  type SseRelayTransport,
  type RelayState,
} from "@particle-academy/agent-integrations";

/**
 * ComposerDemo — a controlled chat composer (textarea + InputTag) backed
 * by a MicroMcpServer that external MCP clients (Claude Code, Cursor,
 * any JSON-RPC peer) can drive via the relay broker.
 *
 * Tools exposed:
 *   composer_get_text  — read the current draft
 *   composer_set_text  — replace the draft (the textarea updates live)
 *   composer_append    — append text without clearing
 *   composer_submit    — fire the same code path as the human clicking send
 *   composer_clear     — clear the draft
 *
 * Hit "Start share", paste the URL into your MCP client, and the agent
 * can drive the composer in real time.
 */
export function ComposerDemo({ relayBase }: { relayBase: string }) {
  const [text, setText] = useState("");
  const [log, setLog] = useState<Array<{ at: number; from: "human" | "agent"; body: string }>>([]);
  const [session, setSession] = useState<SessionDescriptor | null>(null);
  const [relayState, setRelayState] = useState<RelayState>("idle");
  const [shareUrl, setShareUrl] = useState<string | null>(null);

  const textRef = useRef(text);
  textRef.current = text;

  const taRef = useRef<HTMLTextAreaElement>(null);
  const adapter = useMemo(() => textareaAdapter(taRef), []);

  const serverRef = useRef<MicroMcpServer | null>(null);
  const inProcRef = useRef<InProcessTransport | null>(null);
  const sseRef = useRef<SseRelayTransport | null>(null);

  const submitDraft = useCallback((from: "human" | "agent") => {
    const body = textRef.current.trim();
    if (!body) return false;
    setLog((cur) => [...cur, { at: Date.now(), from, body }].slice(-50));
    setText("");
    return true;
  }, []);

  // Spin up the MCP server once on mount. Tools talk to local state via
  // refs so the closures always see fresh values without re-registering.
  useEffect(() => {
    const server = new MicroMcpServer({
      info: { name: "fancy-ui-composer", version: "0.1.0" },
      instructions:
        "Drive a chat composer in the browser. Use composer_set_text to overwrite the draft, composer_append to extend it, composer_submit to send.",
    });

    server.registerTool(
      {
        name: "composer_get_text",
        description: "Read the current draft text from the composer.",
        inputSchema: { type: "object", properties: {} },
      },
      () => textResult(textRef.current),
    );

    server.registerTool(
      {
        name: "composer_set_text",
        description: "Replace the composer's draft with the given text.",
        inputSchema: {
          type: "object",
          properties: { text: { type: "string" } },
          required: ["text"],
        },
      },
      (args) => {
        const next = typeof args.text === "string" ? args.text : "";
        setText(next);
        return textResult(`Set ${next.length} chars`);
      },
    );

    server.registerTool(
      {
        name: "composer_append",
        description: "Append text to the existing draft.",
        inputSchema: {
          type: "object",
          properties: { text: { type: "string" } },
          required: ["text"],
        },
      },
      (args) => {
        const add = typeof args.text === "string" ? args.text : "";
        setText((cur) => cur + add);
        return textResult(`Appended ${add.length} chars`);
      },
    );

    server.registerTool(
      {
        name: "composer_clear",
        description: "Clear the composer's draft.",
        inputSchema: { type: "object", properties: {} },
      },
      () => {
        setText("");
        return textResult("cleared");
      },
    );

    server.registerTool(
      {
        name: "composer_submit",
        description: "Submit the current draft (same as the human clicking send).",
        inputSchema: { type: "object", properties: {} },
      },
      () => {
        const ok = submitDraft("agent");
        return textResult(ok ? "submitted" : "nothing to submit — draft is empty");
      },
    );

    inProcRef.current = attachInProcess(server);
    serverRef.current = server;

    return () => {
      if (inProcRef.current) server.detach(inProcRef.current);
      inProcRef.current = null;
    };
  }, [submitDraft]);

  const startShare = useCallback(async () => {
    if (session || !serverRef.current) return;
    const desc = createSessionDescriptor();
    try {
      const csrf =
        (document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement | null)?.content ?? "";
      const reg = await fetch(`${relayBase}/register`, {
        method: "POST",
        headers: {
          "content-type": "application/json",
          "x-csrf-token": csrf,
          accept: "application/json",
        },
        body: JSON.stringify({ session: desc.id, token: desc.token }),
      });
      if (!reg.ok) throw new Error(`registration failed (HTTP ${reg.status})`);
    } catch (e) {
      console.error("[ComposerDemo] register failed", e);
      return;
    }
    const relay = attachSseRelay(serverRef.current, {
      baseUrl: relayBase,
      sessionId: desc.id,
      token: desc.token,
    });
    sseRef.current = relay;
    relay.onStateChange(setRelayState);
    setSession(desc);
    setShareUrl(buildShareUrl(window.location.origin + relayBase, desc));
  }, [session, relayBase]);

  const stopShare = useCallback(async () => {
    if (!session) return;
    const desc = session;
    setSession(null);
    setShareUrl(null);
    setRelayState("closed");
    if (sseRef.current && serverRef.current) {
      serverRef.current.detach(sseRef.current);
    }
    sseRef.current = null;
    const csrf =
      (document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement | null)?.content ?? "";
    await fetch(`${relayBase}/${desc.id}/unregister?token=${encodeURIComponent(desc.token)}`, {
      method: "POST",
      headers: { "x-csrf-token": csrf, accept: "application/json" },
    }).catch(() => {});
  }, [session, relayBase]);

  const onKey = (e: React.KeyboardEvent<HTMLTextAreaElement>) => {
    if (e.key === "Enter" && (e.metaKey || e.ctrlKey)) {
      e.preventDefault();
      submitDraft("human");
    }
  };

  const triggers = useMemo(
    () => ({
      "/": {
        items: [
          { name: "/explain", hint: "explain the selection" },
          { name: "/summarize", hint: "tl;dr what's above" },
          { name: "/translate", hint: "translate to another language" },
        ] as Array<{ name: string; hint: string }>,
        insert: (c: { name: string; hint: string }) => `${c.name} `,
        render: (c: { name: string; hint: string }) => (
          <div>
            <div className="font-mono font-medium text-violet-700">{c.name}</div>
            <div className="text-[11px] text-zinc-500">{c.hint}</div>
          </div>
        ),
        label: "Commands",
      },
      "@": {
        items: [
          { id: "claude", name: "Claude", kind: "agent" },
          { id: "ada", name: "Ada", kind: "person" },
          { id: "readme", name: "README.md", kind: "file" },
        ] as Array<{ id: string; name: string; kind: string }>,
        insert: (m: { id: string; name: string; kind: string }) => `@${m.name} `,
        render: (m: { id: string; name: string; kind: string }) => (
          <div className="flex items-center gap-2">
            <span className="font-medium">{m.name}</span>
            <span className="ml-auto text-[10px] uppercase tracking-wider text-zinc-400">
              {m.kind}
            </span>
          </div>
        ),
        label: "Mentions",
      },
    }),
    [],
  );

  return (
    <div className="space-y-4">
      <div className="rounded-xl border border-zinc-200 bg-white p-4">
        <div className="relative rounded-lg border border-zinc-200 focus-within:border-violet-400 transition-colors">
          <textarea
            ref={taRef}
            value={text}
            onChange={(e) => setText(e.target.value)}
            onKeyDown={onKey}
            placeholder="Type a message — type / for commands, @ for mentions. ⌘/Ctrl+Enter to send."
            rows={4}
            className="block w-full resize-none bg-transparent px-3 py-2.5 text-[14px] leading-relaxed outline-none placeholder:text-zinc-400"
          />
          <InputTag adapter={adapter} triggers={triggers} />
        </div>
        <div className="mt-2 flex items-center justify-between">
          <span className="text-[11px] text-zinc-400 font-mono">{text.length} chars</span>
          <button
            type="button"
            onClick={() => submitDraft("human")}
            disabled={text.trim() === ""}
            className="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-violet-500 hover:bg-violet-600 border border-violet-600 text-white text-[13px] font-medium transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
          >
            Send
            <span className="font-mono text-[11px] opacity-80">⌘↵</span>
          </button>
        </div>
      </div>

      <div className="grid md:grid-cols-2 gap-4">
        <ShareCard
          session={session}
          relayState={relayState}
          shareUrl={shareUrl}
          relayBase={relayBase}
          onStart={startShare}
          onStop={stopShare}
        />
        <LogCard log={log} />
      </div>
    </div>
  );
}

function ShareCard({
  session,
  relayState,
  shareUrl,
  relayBase,
  onStart,
  onStop,
}: {
  session: SessionDescriptor | null;
  relayState: RelayState;
  shareUrl: string | null;
  relayBase: string;
  onStart: () => void;
  onStop: () => void;
}) {
  const status = (() => {
    switch (relayState) {
      case "open":
        return { label: "live", color: "text-emerald-600" };
      case "connecting":
        return { label: "connecting…", color: "text-amber-600" };
      case "error":
        return { label: "error", color: "text-red-600" };
      case "closed":
        return { label: "closed", color: "text-zinc-500" };
      default:
        return { label: "idle", color: "text-zinc-500" };
    }
  })();

  return (
    <div className="rounded-xl border border-zinc-200 bg-white p-4">
      <div className="flex items-center justify-between mb-3">
        <div className="text-[12px] font-semibold uppercase tracking-wider text-zinc-500">
          Connect an agent
        </div>
        <span className={`text-[11px] font-mono ${status.color}`}>{status.label}</span>
      </div>

      {!session ? (
        <>
          <p className="text-[13px] text-zinc-600 leading-relaxed mb-3">
            Start a shared session and an external MCP client can drive this composer in real time —
            paste the inbox URL into Claude Code's <code className="font-mono text-[12px] bg-zinc-100 px-1 py-0.5 rounded">.mcp.json</code> or any
            JSON-RPC MCP peer.
          </p>
          <button
            type="button"
            onClick={onStart}
            className="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-violet-500 hover:bg-violet-600 border border-violet-600 text-white text-[13px] font-medium transition-colors"
          >
            Start share
          </button>
        </>
      ) : (
        <>
          <p className="text-[12px] text-zinc-500 mb-2">
            Session: <span className="font-mono text-zinc-700">{session.id}</span>
          </p>
          {shareUrl && (
            <div className="mb-3">
              <div className="text-[11px] font-semibold uppercase tracking-wider text-zinc-500 mb-1">
                Share URL
              </div>
              <div className="flex items-center gap-2 rounded-md border border-zinc-200 bg-zinc-50 px-2 py-1.5">
                <input
                  readOnly
                  value={shareUrl}
                  className="flex-1 bg-transparent font-mono text-[11px] text-zinc-700 outline-none"
                  onClick={(e) => (e.target as HTMLInputElement).select()}
                />
                <button
                  type="button"
                  onClick={async () => {
                    await navigator.clipboard.writeText(shareUrl);
                  }}
                  className="px-2 py-0.5 rounded bg-white border border-zinc-200 hover:bg-zinc-50 text-[11px] font-medium text-zinc-700"
                >
                  copy
                </button>
              </div>
            </div>
          )}
          <details className="mb-3 text-[12px] text-zinc-600">
            <summary className="cursor-pointer text-zinc-700 font-medium">How to connect</summary>
            <div className="mt-2 space-y-2 leading-relaxed">
              <p>External agents POST JSON-RPC frames to:</p>
              <pre className="font-mono text-[11px] bg-zinc-50 border border-zinc-200 rounded px-2 py-1.5 overflow-x-auto">
                POST {window.location.origin}{relayBase}/{session.id}/inbox?token={session.token}
              </pre>
              <p>…and read outbound frames from:</p>
              <pre className="font-mono text-[11px] bg-zinc-50 border border-zinc-200 rounded px-2 py-1.5 overflow-x-auto">
                GET {window.location.origin}{relayBase}/{session.id}/events?token={session.token}&amp;direction=outbound
              </pre>
              <p>Initialize, then call <code className="font-mono">tools/list</code> to see the <code className="font-mono">composer_*</code> tools.</p>
            </div>
          </details>
          <button
            type="button"
            onClick={onStop}
            className="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-zinc-200 hover:bg-zinc-50 text-zinc-700 text-[13px] font-medium transition-colors"
          >
            Stop share
          </button>
        </>
      )}
    </div>
  );
}

function LogCard({ log }: { log: Array<{ at: number; from: "human" | "agent"; body: string }> }) {
  return (
    <div className="rounded-xl border border-zinc-200 bg-white p-4">
      <div className="text-[12px] font-semibold uppercase tracking-wider text-zinc-500 mb-3">
        Submitted messages
      </div>
      {log.length === 0 ? (
        <p className="text-[12px] italic text-zinc-400">Nothing submitted yet.</p>
      ) : (
        <ul className="space-y-2 max-h-64 overflow-y-auto">
          {log
            .slice()
            .reverse()
            .map((entry) => (
              <li
                key={entry.at}
                className="rounded-md border border-zinc-200 bg-zinc-50 px-2.5 py-1.5 text-[12px]"
              >
                <div className="flex items-center justify-between mb-0.5">
                  <span
                    className={`font-mono text-[10px] uppercase tracking-wider ${
                      entry.from === "agent" ? "text-violet-600" : "text-zinc-500"
                    }`}
                  >
                    {entry.from}
                  </span>
                  <span className="font-mono text-[10px] text-zinc-400">
                    {new Date(entry.at).toLocaleTimeString()}
                  </span>
                </div>
                <div className="whitespace-pre-wrap text-zinc-800">{entry.body}</div>
              </li>
            ))}
        </ul>
      )}
    </div>
  );
}
