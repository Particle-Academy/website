<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Tribe Trip' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
</head>
<body class="bg-stone-50 text-stone-900 font-sans antialiased scroll-smooth">
    <header class="bg-white border-b border-stone-200 sticky top-0 z-50 bg-opacity-95 backdrop-blur-sm">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="#" class="font-bold text-xl tracking-tight text-amber-700 flex items-center gap-2">
                <flux:icon name="globe-alt" class="w-6 h-6" />
                Tribe Trip
            </a>
            <nav class="hidden md:flex gap-1">
                <a href="#home" class="text-stone-600 hover:text-amber-700 px-3 py-2 rounded-lg hover:bg-stone-50 transition-colors">Home</a>
                <a href="#about" class="text-stone-600 hover:text-amber-700 px-3 py-2 rounded-lg hover:bg-stone-50 transition-colors">About</a>
                <a href="#features" class="text-stone-600 hover:text-amber-700 px-3 py-2 rounded-lg hover:bg-stone-50 transition-colors">Features</a>
                <a href="#contact" class="text-stone-600 hover:text-amber-700 px-3 py-2 rounded-lg hover:bg-stone-50 transition-colors">Contact</a>
            </nav>
            <div class="md:hidden">
                <flux:button variant="ghost" icon="bars-3" />
            </div>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

    <footer class="bg-stone-900 text-stone-400 py-12 mt-0 border-t border-stone-800">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="font-bold text-xl text-white mb-4 flex items-center gap-2">
                        <flux:icon name="globe-alt" class="w-6 h-6 text-amber-500" />
                        Tribe Trip
                    </div>
                    <p class="text-stone-500 max-w-sm">
                        Smart resource sharing app for small communities.
                    </p>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#home" class="hover:text-amber-500 transition-colors">Home</a></li>
                        <li><a href="#about" class="hover:text-amber-500 transition-colors">About Us</a></li>
                        <li><a href="#features" class="hover:text-amber-500 transition-colors">How It Works</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-4">Legal</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ config('app.url') }}/privacy" class="hover:text-amber-500 transition-colors">Privacy Policy</a></li>
                        <li><a href="{{ config('app.url') }}/terms" class="hover:text-amber-500 transition-colors">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-stone-800 pt-8 flex flex-col md:flex-row justify-between items-center text-sm">
                <div class="mb-4 md:mb-0">
                    &copy; {{ date('Y') }} Tribe Trip. All rights reserved.
                </div>
                <a href="{{ config('app.url') }}" class="flex items-center gap-2 text-stone-400 hover:text-white transition-colors group">
                    <span>Built by</span>
                    <img src="{{ config('app.url') }}/images/particle1.png" alt="Particle Academy" class="h-6 w-auto grayscale opacity-70 group-hover:grayscale-0 group-hover:opacity-100 transition-all">
                    <span class="font-semibold">Particle Academy</span>
                </a>
            </div>
        </div>
    </footer>

    @fluxScripts
</body>
</html>
