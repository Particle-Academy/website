import { useState } from "react";
import type { WebRtcRelayHandle, WebRtcRelayState } from "./useWebRtcRelay";

/**
 * ConnectAgentCard — the UI surface for WebRTC signaling. Renders the
 * SDP offer for the user to copy into their agent's bridge, accepts the
 * answer back, and reports the connection state in the same vocabulary
 * the rest of the kit uses (idle / connecting / open / closed / error).
 *
 * Until a public `npx @particle-academy/mcp-webrtc-bridge` ships, this
 * card primarily demonstrates the architecture: the demo will connect
 * to any peer that speaks WebRTC + JSON-RPC over a data channel.
 */
export function ConnectAgentCard({
  relay,
  serverName,
  toolPrefix,
}: {
  relay: WebRtcRelayHandle;
  serverName: string;
  toolPrefix: string;
}) {
  const [answerInput, setAnswerInput] = useState("");
  const status = STATE_TO_BADGE[relay.state];

  return (
    <div className="rounded-xl border border-zinc-200 bg-white p-4">
      <div className="flex items-center justify-between mb-3">
        <div className="text-[12px] font-semibold uppercase tracking-wider text-zinc-500">
          Connect an agent
        </div>
        <span className={`text-[11px] font-mono ${status.color}`}>{status.label}</span>
      </div>

      <p className="text-[13px] text-zinc-600 leading-relaxed mb-3">
        Peer-to-peer over a WebRTC data channel. No backend, no relay service — the only
        out-of-band traffic is a STUN lookup. Tools: <code className="font-mono text-[12px] bg-zinc-100 px-1 py-0.5 rounded">{toolPrefix}</code>
      </p>

      {relay.state === "idle" || relay.state === "closed" ? (
        <button
          type="button"
          onClick={relay.start}
          className="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-violet-500 hover:bg-violet-600 border border-violet-600 text-white text-[13px] font-medium transition-colors"
        >
          Generate offer
        </button>
      ) : null}

      {(relay.state === "offering" || relay.state === "awaiting-answer") && relay.offer && (
        <div className="space-y-3">
          <div>
            <div className="flex items-center justify-between mb-1">
              <span className="text-[11px] font-semibold uppercase tracking-wider text-zinc-500">
                1. Offer
              </span>
              <button
                type="button"
                onClick={async () => {
                  if (relay.offer) await navigator.clipboard.writeText(relay.offer);
                }}
                className="px-2 py-0.5 rounded bg-white border border-zinc-200 hover:bg-zinc-50 text-[11px] font-medium text-zinc-700"
              >
                copy
              </button>
            </div>
            <textarea
              readOnly
              value={relay.offer}
              rows={3}
              className="block w-full resize-none rounded-md border border-zinc-200 bg-zinc-50 px-2 py-1.5 font-mono text-[10.5px] text-zinc-700 outline-none"
              onClick={(e) => (e.target as HTMLTextAreaElement).select()}
            />
            <p className="mt-1 text-[11px] text-zinc-500 leading-relaxed">
              Paste this into your agent's WebRTC bridge. The bridge generates an answer; paste it back below.
            </p>
          </div>
          <div>
            <span className="text-[11px] font-semibold uppercase tracking-wider text-zinc-500 mb-1 block">
              2. Answer
            </span>
            <textarea
              value={answerInput}
              onChange={(e) => setAnswerInput(e.target.value)}
              placeholder='{"type":"answer","sdp":"v=0..."}'
              rows={3}
              className="block w-full resize-none rounded-md border border-zinc-200 bg-white px-2 py-1.5 font-mono text-[10.5px] text-zinc-700 outline-none focus:border-violet-400"
            />
            <button
              type="button"
              onClick={async () => {
                if (!answerInput.trim()) return;
                await relay.setAnswer(answerInput);
              }}
              disabled={answerInput.trim() === ""}
              className="mt-2 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-violet-500 hover:bg-violet-600 border border-violet-600 text-white text-[13px] font-medium transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
            >
              Apply answer
            </button>
          </div>
        </div>
      )}

      {relay.state === "open" && (
        <div className="space-y-2">
          <div className="rounded-md border border-emerald-200 bg-emerald-50 px-3 py-2 text-[12.5px] text-emerald-800 leading-relaxed">
            Channel open. Your agent can now call any <code className="font-mono">{toolPrefix}</code> tool against the <strong>{serverName}</strong> server.
          </div>
          <button
            type="button"
            onClick={relay.stop}
            className="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-zinc-200 hover:bg-zinc-50 text-zinc-700 text-[13px] font-medium transition-colors"
          >
            Disconnect
          </button>
        </div>
      )}

      {relay.state === "error" && relay.error && (
        <div className="rounded-md border border-red-200 bg-red-50 px-3 py-2 text-[12.5px] text-red-800 leading-relaxed">
          {relay.error}
          <button
            type="button"
            onClick={relay.start}
            className="block mt-2 text-[12px] underline text-red-700 hover:text-red-900"
          >
            Try again
          </button>
        </div>
      )}

      <details className="mt-4 text-[12px] text-zinc-600">
        <summary className="cursor-pointer text-zinc-700 font-medium">Don't have a WebRTC bridge?</summary>
        <p className="mt-2 leading-relaxed">
          Most MCP clients today (Claude Code, Cursor, Claude Desktop) speak stdio or SSE — not WebRTC. To connect them here you'd need a small bridge process that pipes stdio MCP frames into a data channel. A reference bridge will ship as a separate npm package; until then, this card is an architectural preview — any peer speaking JSON-RPC 2.0 framed messages over a data channel will work today.
        </p>
      </details>
    </div>
  );
}

const STATE_TO_BADGE: Record<WebRtcRelayState, { label: string; color: string }> = {
  idle: { label: "idle", color: "text-zinc-500" },
  offering: { label: "gathering ice…", color: "text-amber-600" },
  "awaiting-answer": { label: "awaiting answer", color: "text-amber-600" },
  open: { label: "live", color: "text-emerald-600" },
  closed: { label: "closed", color: "text-zinc-500" },
  error: { label: "error", color: "text-red-600" },
};
