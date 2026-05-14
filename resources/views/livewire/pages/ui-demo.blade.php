{{-- Single demo page — chrome from the /ui design language wrapped around
     an iframe of one or more design-system preview HTMLs. --}}

<div class="fancy-ui-page min-h-screen bg-white text-zinc-900 antialiased flex flex-col">
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600;700&family=Geist+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        .fancy-ui-page { font-family: 'Geist', ui-sans-serif, system-ui, sans-serif; }
        .fancy-ui-page [data-lucide] svg, .fancy-ui-page i[data-lucide] svg {
            width: 100%; height: 100%; stroke: currentColor; stroke-width: 2;
            fill: none; stroke-linecap: round; stroke-linejoin: round;
        }
        .fui-mono { font-family: 'Geist Mono', ui-monospace, 'SF Mono', Menlo, monospace; }
    </style>

    {{-- Topbar --}}
    <header class="border-b border-zinc-200 bg-white sticky top-0 z-30 backdrop-blur supports-[backdrop-filter]:bg-white/85">
        <div class="mx-auto max-w-6xl px-6 h-14 flex items-center justify-between">
            <a href="{{ route('ui') }}" class="flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg overflow-hidden bg-zinc-950 flex items-center justify-center">
                    <img src="{{ asset('images/fancy-ui-logo.jpg') }}" alt="Fancy UI" class="w-full h-full object-cover">
                </div>
                <span class="font-semibold text-[15px] tracking-tight">fancy-ui</span>
                <span class="fui-mono text-[11px] text-zinc-500 hidden sm:inline">demos</span>
            </a>
            <nav class="flex items-center gap-1">
                <a href="{{ route('ui') }}" class="px-3 py-1.5 text-[13px] font-medium text-zinc-700 hover:text-zinc-900 rounded-md hover:bg-zinc-100 transition-colors">Overview</a>
                <a href="{{ route('ui.demos') }}" class="px-3 py-1.5 text-[13px] font-medium text-zinc-700 hover:text-zinc-900 rounded-md hover:bg-zinc-100 transition-colors">All demos</a>
                <a href="https://github.com/Particle-Academy" target="_blank" rel="noreferrer" class="ml-2 inline-flex items-center gap-1.5 px-3 py-1.5 text-[13px] font-medium border border-zinc-200 rounded-md hover:bg-zinc-50 transition-colors">
                    <i data-lucide="github" class="w-3.5 h-3.5"></i>
                    GitHub
                </a>
            </nav>
        </div>
    </header>

    {{-- Demo header --}}
    <section class="border-b border-zinc-200">
        <div class="mx-auto max-w-6xl px-6 py-10">
            <div class="fui-mono text-[11px] uppercase tracking-wider text-zinc-500 mb-3">
                <a href="{{ route('ui') }}" class="hover:text-zinc-700">Fancy UI</a>
                &nbsp;/&nbsp;
                <a href="{{ route('ui.demos') }}" class="hover:text-zinc-700">Demos</a>
                &nbsp;/&nbsp;
                {{ $demo['section'] }}
            </div>
            <div class="flex items-start justify-between gap-6 flex-wrap">
                <div class="max-w-2xl">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-9 h-9 rounded-lg flex items-center justify-center bg-{{ $demo['accent'] }}-50 text-{{ $demo['accent'] }}-600 border border-{{ $demo['accent'] }}-100">
                            <i data-lucide="{{ $demo['icon'] }}" class="w-4 h-4"></i>
                        </div>
                        <h1 class="text-3xl md:text-4xl font-semibold tracking-tight">{{ $demo['title'] }}</h1>
                    </div>
                    <p class="text-zinc-600 leading-relaxed">{{ $demo['blurb'] }}</p>
                </div>
                @if (!empty($demo['sandbox']))
                    <a href="https://github.com/Particle-Academy/pa-ux-sandbox" target="_blank" rel="noreferrer"
                       class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-blue-500 hover:bg-blue-600 border border-blue-600 text-white font-medium text-[13.5px] transition-colors">
                        <i data-lucide="play" class="w-3.5 h-3.5"></i>
                        Interactive version
                    </a>
                @endif
            </div>
        </div>
    </section>

    {{-- Preview iframes --}}
    <section class="flex-1 bg-zinc-50/60 py-8">
        <div class="mx-auto max-w-6xl px-6 space-y-4">
            @foreach ($demo['previews'] as $i => $preview)
                <div class="rounded-xl border border-zinc-200 bg-white overflow-hidden">
                    <div class="flex items-center justify-between px-4 py-2 border-b border-zinc-200 bg-zinc-50">
                        <span class="fui-mono text-[11px] uppercase tracking-wider text-zinc-500">
                            preview {{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}
                        </span>
                        <a href="{{ asset('ui-previews/' . $preview) }}" target="_blank" rel="noreferrer" class="fui-mono text-[11px] text-zinc-500 hover:text-zinc-700 inline-flex items-center gap-1">
                            Open standalone
                            <i data-lucide="external-link" class="w-3 h-3"></i>
                        </a>
                    </div>
                    <iframe
                        src="{{ asset('ui-previews/' . $preview) }}"
                        class="w-full border-0 bg-white"
                        style="height: 480px;"
                        loading="lazy"
                        title="{{ $demo['title'] }} – {{ $preview }}"
                    ></iframe>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Sandbox call-out --}}
    @if (!empty($demo['sandbox']))
        <section class="border-t border-zinc-200 bg-white">
            <div class="mx-auto max-w-6xl px-6 py-12 grid md:grid-cols-[1fr_auto] gap-8 items-center">
                <div>
                    <h2 class="text-xl md:text-2xl font-semibold tracking-tight mb-2">Run the React version locally</h2>
                    <p class="text-zinc-600 leading-relaxed">
                        The sandbox ships an interactive {{ $demo['title'] }} demo with controlled state, keyboard shortcuts, and the real component code. Clone, install, and visit <code class="fui-mono text-[13px] bg-zinc-100 px-1.5 py-0.5 rounded">{{ $demo['sandbox'] }}</code>.
                    </p>
                </div>
                <a href="https://github.com/Particle-Academy/pa-ux-sandbox" target="_blank" rel="noreferrer"
                   class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg border border-zinc-200 hover:bg-zinc-50 font-medium text-[13.5px] transition-colors">
                    <i data-lucide="github" class="w-4 h-4"></i>
                    pa-ux-sandbox
                </a>
            </div>
        </section>
    @endif

    {{-- Bottom CTA --}}
    <section class="border-t border-zinc-200 bg-zinc-50/60">
        <div class="mx-auto max-w-6xl px-6 py-10 flex items-center justify-between gap-6 flex-wrap">
            <a href="{{ route('ui.demos') }}" class="inline-flex items-center gap-1.5 text-[13.5px] font-medium text-zinc-700 hover:text-zinc-900">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to all demos
            </a>
            <a href="{{ route('ui') }}" class="fui-mono text-[12px] text-zinc-500 hover:text-zinc-700">Back to Fancy UI overview</a>
        </div>
    </section>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        if (window.lucide) window.lucide.createIcons();
        document.addEventListener('livewire:navigated', () => window.lucide && window.lucide.createIcons());
    </script>
</div>
