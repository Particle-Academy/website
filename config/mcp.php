<?php

return [
    /*
    |--------------------------------------------------------------------------
    | MCP Relay
    |--------------------------------------------------------------------------
    |
    | The /ui/demos/composer and /ui/demos/agent-presence surfaces host a
    | MicroMcpServer in the browser and need a relay broker to bridge
    | external agents (Claude Code, Cursor, etc.) to that in-page server.
    |
    | The relay itself ships in @particle-academy/agent-integrations@^0.6.0
    | (see `agent-integrations-relay` bin / docs/relay-server.md in that
    | package). Deploy it anywhere a Node container runs and put the URL
    | in MCP_RELAY_BASE_URL — particle.academy doesn't host the broker.
    |
    | When MCP_RELAY_BASE_URL is empty, the demos render with a callout
    | explaining that the relay isn't configured.
    |
    */

    'relay_base_url' => env('MCP_RELAY_BASE_URL', ''),
];
