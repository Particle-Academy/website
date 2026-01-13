<div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100">
    <div class="container mx-auto px-4 py-12">
        {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
        
        <!-- Hero Unit Component -->
        <livewire:components.hero-unit />
        <div class="mt-16 text-center">
            <span class="block text-xl md:text-2xl font-semibold particle-text-gradient">Making Milwaukee a beacon for exponential growth and direct-to-consumer innovation.</span>
        </div>

        <!-- Microsites Navigation -->
        <div class="mt-12">
            <div class="bg-white rounded-xl shadow-md p-8 border border-gray-100">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900">Explore Particle Academy Projects</h2>
                    <p class="text-gray-500 mt-2">Discover our specialized platforms and community initiatives.</p>
                </div>
                
                <div class="grid md:grid-cols-3 gap-6">
                    <!-- Tribe Trip -->
                    <a href="{{ str_replace('://', '://tribe-trip.', config('app.url')) }}" class="group block p-6 bg-amber-50 rounded-xl hover:shadow-lg transition-all border border-amber-100 hover:border-amber-200">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="bg-white p-2 rounded-lg shadow-sm group-hover:scale-110 transition-transform">
                                <flux:icon name="globe-alt" class="w-6 h-6 text-amber-600" />
                            </div>
                            <h3 class="font-bold text-amber-900">Tribe Trip</h3>
                        </div>
                        <p class="text-sm text-amber-800/80 mb-4">
                            Smart resource sharing app for small communities.
                        </p>
                        <div class="text-amber-600 text-sm font-medium flex items-center group-hover:translate-x-1 transition-transform">
                            Visit Site <flux:icon name="arrow-right" class="w-4 h-4 ml-1" />
                        </div>
                    </a>

                    <!-- Laravel Fun Labs -->
                    <a href="{{ str_replace('://', '://laravel-fun-labs.', config('app.url')) }}" class="group block p-6 bg-indigo-50 rounded-xl hover:shadow-lg transition-all border border-indigo-100 hover:border-indigo-200">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="bg-white p-2 rounded-lg shadow-sm group-hover:scale-110 transition-transform">
                                <flux:icon name="beaker" class="w-6 h-6 text-indigo-600" />
                            </div>
                            <h3 class="font-bold text-indigo-900">Laravel Fun Lab</h3>
                        </div>
                        <p class="text-sm text-indigo-800/80 mb-4">
                            Analytics disguised as gamification. Complete gamification package for Laravel.
                        </p>
                        <div class="text-indigo-600 text-sm font-medium flex items-center group-hover:translate-x-1 transition-transform">
                            Visit Site <flux:icon name="arrow-right" class="w-4 h-4 ml-1" />
                        </div>
                    </a>

                    <!-- Laravel Catalog -->
                    <a href="{{ str_replace('://', '://laravel-catalog.', config('app.url')) }}" class="group block p-6 bg-red-50 rounded-xl hover:shadow-lg transition-all border border-red-100 hover:border-red-200">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="bg-white p-2 rounded-lg shadow-sm group-hover:scale-110 transition-transform">
                                <flux:icon name="book-open" class="w-6 h-6 text-red-600" />
                            </div>
                            <h3 class="font-bold text-red-900">Laravel Catalog</h3>
                        </div>
                        <p class="text-sm text-red-800/80 mb-4">
                            Product and Subscription management catalog with Stripe integration.
                        </p>
                        <div class="text-red-600 text-sm font-medium flex items-center group-hover:translate-x-1 transition-transform">
                            Visit Site <flux:icon name="arrow-right" class="w-4 h-4 ml-1" />
                        </div>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Mission Statement Section -->
        <div class="mt-16">
            <livewire:components.mission-statement />
            
        </div>

        <!-- Program Overview Section -->
        <div class="mt-16 text-center">
            <p class="text-xl md:text-2xl particle-text-gradient font-semibold mb-4">Explore our holistic programs designed to empower Milwaukee’s innovators, entrepreneurs, and changemakers.</p>
            
        </div>
        <div class="mt-16">
            <livewire:components.program-overview />
        </div>
        
        <!-- Waiting List Component -->
        <div id="waiting-list" class="mt-16 text-center">
            <p class="text-xl md:text-2xl particle-text-gradient font-semibold mb-4">Join Milwaukee’s next generation of leaders and creators.</p>
        </div>
        <div class="mt-16">
            <livewire:components.waiting-list />
        </div>

        <!-- Key Features Section -->
        <div class="mt-16 text-center">
            <p class="text-xl md:text-2xl particle-text-gradient font-semibold mb-4 ">Explore the innovative features empowering Milwaukee’s next generation of leaders and creators.</p>
        </div>
        <div class="mt-16">
            <livewire:components.key-features />
        </div>
        
        <!-- Success Stories Section -->
        <div class="mt-16 text-center">
            <p class="text-xl md:text-2xl particle-text-gradient font-semibold mb-4">See how our community members are creating impact and inspiring change across Milwaukee.</p>
        </div>
        <div class="mt-16">
            <livewire:components.success-stories />
        </div>
        
        <!-- Community Engagement Section -->
        <div class="mt-16 text-center">
            <p class="text-xl md:text-2xl particle-text-gradient font-semibold mb-4">Discover how we’re bringing Milwaukee together to support, collaborate, and thrive as a community.</p>
        </div>
        <div class="mt-16">
            <livewire:components.community-engagement />
        </div>
        
        
        
        
    </div>
</div>
