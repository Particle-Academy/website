<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Laravel Fun Lab' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
    <style>
        .lab-grid {
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 20px 20px;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased scroll-smooth lab-grid">
    <header class="bg-white/80 border-b border-slate-200 sticky top-0 z-50 backdrop-blur-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="#" class="font-mono font-bold text-xl tracking-tight text-indigo-600 flex items-center gap-2">
                <flux:icon name="trophy" class="w-6 h-6" />
                Laravel Fun Lab
            </a>
            <nav class="hidden md:flex gap-1">
                <a href="#home" class="text-slate-600 hover:text-indigo-600 px-3 py-2 rounded-lg hover:bg-slate-50 transition-colors font-medium">Home</a>
                <a href="#features" class="text-slate-600 hover:text-indigo-600 px-3 py-2 rounded-lg hover:bg-slate-50 transition-colors font-medium">Features</a>
                <a href="#install" class="text-slate-600 hover:text-indigo-600 px-3 py-2 rounded-lg hover:bg-slate-50 transition-colors font-medium">Installation</a>
                <a href="https://github.com/Particle-Academy/laravel-fun-labs" class="text-slate-600 hover:text-indigo-600 px-3 py-2 rounded-lg hover:bg-slate-50 transition-colors font-medium">GitHub</a>
            </nav>
            <div class="md:hidden">
                <flux:button variant="ghost" icon="bars-3" />
            </div>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

    <footer class="bg-slate-900 text-slate-400 py-12 mt-0 border-t border-slate-800">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="mb-4 md:mb-0">
                    <div class="font-mono font-bold text-xl text-white flex items-center gap-2 mb-2">
                        <flux:icon name="trophy" class="w-6 h-6 text-purple-500" />
                        Laravel Fun Lab
                    </div>
                    <p class="text-slate-500 text-sm">Analytics disguised as gamification.</p>
                </div>
                
                <div class="flex flex-col md:flex-row items-center gap-6">
                    <div class="flex gap-4 text-sm">
                        <a href="{{ config('app.url') }}/privacy" class="hover:text-indigo-400 transition-colors">Privacy</a>
                        <a href="{{ config('app.url') }}/terms" class="hover:text-indigo-400 transition-colors">Terms</a>
                    </div>
                    
                    <a href="{{ config('app.url') }}" class="flex items-center gap-2 text-slate-400 hover:text-white transition-colors group">
                        <span>Built by</span>
                        <img src="{{ config('app.url') }}/images/particle1.png" alt="Particle Academy" class="h-6 w-auto grayscale opacity-70 group-hover:grayscale-0 group-hover:opacity-100 transition-all">
                        <span class="font-semibold">Particle Academy</span>
                    </a>
                </div>
            </div>
            <div class="text-center md:text-left text-sm mt-8 text-slate-600">
                &copy; {{ date('Y') }} Laravel Fun Lab. Open Source Software.
            </div>
        </div>
    </footer>

    @fluxScripts
</body>
</html>
