import { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import "@particle-academy/react-fancy/styles.css";
import "@particle-academy/fancy-whiteboard/styles.css";
import "@particle-academy/agent-integrations/styles.css";
import { ComposerDemo } from "./ui-demos/ComposerDemo";
import { AgentPresenceDemo } from "./ui-demos/AgentPresenceDemo";

/**
 * Entry point for the React-driven Fancy UI demos. Each demo page renders
 * a `<div data-fancy-demo="<slug>"></div>` placeholder; this script picks
 * up every placeholder on the page and mounts the matching component.
 *
 * Demos that actually integrate MCP read the share-relay base URL from
 * the placeholder's `data-relay-base` attribute (defaults to
 * `/ui/mcp-relay`).
 */

type DemoComponent = (props: { relayBase: string }) => JSX.Element;

const REGISTRY: Record<string, DemoComponent> = {
  composer: ComposerDemo,
  "agent-presence": AgentPresenceDemo,
};

function boot() {
  const nodes = document.querySelectorAll<HTMLElement>("[data-fancy-demo]");
  nodes.forEach((node) => {
    if (node.dataset.fancyMounted === "1") return;
    const slug = node.dataset.fancyDemo;
    if (!slug) return;
    const Component = REGISTRY[slug];
    if (!Component) {
      // eslint-disable-next-line no-console
      console.warn(`[fancy-demo] no registered component for slug="${slug}"`);
      return;
    }
    const relayBase = node.dataset.relayBase ?? "/ui/mcp-relay";
    const root = createRoot(node);
    root.render(
      <StrictMode>
        <Component relayBase={relayBase} />
      </StrictMode>,
    );
    node.dataset.fancyMounted = "1";
  });
}

if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", boot);
} else {
  boot();
}

// Re-mount on Livewire navigation events (the site uses wire:navigate).
document.addEventListener("livewire:navigated", boot);
