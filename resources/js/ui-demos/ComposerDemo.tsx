import { useCallback, useEffect, useMemo, useRef, useState } from "react";
import { InputTag, textareaAdapter } from "@particle-academy/react-fancy";
import {
  MicroMcpServer,
  attachInProcess,
  textResult,
  type InProcessTransport,
} from "@particle-academy/agent-integrations";
import { useWebRtcRelay } from "./useWebRtcRelay";
import { ConnectAgentCard } from "./ConnectAgentCard";

/**
 * ComposerDemo — a controlled chat composer (textarea + InputTag) backed
 * by a MicroMcpServer that external MCP clients can drive *peer-to-peer*
 * via a WebRTC data channel. No backend, no relay service: the only
 * out-of-band traffic is to public STUN servers for NAT discovery.
 *
 * Tools exposed:
 *   composer_get_text  — read the current draft
 *   composer_set_text  — replace the draft (the textarea updates live)
 *   composer_append    — append text without clearing
 *   composer_submit    — fire the same code path as the human clicking send
 *   composer_clear     — clear the draft
 */
export function ComposerDemo(_: { relayBase: string }) {
  const [text, setText] = useState("");
  const [log, setLog] = useState<Array<{ at: number; from: "human" | "agent"; body: string }>>([]);

  const textRef = useRef(text);
  textRef.current = text;

  const taRef = useRef<HTMLTextAreaElement>(null);
  const adapter = useMemo(() => textareaAdapter(taRef), []);

  const serverRef = useRef<MicroMcpServer | null>(null);
  const inProcRef = useRef<InProcessTransport | null>(null);

  const submitDraft = useCallback((from: "human" | "agent") => {
    const body = textRef.current.trim();
    if (!body) return false;
    setLog((cur) => [...cur, { at: Date.now(), from, body }].slice(-50));
    setText("");
    return true;
  }, []);

  useEffect(() => {
    const server = new MicroMcpServer({
      info: { name: "fancy-ui-composer", version: "0.2.0" },
      instructions:
        "Drive a chat composer. composer_set_text to overwrite, composer_append to extend, composer_submit to send.",
    });

    server.registerTool(
      {
        name: "composer_get_text",
        description: "Read the current draft text.",
        inputSchema: { type: "object", properties: {} },
      },
      () => textResult(textRef.current),
    );

    server.registerTool(
      {
        name: "composer_set_text",
        description: "Replace the composer draft with the given text.",
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
        description: "Clear the composer draft.",
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

  const relay = useWebRtcRelay(serverRef);

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

  const onKey = (e: React.KeyboardEvent<HTMLTextAreaElement>) => {
    if (e.key === "Enter" && (e.metaKey || e.ctrlKey)) {
      e.preventDefault();
      submitDraft("human");
    }
  };

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
        <ConnectAgentCard
          relay={relay}
          serverName="composer"
          toolPrefix="composer_*"
        />
        <LogCard log={log} />
      </div>
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
