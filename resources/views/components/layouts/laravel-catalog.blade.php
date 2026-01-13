<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Laravel Catalog' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased scroll-smooth">
    <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center gap-8">
                <a href="#" class="font-bold text-xl tracking-tight text-red-600 flex items-center gap-2">
                    <flux:icon name="book-open" class="w-6 h-6" />
                    Laravel Catalog
                </a>
            </div>
            
            <nav class="hidden md:flex gap-4">
                <a href="#features" class="text-gray-600 hover:text-red-600 px-3 py-2 font-medium">Features</a>
                <a href="#install" class="text-gray-600 hover:text-red-600 px-3 py-2 font-medium">Installation</a>
                <a href="https://github.com/Particle-Academy/laravel-catalog" class="text-gray-600 hover:text-red-600 px-3 py-2 font-medium">GitHub</a>
            </nav>
            <div class="md:hidden">
                <flux:button variant="ghost" icon="bars-3" />
            </div>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

    <footer class="bg-white border-t border-gray-200 py-12 mt-12">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="font-bold text-xl text-gray-900 mb-4 flex items-center gap-2">
                        <flux:icon name="book-open" class="w-6 h-6 text-red-500" />
                        Laravel Catalog
                    </div>
                    <p class="text-gray-500 max-w-sm">
                        Product and Subscription management catalog with Stripe integration.
                    </p>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 mb-4">Project</h4>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li><a href="https://github.com/Particle-Academy/laravel-catalog" class="hover:text-red-600">GitHub Repository</a></li>
                        <li><a href="#install" class="hover:text-red-600">Installation</a></li>
                        <li><a href="#features" class="hover:text-red-600">Features</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 mb-4">Legal</h4>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li><a href="{{ config('app.url') }}/privacy" class="hover:text-red-600">Privacy Policy</a></li>
                        <li><a href="{{ config('app.url') }}/terms" class="hover:text-red-600">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-100 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
                <div class="mb-4 md:mb-0">
                    &copy; {{ date('Y') }} Laravel Catalog. Open Source Software.
                </div>
                <a href="{{ config('app.url') }}" class="flex items-center gap-2 text-gray-500 hover:text-gray-900 transition-colors group">
                    <span>Built by</span>
                    <img src="{{ config('app.url') }}/images/particle1.png" alt="Particle Academy" class="h-6 w-auto opacity-70 group-hover:opacity-100 transition-all">
                    <span class="font-semibold">Particle Academy</span>
                </a>
            </div>
        </div>
    </footer>

    @fluxScripts
</body>
</html>
