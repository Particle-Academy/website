{{-- Fancy UI Kit — landing page. Visuals follow the Claude Design handoff:
     zinc neutrals, sky→indigo→violet brand gradient ONLY on the logo and the
     Human+ accent, Lucide line icons via CDN, soft xl radii, 1px borders,
     no gradients on body surfaces, declarative-technical voice. --}}

{{-- Tailwind v4 safelist — dynamic accent classes for package cards and Human+ cards.
     Tailwind scans these blade files for literal class names; the @php @endphp block
     below ensures every accent variant is generated even though the live usage is
     interpolated. Touch this list if a new accent color is added.

     bg-violet-50 text-violet-600 border-violet-100 bg-violet-50 text-violet-700 border-violet-50
     bg-indigo-50 text-indigo-600 border-indigo-100
     bg-sky-50 text-sky-600 border-sky-100
     bg-emerald-50 text-emerald-600 border-emerald-100
     bg-amber-50 text-amber-600 border-amber-100
     bg-rose-50 text-rose-600 border-rose-100
     bg-orange-50 text-orange-600 border-orange-100
     bg-red-50 text-red-600 border-red-100
     bg-blue-50 text-blue-600 border-blue-100
--}}
<div class="fancy-ui-page min-h-screen bg-white text-zinc-900 antialiased">
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600;700&family=Geist+Mono:wght@400;500;600&display=swap" rel="stylesheet">


    <style>
        .fancy-ui-page {
            font-family: 'Geist', ui-sans-serif, system-ui, -apple-system, 'Segoe UI', sans-serif;
            --fui-grad-from: #7dd3fc;
            --fui-grad-via: #818cf8;
            --fui-grad-to: #c4b5fd;
        }
        .fancy-ui-page [data-lucide] svg,
        .fancy-ui-page i[data-lucide] svg {
            width: 100%;
            height: 100%;
            stroke: currentColor;
            stroke-width: 2;
            fill: none;
            stroke-linecap: round;
            stroke-linejoin: round;
        }
        .fui-mono { font-family: 'Geist Mono', ui-monospace, 'SF Mono', Menlo, monospace; }
        .fui-brand-text {
            background: linear-gradient(90deg, var(--fui-grad-from), var(--fui-grad-via), var(--fui-grad-to));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .fui-brand-bg {
            background: linear-gradient(135deg, var(--fui-grad-from), var(--fui-grad-via), var(--fui-grad-to));
        }
        @keyframes fui-pulse {
            0% { box-shadow: 0 0 0 0 rgba(129, 140, 248, .5); }
            70% { box-shadow: 0 0 0 12px rgba(129, 140, 248, 0); }
            100% { box-shadow: 0 0 0 0 rgba(129, 140, 248, 0); }
        }
        .fui-pulse { animation: fui-pulse 1.8s ease-out infinite; }
    </style>

    {{-- ─── Topbar ──────────────────────────────────────────────────────── --}}
    <header class="border-b border-zinc-200 bg-white sticky top-0 z-30 backdrop-blur supports-[backdrop-filter]:bg-white/85">
        <div class="mx-auto max-w-6xl px-6 h-14 flex items-center justify-between">
            <a href="/" class="flex items-center gap-2.5 group">
                <div class="w-7 h-7 rounded-lg overflow-hidden bg-zinc-950 flex items-center justify-center">
                    <img src="{{ asset('images/fancy-ui-logo.jpg') }}" alt="Fancy UI" class="w-full h-full object-cover">
                </div>
                <span class="font-semibold text-[15px] tracking-tight">fancy-ui</span>
                <span class="fui-mono text-[11px] text-zinc-500 hidden sm:inline">by Particle Academy</span>
            </a>
            <nav class="flex items-center gap-1">
                <a href="#packages" class="px-3 py-1.5 text-[13px] font-medium text-zinc-700 hover:text-zinc-900 rounded-md hover:bg-zinc-100 transition-colors">Packages</a>
                <a href="#components" class="px-3 py-1.5 text-[13px] font-medium text-zinc-700 hover:text-zinc-900 rounded-md hover:bg-zinc-100 transition-colors">Components</a>
                <a href="#human-plus" class="px-3 py-1.5 text-[13px] font-medium text-zinc-700 hover:text-zinc-900 rounded-md hover:bg-zinc-100 transition-colors">Human+</a>
                <a href="#demos" class="px-3 py-1.5 text-[13px] font-medium text-zinc-700 hover:text-zinc-900 rounded-md hover:bg-zinc-100 transition-colors">Demos</a>
                <a href="https://github.com/Particle-Academy" target="_blank" rel="noreferrer" class="ml-2 inline-flex items-center gap-1.5 px-3 py-1.5 text-[13px] font-medium border border-zinc-200 rounded-md hover:bg-zinc-50 transition-colors">
                    <i data-lucide="github" class="w-3.5 h-3.5"></i>
                    GitHub
                </a>
            </nav>
        </div>
    </header>

    {{-- ─── Hero ────────────────────────────────────────────────────────── --}}
    <section class="border-b border-zinc-200">
        <div class="mx-auto max-w-6xl px-6 py-20 grid lg:grid-cols-[1fr_320px] gap-12 items-center">
            <div>
                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full border border-zinc-200 bg-zinc-50 fui-mono text-[11px] uppercase tracking-wider text-zinc-600 mb-6">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    10 packages · v3.2.1 latest
                </div>
                <h1 class="text-5xl md:text-6xl font-semibold tracking-tight leading-[1.05] mb-5">
                    UI for <span class="fui-brand-text">humans and agents</span>,<br>
                    sharing the same surface.
                </h1>
                <p class="text-lg text-zinc-600 leading-relaxed max-w-2xl mb-8">
                    A constellation of React, PHP, and 3D packages from Particle Academy built for <strong class="text-zinc-900 font-semibold">Human+ UX</strong> — interfaces where AI agents are first-class participants in the products they help build, not external automations sliding stuff in over an API.
                </p>
                <div class="flex flex-wrap items-center gap-2.5">
                    <a href="#packages" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-blue-500 hover:bg-blue-600 border border-blue-600 text-white font-medium text-[14px] transition-colors">
                        Browse packages
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                    <a href="https://github.com/Particle-Academy/react-fancy" target="_blank" rel="noreferrer" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg border border-zinc-200 hover:bg-zinc-50 text-zinc-900 font-medium text-[14px] transition-colors">
                        <i data-lucide="github" class="w-4 h-4"></i>
                        View on GitHub
                    </a>
                </div>
            </div>

            {{-- Hero side card — agent presence motif --}}
            <div class="rounded-xl border border-zinc-200 bg-white p-3">
                <div class="rounded-lg bg-zinc-50 border border-zinc-200 px-3 py-2 flex items-center justify-between mb-2">
                    <span class="fui-mono text-[10px] uppercase tracking-wider text-zinc-500 flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Claude · tool log
                    </span>
                    <span class="fui-mono text-[10px] text-zinc-400">live</span>
                </div>
                <div class="space-y-1.5">
                    @foreach ([
                        ['t' => '14:22', 'l' => 'whiteboard_add_sticky', 'q' => '"Q4 priorities"'],
                        ['t' => '14:22', 'l' => 'whiteboard_add_connector', 'q' => 'sticky → KPI'],
                        ['t' => '14:23', 'l' => 'sheet_set_cell', 'q' => 'B12 = =SUM(B2:B11)'],
                        ['t' => '14:23', 'l' => 'flow_add_node', 'q' => 'agent.classifier'],
                        ['t' => '14:24', 'l' => 'code_replace_range', 'q' => 'src/app.tsx'],
                    ] as $step)
                        <div class="flex items-center gap-2 px-2 py-1.5 text-[11.5px] border-b border-dashed border-zinc-100 last:border-b-0">
                            <span class="fui-mono text-zinc-400 w-9">{{ $step['t'] }}</span>
                            <span class="fui-mono text-violet-600 flex-shrink-0">{{ $step['l'] }}</span>
                            <span class="text-zinc-500 truncate">{{ $step['q'] }}</span>
                            <span class="fui-mono text-[10px] text-emerald-600 ml-auto">ok</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ─── Human+ UVP ──────────────────────────────────────────────────── --}}
    <section id="human-plus" class="border-b border-zinc-200 bg-zinc-50/50">
        <div class="mx-auto max-w-6xl px-6 py-20">
            <div class="max-w-3xl mb-12">
                <div class="fui-mono text-[11px] uppercase tracking-wider text-zinc-500 mb-3">The thesis</div>
                <h2 class="text-3xl md:text-4xl font-semibold tracking-tight mb-4">
                    Agents should be first-class participants in the products they help build.
                </h2>
                <p class="text-zinc-600 leading-relaxed">
                    Most "AI features" bolt automation onto a UI that wasn't designed for it — agents read snapshots and write blobs over an API while the human watches a spinner. Fancy UI inverts that. Every surface a human operates has a structured tool surface an agent can drive too. They share state, see each other's cursors, undo each other's edits.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-4">
                @foreach ([
                    ['icon' => 'mouse-pointer-2', 'title' => 'Presence on every surface', 'body' => 'Agent cursors and activity highlights show up wherever work is happening — whiteboards, sheets, flows, code. Humans see what the agent is doing in the same place they\'d see another teammate.', 'accent' => 'violet'],
                    ['icon' => 'plug-zap', 'title' => 'MCP-native bridges', 'body' => 'agent-integrations ships a micro-MCP server per session and per-package bridges (whiteboard_*, sheet_*, flow_*, …). External agents connect via stdio, in-process, or SSE relay.', 'accent' => 'indigo'],
                    ['icon' => 'undo-2', 'title' => 'Shared undo, shared truth', 'body' => 'Per-agent undo stacks with reverse-action closures. The human can undo the agent\'s edit; the agent can undo its own. State lives in one place.', 'accent' => 'sky'],
                ] as $card)
                    <div class="rounded-xl border border-zinc-200 bg-white p-5">
                        <div class="w-9 h-9 rounded-lg flex items-center justify-center mb-3 bg-{{ $card['accent'] }}-50 text-{{ $card['accent'] }}-600 border border-{{ $card['accent'] }}-100">
                            <i data-lucide="{{ $card['icon'] }}" class="w-4 h-4"></i>
                        </div>
                        <div class="font-semibold text-[15px] mb-2 tracking-tight">{{ $card['title'] }}</div>
                        <p class="text-[13.5px] text-zinc-600 leading-relaxed">{{ $card['body'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ─── Packages ────────────────────────────────────────────────────── --}}
    <section id="packages" class="border-b border-zinc-200">
        <div class="mx-auto max-w-6xl px-6 py-20">
            <div class="flex items-end justify-between mb-10 gap-6 flex-wrap">
                <div class="max-w-2xl">
                    <div class="fui-mono text-[11px] uppercase tracking-wider text-zinc-500 mb-3">The kit</div>
                    <h2 class="text-3xl md:text-4xl font-semibold tracking-tight mb-3">A family of small, composable packages.</h2>
                    <p class="text-zinc-600 leading-relaxed">Each layer lifts out on its own. Together they form a Human+ workbench. <span class="fui-mono text-[12.5px] text-zinc-500">No monolith. No vendor lock-in.</span></p>
                </div>
                <div class="flex items-center gap-2 text-[12.5px] text-zinc-500 fui-mono">
                    <span class="inline-flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-violet-500"></span> flagship</span>
                    <span class="inline-flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-zinc-300"></span> sibling</span>
                </div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-3">
                @foreach ($packages as $pkg)
                    @php($accent = $pkg['accent'])
                    <a href="{{ $pkg['repo'] }}" target="_blank" rel="noreferrer"
                       class="group block rounded-xl border border-zinc-200 bg-white hover:border-zinc-300 hover:shadow-sm transition-all overflow-hidden">
                        <div class="p-5">
                            <div class="flex items-start gap-3 mb-3">
                                <div class="w-9 h-9 rounded-lg flex items-center justify-center bg-{{ $accent }}-50 text-{{ $accent }}-600 border border-{{ $accent }}-100 flex-shrink-0">
                                    <i data-lucide="{{ $pkg['icon'] }}" class="w-4 h-4"></i>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center gap-1.5 flex-wrap">
                                        <span class="font-mono font-semibold text-[14px] tracking-tight">{{ $pkg['name'] }}</span>
                                        @if (!empty($pkg['flagship']))
                                            <span class="fui-mono text-[9px] uppercase tracking-wider px-1.5 py-0.5 rounded-full bg-violet-50 text-violet-700 border border-violet-100">flagship</span>
                                        @endif
                                    </div>
                                    <div class="fui-mono text-[10.5px] text-zinc-400 mt-0.5">v{{ ltrim($pkg['version'], 'v') }}</div>
                                </div>
                                <i data-lucide="arrow-up-right" class="w-3.5 h-3.5 text-zinc-300 group-hover:text-zinc-600 group-hover:-translate-y-0.5 group-hover:translate-x-0.5 transition-all flex-shrink-0 mt-1"></i>
                            </div>
                            <p class="text-[13px] text-zinc-600 leading-relaxed">{{ $pkg['tagline'] }}</p>
                        </div>
                        @if ($pkg['npm'])
                            <div class="px-5 py-2.5 border-t border-zinc-100 bg-zinc-50/60 fui-mono text-[11px] text-zinc-500 flex items-center justify-between">
                                <span class="truncate">{{ $pkg['npm'] }}</span>
                                <span class="flex items-center gap-1 text-zinc-400">
                                    <i data-lucide="package" class="w-3 h-3"></i>
                                    npm
                                </span>
                            </div>
                        @else
                            <div class="px-5 py-2.5 border-t border-zinc-100 bg-zinc-50/60 fui-mono text-[11px] text-zinc-500 flex items-center justify-between">
                                <span class="truncate">composer / php</span>
                                <span class="flex items-center gap-1 text-zinc-400">
                                    <i data-lucide="package-2" class="w-3 h-3"></i>
                                    packagist
                                </span>
                            </div>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ─── Components ──────────────────────────────────────────────────── --}}
    <section id="components" class="border-b border-zinc-200 bg-zinc-50/50">
        <div class="mx-auto max-w-6xl px-6 py-20">
            <div class="max-w-2xl mb-10">
                <div class="fui-mono text-[11px] uppercase tracking-wider text-zinc-500 mb-3">react-fancy components</div>
                <h2 class="text-3xl md:text-4xl font-semibold tracking-tight mb-3">50+ components, one design language.</h2>
                <p class="text-zinc-600 leading-relaxed">
                    Every component ships dark-mode parity, controlled and uncontrolled APIs, and a tight prop surface. Tailwind v4 default palette — no custom hex. Lucide icons. No emoji in chrome.
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-3">
                @foreach ($componentGroups as $group)
                    <div class="rounded-xl border border-zinc-200 bg-white p-5">
                        <div class="flex items-baseline justify-between mb-2">
                            <h3 class="font-semibold text-[15px] tracking-tight">{{ $group['title'] }}</h3>
                            <span class="fui-mono text-[10.5px] text-zinc-400">{{ count($group['components']) }} components</span>
                        </div>
                        <p class="text-[13px] text-zinc-600 leading-relaxed mb-4">{{ $group['blurb'] }}</p>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach ($group['components'] as $component)
                                <span class="inline-flex items-center fui-mono text-[11.5px] px-2 py-0.5 rounded-md border border-zinc-200 bg-zinc-50 text-zinc-700">{{ $component }}</span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 rounded-xl border border-zinc-200 bg-white p-5 flex items-center justify-between gap-6 flex-wrap">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg flex items-center justify-center bg-zinc-100 text-zinc-700 border border-zinc-200">
                        <i data-lucide="book-open" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <div class="font-semibold text-[14px] tracking-tight">Full component docs</div>
                        <div class="text-[12.5px] text-zinc-500">Every component ships with markdown docs alongside its source.</div>
                    </div>
                </div>
                <a href="https://github.com/Particle-Academy/react-fancy/tree/main/docs" target="_blank" rel="noreferrer"
                   class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg border border-zinc-200 hover:bg-zinc-50 font-medium text-[13px] transition-colors">
                    Read the docs
                    <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- ─── Demos ──────────────────────────────────────────────────────── --}}
    <section id="demos" class="border-b border-zinc-200">
        <div class="mx-auto max-w-6xl px-6 py-20">
            <div class="max-w-2xl mb-10">
                <div class="fui-mono text-[11px] uppercase tracking-wider text-zinc-500 mb-3">Live demos</div>
                <h2 class="text-3xl md:text-4xl font-semibold tracking-tight mb-3">See it work.</h2>
                <p class="text-zinc-600 leading-relaxed">
                    Static demos live on this site at <a href="{{ route('ui.demos') }}" class="fui-mono text-[14px] text-violet-600 hover:underline">/ui/demos</a> — every component rendered with the real design tokens. For the fully interactive React versions, clone the Laravel monorepo at <a href="https://github.com/Particle-Academy/pa-ux-sandbox" target="_blank" rel="noreferrer" class="fui-mono text-[14px] text-violet-600 hover:underline">pa-ux-sandbox</a> and run <code class="fui-mono text-[13px] bg-zinc-100 px-1.5 py-0.5 rounded">composer run dev</code>.
                </p>
            </div>

            <div class="mb-6">
                <a href="{{ route('ui.demos') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-blue-500 hover:bg-blue-600 border border-blue-600 text-white font-medium text-[14px] transition-colors">
                    Browse all demos
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

            <div class="grid md:grid-cols-2 gap-3">
                @foreach ([
                    ['title' => 'Human+ UX (full surface)', 'slug' => 'human-plus', 'body' => 'Whiteboard + form + sheet + chart on one screen — every surface bridged, presence indicators across all of them.', 'icon' => 'layers'],
                    ['title' => 'Whiteboard — You & Claude', 'slug' => 'whiteboard-agent', 'body' => 'Live agent collab: Claude drives the whiteboard via in-process MCP + agent-integrations bridge.', 'icon' => 'users'],
                    ['title' => 'Screens — Agent-driven UX', 'slug' => 'screens-ai', 'body' => 'Tabbed multi-screen shell; agent uses screens_navigate to walk between Intake / Sketchboard / Report.', 'icon' => 'monitor-smartphone'],
                    ['title' => 'Workflow — Agent Editor', 'slug' => 'workflow-agent', 'body' => 'fancy-flow editor + topological runner; agents add nodes, connect ports, trigger runs via flow_* tools.', 'icon' => 'workflow'],
                    ['title' => 'AI Sheets', 'slug' => 'ai-sheets', 'body' => 'fancy-sheets + agent bridge — agents write spreadsheets, you watch the cells light up.', 'icon' => 'table-2'],
                    ['title' => 'InputTag', 'slug' => 'input-tag', 'body' => 'Trigger-driven autocomplete (/, @, #, :) attaching to any text surface via adapters.', 'icon' => 'at-sign'],
                ] as $demo)
                    <div class="rounded-xl border border-zinc-200 bg-white p-5 flex items-start gap-4">
                        <div class="w-9 h-9 rounded-lg flex items-center justify-center bg-zinc-100 text-zinc-700 border border-zinc-200 flex-shrink-0">
                            <i data-lucide="{{ $demo['icon'] }}" class="w-4 h-4"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="font-semibold text-[14.5px] tracking-tight mb-1">{{ $demo['title'] }}</div>
                            <p class="text-[13px] text-zinc-600 leading-relaxed mb-2">{{ $demo['body'] }}</p>
                            <div class="fui-mono text-[11px] text-zinc-500 flex items-center gap-1.5">
                                <i data-lucide="terminal" class="w-3 h-3"></i>
                                /react-demos/{{ $demo['slug'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 rounded-xl border border-zinc-200 bg-zinc-950 text-zinc-100 p-5">
                <div class="fui-mono text-[11px] uppercase tracking-wider text-zinc-400 mb-2">Clone + run</div>
                <pre class="fui-mono text-[13px] leading-relaxed overflow-x-auto"><span class="text-zinc-500">$</span> git clone --recurse-submodules https://github.com/Particle-Academy/pa-ux-sandbox
<span class="text-zinc-500">$</span> cd pa-ux-sandbox &amp;&amp; composer install &amp;&amp; npm install
<span class="text-zinc-500">$</span> composer run dev <span class="text-zinc-500"># server + queue + vite + pail</span></pre>
            </div>
        </div>
    </section>

    {{-- ─── Footer CTA ─────────────────────────────────────────────────── --}}
    <section class="bg-white">
        <div class="mx-auto max-w-6xl px-6 py-20 grid md:grid-cols-[1fr_auto] gap-8 items-center">
            <div>
                <h2 class="text-2xl md:text-3xl font-semibold tracking-tight mb-2">Build with Fancy UI.</h2>
                <p class="text-zinc-600 leading-relaxed max-w-xl">
                    Every package is MIT-licensed and consumed via npm or Composer. Open issues at the repos, or jump straight into the sandbox to see how the pieces fit.
                </p>
            </div>
            <div class="flex items-center gap-2.5">
                <a href="https://github.com/Particle-Academy" target="_blank" rel="noreferrer" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-zinc-900 hover:bg-zinc-800 text-white font-medium text-[14px] transition-colors">
                    <i data-lucide="github" class="w-4 h-4"></i>
                    All repos
                </a>
                <a href="/" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg border border-zinc-200 hover:bg-zinc-50 text-zinc-900 font-medium text-[14px] transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Particle Academy
                </a>
            </div>
        </div>
    </section>

    {{-- Lucide icons via CDN per the design spec's HTML fallback. --}}
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        if (window.lucide) window.lucide.createIcons();
        document.addEventListener('livewire:navigated', () => window.lucide && window.lucide.createIcons());
    </script>
</div>
