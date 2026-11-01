<?php

namespace App\Support;

/**
 * The Fancy kit, as the home page presents it: the kit as a whole, Prism
 * included, and no page per package (owner, 2026-11-01).
 *
 * Every sentence here is taken from a first-party source in the Fancy envelope
 * (Particle-Academy/fancy.agi), read on 2026-11-01. Re-read those sources
 * before changing the copy rather than editing it from memory:
 *
 * - repos/px-ui-sandbox/app/Support/PackageFamily.php: the Fancy Core and Prism
 *   family taglines.
 * - repos/px-ui-sandbox/app/Support/PackageRegistry.php: group and ecosystem of
 *   every package (META), and the per-package taglines the family bodies
 *   summarise.
 * - repos/px-ui-sandbox/resources/js/Pages/Packages/Index.tsx: the group blurbs
 *   (GROUP_META) of the kit's own package listing.
 * - repos/px-ui-sandbox/app/Mcp/Servers/FancyUiRegistry.php: the fancy-ui MCP
 *   server's instructions (the ecosystem and per-language mirrors).
 * - RULES.md in the envelope, "Purpose": Human+ UX.
 * - repos/fancy-ui-cli/README.md and repos/fancy-starter-kit/README.md: the
 *   two commands.
 *
 * No package or component count is typed here, on purpose: the kit's own
 * KitFacts class exists because every typed count went stale, and
 * FancyKitSectionTest fails if one appears.
 */
final class FancyKit
{
    /**
     * @return array{
     *     families: list<array{key: string, title: string, icon: string, tone: string, body: string}>,
     *     prism: array{title: string, eyebrow: string, body: string, capabilities: list<string>, languages: list<string>},
     *     mirrors: array{body: string, languages: list<string>, registries: list<string>, examples: list<string>},
     *     start: list<array{title: string, icon: string, body: string, href: ?string, command: ?string}>
     * }
     */
    public static function toArray(): array
    {
        return [
            'families' => self::families(),
            'prism' => self::prism(),
            'mirrors' => self::mirrors(),
            'start' => self::start(),
        ];
    }

    /** @return list<array{key: string, title: string, icon: string, tone: string, body: string}> */
    private static function families(): array
    {
        return [
            [
                'key' => 'core',
                'title' => 'Fancy Core',
                'icon' => 'layers',
                'tone' => 't-violet',
                'body' => 'The stack every Fancy app starts from: the React primitives, the Inertia bridge (any Inertia backend, not just Laravel), server-state, a new-build detector, and the agent backbone that makes the whole UI agent-driveable.',
            ],
            [
                'key' => 'surfaces',
                'title' => 'Surfaces',
                'icon' => 'layout-dashboard',
                'tone' => 't-sky',
                'body' => 'Rich, controlled UI that humans and agents inhabit together: whiteboard, workflow, spreadsheets, slides, code, terminal, charts, maps and 3D.',
            ],
            [
                'key' => 'server',
                'title' => 'Server capabilities',
                'icon' => 'server',
                'tone' => 't-emerald',
                'body' => 'Headless backends behind the same UI: a Stripe catalog, feature gating and metered quotas, passkey sign-in, server-rendered SEO, and human and agent interaction analytics.',
            ],
            [
                'key' => 'documents',
                'title' => 'Agentic documents',
                'icon' => 'file-text',
                'tone' => 't-amber',
                'body' => 'Read and write real office files from an agent: xlsx, pptx and docx, plus reading, writing and rendering PDF.',
            ],
            [
                'key' => 'human-plus',
                'title' => 'Human+ UX',
                'icon' => 'users-round',
                'tone' => 't-indigo',
                'body' => 'Humans and agents share the same UI and trade control through MCP tool bridges instead of DOM scraping, with an in-page MCP server, agent presence and a share relay.',
            ],
            [
                'key' => 'tooling',
                'title' => 'Tooling',
                'icon' => 'wrench',
                'tone' => 't-rose',
                'body' => 'A CLI that copies component source into your project, an MCP server that serves the documentation to agents, and Git as an agent-driveable surface.',
            ],
        ];
    }

    /** @return array{title: string, eyebrow: string, body: string, capabilities: list<string>, languages: list<string>} */
    private static function prism(): array
    {
        return [
            'title' => 'Prism',
            'eyebrow' => 'The AI and agent layer',
            'body' => 'Prism is the LLM layer the kit builds on, and what makes it an agent platform. A maintained fork of prism-php/prism, it gives you text, structured output and streaming across providers, with per-run spend attribution.',
            'capabilities' => [
                'Durable agent sessions',
                'MCP tools',
                'Memory and semantic recall',
                'A guarded browser',
                'Sandboxed workspaces',
                'Human+ presence on live Fancy surfaces',
                'OpenTelemetry tracing',
                'The rest of the Perplexity API',
            ],
            'languages' => ['PHP', 'Node', 'Python'],
        ];
    }

    /** @return array{body: string, languages: list<string>, registries: list<string>, examples: list<string>} */
    private static function mirrors(): array
    {
        return [
            'body' => 'The React UI is the same on every backend; only the server layer differs. Server capabilities ship as per-language mirror packages where one exists.',
            'languages' => ['React', 'PHP', 'Node', 'Python'],
            'registries' => ['npm', 'Packagist', 'PyPI'],
            'examples' => [
                'The xlsx, pptx and docx writers',
                'The Stripe catalog',
                'Feature gating',
                'The workflow engine',
                'Prism',
            ],
        ];
    }

    /** @return list<array{title: string, icon: string, body: string, href: ?string, command: ?string}> */
    private static function start(): array
    {
        return [
            [
                'title' => 'Browse the kit',
                'icon' => 'compass',
                'body' => 'Packages, components and docs on the kit\'s own site.',
                'href' => 'https://ui.particle.academy',
                'command' => null,
            ],
            [
                'title' => 'Connect your agent',
                'icon' => 'plug',
                'body' => 'The fancy-ui MCP server browses, searches and installs from the registry. Streamable HTTP, no API key.',
                'href' => 'https://ui.particle.academy/mcp',
                'command' => null,
            ],
            [
                'title' => 'Own the source',
                'icon' => 'terminal',
                'body' => 'Copy a component\'s source from the registry into your project.',
                'href' => null,
                'command' => 'npx fancy-cli@latest add card',
            ],
            [
                'title' => 'Start a Laravel app',
                'icon' => 'rocket',
                'body' => 'Laravel, Inertia, React 19 and Tailwind v4 with Fancy Core and auth preinstalled.',
                'href' => null,
                'command' => 'laravel new my-app --using=particle-academy/fancy-starter-kit',
            ],
        ];
    }
}
