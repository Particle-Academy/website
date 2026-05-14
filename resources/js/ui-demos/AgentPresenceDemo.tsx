import { useEffect, useMemo, useRef, useState } from "react";
import {
  Board,
  StickyNote,
  Shape,
  Connector,
  CursorLayer,
  type StickyNoteItem,
  type ShapeItem,
  type ConnectorItem,
  type Stroke,
  type RemoteCursor,
  type Viewport,
} from "@particle-academy/fancy-whiteboard";
import {
  MicroMcpServer,
  attachInProcess,
  AgentPanel,
  AgentCursor,
  AgentActivityHighlight,
  type AgentActivity,
  type InProcessTransport,
} from "@particle-academy/agent-integrations";
import { registerWhiteboardBridge } from "@particle-academy/agent-integrations/bridges/whiteboard";
import { useWebRtcRelay } from "./useWebRtcRelay";
import { ConnectAgentCard } from "./ConnectAgentCard";

/**
 * AgentPresenceDemo — fancy-whiteboard <Board> wired to a MicroMcpServer
 * via registerWhiteboardBridge, with a WebRTC data channel as the
 * external-agent transport. No PHP / SSE / relay broker — agent peers
 * connect directly to the browser.
 */
const AGENT = { id: "claude", name: "Claude", color: "#a855f7" };

const INITIAL_NOTES: StickyNoteItem[] = [
  { id: "n1", x: 80, y: 80, width: 200, height: 140, color: "#fef9c3", text: "Q4 priorities" },
  { id: "n2", x: 320, y: 80, width: 200, height: 140, color: "#dcfce7", text: "Hire 2 ICs" },
  { id: "n3", x: 80, y: 260, width: 200, height: 140, color: "#fae8ff", text: "Land 3 design partners" },
];

export function AgentPresenceDemo(_: { relayBase: string }) {
  const [notes, setNotes] = useState<StickyNoteItem[]>(INITIAL_NOTES);
  const [shapes, setShapes] = useState<ShapeItem[]>([]);
  const [connectors, setConnectors] = useState<ConnectorItem[]>([]);
  const [strokes, setStrokes] = useState<Stroke[]>([]);
  const [viewport, setViewport] = useState<Viewport>({ x: 0, y: 0, zoom: 1 });
  const [agentCursor, setAgentCursor] = useState<RemoteCursor | null>(null);
  const [activity, setActivity] = useState<AgentActivity[]>([]);
  const [highlight, setHighlight] = useState<
    | { pulseKey: number; bounds: { x: number; y: number; width: number; height: number } }
    | null
  >(null);

  const stateRefs = useRef({ notes, shapes, connectors, strokes, viewport });
  useEffect(() => {
    stateRefs.current = { notes, shapes, connectors, strokes, viewport };
  }, [notes, shapes, connectors, strokes, viewport]);

  const serverRef = useRef<MicroMcpServer | null>(null);
  const inProcRef = useRef<InProcessTransport | null>(null);

  useEffect(() => {
    const server = new MicroMcpServer({
      info: { name: "fancy-ui-whiteboard", version: "0.2.0" },
      instructions:
        "Collaborative whiteboard. Use whiteboard_* tools to read or modify the board.",
    });
    const bridge = registerWhiteboardBridge(server, {
      adapter: {
        getNotes: () => stateRefs.current.notes,
        setNotes: (next) => setNotes(typeof next === "function" ? next : () => next),
        getShapes: () => stateRefs.current.shapes,
        setShapes: (next) => setShapes(typeof next === "function" ? next : () => next),
        getConnectors: () => stateRefs.current.connectors,
        setConnectors: (next) => setConnectors(typeof next === "function" ? next : () => next),
        getStrokes: () => stateRefs.current.strokes,
        setStrokes: (next) => setStrokes(typeof next === "function" ? next : () => next),
        getViewport: () => stateRefs.current.viewport,
        setViewport,
        setAgentCursor,
      },
      agent: AGENT,
    });

    inProcRef.current = attachInProcess(server);
    serverRef.current = server;

    // Pulse a highlight whenever a tool call returns a structured id we recognise.
    const offMsg = inProcRef.current.onServerMessage((msg) => {
      if (
        msg &&
        typeof msg === "object" &&
        "result" in msg &&
        msg.result &&
        typeof msg.result === "object" &&
        "structuredContent" in msg.result &&
        msg.result.structuredContent &&
        typeof msg.result.structuredContent === "object" &&
        "id" in msg.result.structuredContent
      ) {
        const id = String(msg.result.structuredContent.id);
        requestAnimationFrame(() => pulseFor(id));
      }
      // Lightweight tool log — append the called method name.
      if (msg && typeof msg === "object" && "id" in msg && "result" in msg) {
        // Result of a request — we don't capture the method here; the agent
        // panel's primary feed comes from the agent itself in this demo.
      }
    });

    return () => {
      offMsg();
      bridge.dispose();
      if (inProcRef.current) server.detach(inProcRef.current);
      inProcRef.current = null;
    };
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, []);

  const pulseFor = (id: string) => {
    const note = stateRefs.current.notes.find((n) => n.id === id);
    if (note) {
      setHighlight({
        pulseKey: Date.now(),
        bounds: { x: note.x, y: note.y, width: note.width, height: note.height },
      });
      setActivity((cur) =>
        [...cur.slice(-200), { id: `a_${Date.now()}`, at: Date.now(), kind: "tool", source: AGENT.name, text: `touched ${id}` }],
      );
      return;
    }
    const shape = stateRefs.current.shapes.find((s) => s.id === id);
    if (shape) {
      setHighlight({
        pulseKey: Date.now(),
        bounds: { x: shape.x, y: shape.y, width: shape.width, height: shape.height },
      });
    }
  };

  const relay = useWebRtcRelay(serverRef);

  const cursors: RemoteCursor[] = useMemo(() => [], []);

  return (
    <div className="space-y-4">
      <div className="grid lg:grid-cols-[1fr_320px] gap-4">
        <div
          className="relative rounded-xl border border-zinc-200 bg-white overflow-hidden"
          style={{
            height: 520,
            background:
              "radial-gradient(circle at 1px 1px, rgba(0,0,0,0.07) 1px, transparent 0)",
            backgroundSize: "20px 20px",
          }}
        >
          <Board
            viewport={viewport}
            onViewportChange={setViewport}
            style={{ width: "100%", height: "100%" }}
          >
            {connectors.map((c) => {
              const a = resolveCenter(c.from, notes, shapes);
              const b = resolveCenter(c.to, notes, shapes);
              if (!a || !b) return null;
              return <Connector key={c.id} from={a} to={b} color={c.color ?? "#64748b"} />;
            })}
            {shapes.map((s) => (
              <Shape
                key={s.id}
                item={s}
                onChange={(next) =>
                  setShapes((all) => all.map((x) => (x.id === next.id ? next : x)))
                }
              />
            ))}
            {notes.map((n) => (
              <StickyNote
                key={n.id}
                item={n}
                onChange={(next) =>
                  setNotes((all) => all.map((x) => (x.id === next.id ? next : x)))
                }
              />
            ))}
            <CursorLayer cursors={cursors} />
            {agentCursor && (
              <AgentCursor
                x={agentCursor.x}
                y={agentCursor.y}
                name={agentCursor.name}
                color={agentCursor.color}
              />
            )}
            {highlight && (
              <AgentActivityHighlight
                x={highlight.bounds.x}
                y={highlight.bounds.y}
                width={highlight.bounds.width}
                height={highlight.bounds.height}
                color={AGENT.color}
                pulseKey={highlight.pulseKey}
              />
            )}
          </Board>
        </div>

        <AgentPanel agent={AGENT} activity={activity} onSubmit={() => { /* readonly composer */ }} />
      </div>

      <ConnectAgentCard
        relay={relay}
        serverName="whiteboard"
        toolPrefix="whiteboard_*"
      />
    </div>
  );
}

function resolveCenter(
  ref: ConnectorItem["from"],
  notes: StickyNoteItem[],
  shapes: ShapeItem[],
): { x: number; y: number } | null {
  if (typeof ref === "string") {
    const note = notes.find((n) => n.id === ref);
    if (note) return { x: note.x + note.width / 2, y: note.y + note.height / 2 };
    const shape = shapes.find((s) => s.id === ref);
    if (shape) return { x: shape.x + shape.width / 2, y: shape.y + shape.height / 2 };
    return null;
  }
  return ref;
}
