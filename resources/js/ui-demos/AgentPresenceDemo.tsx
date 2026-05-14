import { SharedWhiteboard } from "@particle-academy/agent-integrations/components/shared-whiteboard";

/**
 * AgentPresenceDemo — drops the published `<SharedWhiteboard>` component
 * onto the page. SharedWhiteboard already bundles:
 *   - a fancy-whiteboard <Board> with sticky notes, shapes, connectors
 *   - an in-process MicroMcpServer with the whiteboard_* tool surface
 *   - an SSE relay attachment driven by share controls
 *   - an agent panel showing the tool-call feed
 *   - an on-canvas agent cursor + pulsing activity highlight
 *
 * The user clicks "Start share" → gets a session URL → pastes into their
 * MCP client → agent drives the board in real time, with cursor presence
 * and tool-call feed visible to humans in the same surface.
 */
export function AgentPresenceDemo({ relayBase }: { relayBase: string }) {
  return (
    <SharedWhiteboard
      shareBaseUrl={relayBase === "" ? null : relayBase}
      agent={{ id: "claude", name: "Claude", color: "#a855f7" }}
      initialNotes={[
        { id: "n1", x: 80, y: 80, width: 200, height: 140, color: "#fef9c3", text: "Q4 priorities" },
        { id: "n2", x: 320, y: 80, width: 200, height: 140, color: "#dcfce7", text: "Hire 2 ICs" },
        { id: "n3", x: 80, y: 260, width: 200, height: 140, color: "#fae8ff", text: "Land 3 design partners" },
      ]}
      height={520}
    />
  );
}
