import { useCallback, useEffect, useRef, useState } from "react";
import {
  attachRelay,
  type MicroMcpServer,
  type JsonRpcMessage,
} from "@particle-academy/agent-integrations";

/**
 * useWebRtcRelay — wires a `MicroMcpServer` to a WebRTC data channel so
 * an external MCP client (running a small WebRTC-stdio bridge) can drive
 * the in-page server peer-to-peer. No backend, no SSE, no PHP. The only
 * out-of-band infrastructure is Google's free STUN servers used to
 * discover ICE candidates.
 *
 * Signaling is copy-paste — the page renders the SDP offer for the user
 * to drop into their agent's bridge tool, and accepts the SDP answer
 * back through the same UI.
 *
 *   const relay = useWebRtcRelay(serverRef);
 *   <button onClick={relay.start}>Generate offer</button>
 *   {relay.offer && <textarea readOnly value={relay.offer} />}
 *   <textarea onChange={(e) => relay.setAnswer(e.target.value)} />
 *
 * Connection states reflect the data-channel `readyState` so the host UI
 * can show idle / connecting / open / closed / error without subscribing
 * to the underlying RTCDataChannel directly.
 */

export type WebRtcRelayState = "idle" | "offering" | "awaiting-answer" | "open" | "closed" | "error";

export type WebRtcRelayHandle = {
  state: WebRtcRelayState;
  /** SDP offer to copy into the agent's bridge. Null until `start()` runs. */
  offer: string | null;
  /** Apply the SDP answer the agent pasted back. */
  setAnswer: (answer: string) => Promise<void>;
  /** Begin signaling — create offer, gather ICE, render to `offer`. */
  start: () => Promise<void>;
  /** Tear down — close channel, peer connection, and clear state. */
  stop: () => void;
  /** Last error message, if any. */
  error: string | null;
};

const ICE_SERVERS: RTCIceServer[] = [
  { urls: "stun:stun.l.google.com:19302" },
  { urls: "stun:stun1.l.google.com:19302" },
];

export function useWebRtcRelay(
  serverRef: React.MutableRefObject<MicroMcpServer | null>,
): WebRtcRelayHandle {
  const [state, setState] = useState<WebRtcRelayState>("idle");
  const [offer, setOffer] = useState<string | null>(null);
  const [error, setError] = useState<string | null>(null);

  const pcRef = useRef<RTCPeerConnection | null>(null);
  const dcRef = useRef<RTCDataChannel | null>(null);
  const detachRef = useRef<(() => void) | null>(null);

  const teardown = useCallback(() => {
    detachRef.current?.();
    detachRef.current = null;
    if (dcRef.current) {
      try {
        dcRef.current.close();
      } catch {
        /* ignore */
      }
      dcRef.current = null;
    }
    if (pcRef.current) {
      try {
        pcRef.current.close();
      } catch {
        /* ignore */
      }
      pcRef.current = null;
    }
  }, []);

  // Tear down on unmount.
  useEffect(() => teardown, [teardown]);

  const wireDataChannel = useCallback(
    (channel: RTCDataChannel) => {
      const server = serverRef.current;
      if (!server) return;

      // The relay transport accepts an `attachRelay` shape — sendToRemote
      // pushes frames out the data channel; we feed inbound frames back
      // into the server via deliverFromRemote.
      const transport = attachRelay(server, {
        sendToRemote: (msg: JsonRpcMessage) => {
          if (channel.readyState === "open") {
            channel.send(JSON.stringify(msg));
          }
        },
      });

      const onMessage = (ev: MessageEvent) => {
        try {
          const frame = JSON.parse(ev.data) as JsonRpcMessage;
          transport.deliverFromRemote(frame);
        } catch (e) {
          // eslint-disable-next-line no-console
          console.warn("[webrtc-relay] bad frame", e);
        }
      };
      const onOpen = () => setState("open");
      const onClose = () => setState("closed");
      const onError = () => {
        setState("error");
        setError("data channel error");
      };

      channel.addEventListener("message", onMessage);
      channel.addEventListener("open", onOpen);
      channel.addEventListener("close", onClose);
      channel.addEventListener("error", onError);

      detachRef.current = () => {
        channel.removeEventListener("message", onMessage);
        channel.removeEventListener("open", onOpen);
        channel.removeEventListener("close", onClose);
        channel.removeEventListener("error", onError);
        try {
          server.detach(transport);
        } catch {
          /* ignore */
        }
      };
    },
    [serverRef],
  );

  const start = useCallback(async () => {
    teardown();
    setError(null);
    setOffer(null);
    setState("offering");

    try {
      const pc = new RTCPeerConnection({ iceServers: ICE_SERVERS });
      pcRef.current = pc;

      const dc = pc.createDataChannel("mcp", { ordered: true });
      dcRef.current = dc;
      wireDataChannel(dc);

      // Build offer and wait for ICE gathering to complete so the SDP we
      // show the user contains every candidate. With trickle ICE we'd
      // need an out-of-band channel to ship candidates separately —
      // copy-paste signaling can't do that, so we wait.
      const sdp = await pc.createOffer();
      await pc.setLocalDescription(sdp);
      await iceComplete(pc);

      const local = pc.localDescription;
      if (!local) throw new Error("no local description after ICE");
      setOffer(JSON.stringify(local));
      setState("awaiting-answer");
    } catch (e) {
      teardown();
      setError(e instanceof Error ? e.message : String(e));
      setState("error");
    }
  }, [teardown, wireDataChannel]);

  const setAnswer = useCallback(async (answerText: string) => {
    const pc = pcRef.current;
    if (!pc) {
      setError("call start() before pasting an answer");
      return;
    }
    try {
      const parsed = JSON.parse(answerText.trim()) as RTCSessionDescriptionInit;
      await pc.setRemoteDescription(parsed);
      // state will flip to "open" via the data-channel's onopen handler
    } catch (e) {
      setError(e instanceof Error ? e.message : String(e));
      setState("error");
    }
  }, []);

  return { state, offer, setAnswer, start, stop: teardown, error };
}

function iceComplete(pc: RTCPeerConnection): Promise<void> {
  if (pc.iceGatheringState === "complete") return Promise.resolve();
  return new Promise((resolve) => {
    const check = () => {
      if (pc.iceGatheringState === "complete") {
        pc.removeEventListener("icegatheringstatechange", check);
        resolve();
      }
    };
    pc.addEventListener("icegatheringstatechange", check);
  });
}
