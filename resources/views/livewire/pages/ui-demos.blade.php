{{-- Fancy UI Kit — demo index. Curates the 23 design-system previews into
     themed groups; clicking a card opens an iframe-backed single-demo page. --}}

<div class="fancy-ui-page min-h-screen bg-white text-zinc-900 antialiased">
    {{-- Tailwind v4 safelist for dynamic accent classes (mirrors /ui):
         bg-violet-50 text-violet-600 border-violet-100
         bg-indigo-50 text-indigo-600 border-indigo-100
         bg-sky-50 text-sky-600 border-sky-100
         bg-emerald-50 text-emerald-600 border-emerald-100
         bg-amber-50 text-amber-600 border-amber-100
         bg-rose-50 text-rose-600 border-rose-100
         bg-orange-50 text-orange-600 border-orange-100
         bg-red-50 text-red-600 border-red-100
         bg-blue-50 text-blue-600 border-blue-100
         bg-zinc-50 text-zinc-600 border-zinc-100 --}}

    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600;700&family=Geist+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        .fancy-ui-page {
            font-family: 'Geist', ui-sans-serif, system-ui, sans-serif;
            --fui-grad-from: #7dd3fc;
            --fui-grad-via: #818cf8;
            --fui-grad-to: #c4b5fd;
        }
        .fancy-ui-page [data-lucide] svg, .fancy-ui-page i[data-lucide] svg {
            width: 100%; height: 100%; stroke: currentColor; stroke-width: 2;
            fill: none; stroke-linecap: round; stroke-linejoin: round;
        }
        .fui-mono { font-family: 'Geist Mono', ui-monospace, 'SF Mono', Menlo, monospace; }
        .fui-brand-text {
            background: linear-gradient(90deg, var(--fui-grad-from), var(--fui-grad-via), var(--fui-grad-to));
            -webkit-background-clip: text; background-clip: text; color: transparent;
        }
    </style>

    {{-- Topbar (matches /ui chrome) --}}
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
                <span class="px-3 py-1.5 text-[13px] font-medium text-zinc-900 rounded-md bg-zinc-100">Demos</span>
                <a href="https://github.com/Particle-Academy" target="_blank" rel="noreferrer" class="ml-2 inline-flex items-center gap-1.5 px-3 py-1.5 text-[13px] font-medium border border-zinc-200 rounded-md hover:bg-zinc-50 transition-colors">
                    <i data-lucide="github" class="w-3.5 h-3.5"></i>
                    GitHub
                </a>
            </nav>
        </div>
    </header>

    {{-- Hero --}}
    <section class="border-b border-zinc-200">
        <div class="mx-auto max-w-6xl px-6 py-16">
            <div class="fui-mono text-[11px] uppercase tracking-wider text-zinc-500 mb-3">
                <a href="{{ route('ui') }}" class="hover:text-zinc-700">Fancy UI</a> &nbsp;/&nbsp; Demos
            </div>
            <h1 class="text-4xl md:text-5xl font-semibold tracking-tight leading-[1.05] mb-4">
                See the kit <span class="fui-brand-text">in motion</span>.
            </h1>
            <p class="text-lg text-zinc-600 leading-relaxed max-w-3xl">
                Every demo below is a real, live render using the Fancy UI design tokens — same fonts, same palette, same radii as the production components. Where a sandbox version exists, the demo links to the interactive React version too.
            </p>
        </div>
    </section>

    {{-- Sections --}}
    @foreach ($sections as $sectionIndex => $section)
        <section class="border-b border-zinc-200 {{ $sectionIndex % 2 ? 'bg-zinc-50/50' : 'bg-white' }}">
            <div class="mx-auto max-w-6xl px-6 py-16">
                <div class="max-w-2xl mb-8">
                    <div class="fui-mono text-[11px] uppercase tracking-wider text-zinc-500 mb-3">{{ str_pad((string) ($sectionIndex + 1), 2, '0', STR_PAD_LEFT) }} · Section</div>
                    <h2 class="text-2xl md:text-3xl font-semibold tracking-tight mb-3">{{ $section['title'] }}</h2>
                    <p class="text-zinc-600 leading-relaxed">{{ $section['blurb'] }}</p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-3">
                    @foreach ($section['demos'] as $demo)
                        @php($accent = $demo['accent'])
                        <a href="{{ route('ui.demo', $demo['slug']) }}" class="group block rounded-xl border border-zinc-200 bg-white hover:border-zinc-300 hover:shadow-sm transition-all overflow-hidden">
                            {{-- Mini preview thumbnail — iframes the first preview at small size --}}
                            <div class="aspect-[16/9] border-b border-zinc-200 bg-zinc-50 overflow-hidden relative">
                                <iframe
                                    src="{{ asset('ui-previews/' . $demo['previews'][0]) }}"
                                    class="w-[180%] h-[180%] origin-top-left scale-[0.55] pointer-events-none border-0 bg-white"
                                    loading="lazy"
                                    title="{{ $demo['title'] }} preview"
                                ></iframe>
                            </div>
                            <div class="p-4">
                                <div class="flex items-start gap-2.5 mb-2">
                                    <div class="w-7 h-7 rounded-md flex items-center justify-center bg-{{ $accent }}-50 text-{{ $accent }}-600 border border-{{ $accent }}-100 flex-shrink-0">
                                        <i data-lucide="{{ $demo['icon'] }}" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="font-semibold text-[14px] tracking-tight">{{ $demo['title'] }}</div>
                                    </div>
                                    <i data-lucide="arrow-up-right" class="w-3.5 h-3.5 text-zinc-300 group-hover:text-zinc-600 group-hover:-translate-y-0.5 group-hover:translate-x-0.5 transition-all mt-1"></i>
                                </div>
                                <p class="text-[12.5px] text-zinc-600 leading-relaxed line-clamp-3">{{ $demo['blurb'] }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endforeach

    {{-- Footer CTA --}}
    <section class="bg-white">
        <div class="mx-auto max-w-6xl px-6 py-16 grid md:grid-cols-[1fr_auto] gap-8 items-center">
            <div>
                <h2 class="text-2xl font-semibold tracking-tight mb-2">Want the interactive versions?</h2>
                <p class="text-zinc-600 leading-relaxed max-w-xl">
                    Clone <a href="https://github.com/Particle-Academy/pa-ux-sandbox" target="_blank" rel="noreferrer" class="fui-mono text-[14px] text-violet-600 hover:underline">pa-ux-sandbox</a> and run <code class="fui-mono text-[13px] bg-zinc-100 px-1.5 py-0.5 rounded">composer run dev</code> — every demo here has a live React counterpart at <code class="fui-mono text-[13px] bg-zinc-100 px-1.5 py-0.5 rounded">/react-demos/&lt;slug&gt;</code>.
                </p>
            </div>
            <div class="flex items-center gap-2.5">
                <a href="{{ route('ui') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg border border-zinc-200 hover:bg-zinc-50 font-medium text-[14px] transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Back to Fancy UI
                </a>
            </div>
        </div>
    </section>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        if (window.lucide) window.lucide.createIcons();
        document.addEventListener('livewire:navigated', () => window.lucide && window.lucide.createIcons());
    </script>
</div>
