<div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100">
    <div class="container mx-auto px-4 py-12">
        <!-- Hero Section -->
        <div class="text-center mb-16">
            <img src="{{ asset('images/particle1.png') }}" alt="Particle Academy Logo" class="mx-auto h-24 md:h-32 mb-6">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 particle-text-gradient">Become a Partner</h1>
            <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto">Partner with us to help Milwaukee lead a new era of exponential, community-driven growth in digital and physical goods and services.</p>
        </div>

        <!-- Partner Benefits Section (placeholder for now) -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                <div class="w-20 h-20 mx-auto rounded-full bg-gradient-to-r from-cyan-400 to-purple-600 mb-4 flex items-center justify-center">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" /></svg>
                </div>
                <h2 class="text-xl font-semibold mb-2">Community Impact</h2>
                <p class="text-gray-600">Help us expand access to life-changing programs and resources for youth and adults.</p>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                <div class="w-20 h-20 mx-auto rounded-full bg-gradient-to-r from-cyan-400 to-purple-600 mb-4 flex items-center justify-center">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2l4-4" /></svg>
                </div>
                <h2 class="text-xl font-semibold mb-2">Brand Visibility</h2>
                <p class="text-gray-600">Showcase your brand to a growing, engaged audience through events, media, and more.</p>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                <div class="w-20 h-20 mx-auto rounded-full bg-gradient-to-r from-cyan-400 to-purple-600 mb-4 flex items-center justify-center">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" /><path stroke-linecap="round" stroke-linejoin="round" d="M8 12l2 2l4-4" /></svg>
                </div>
                <h2 class="text-xl font-semibold mb-2">Legacy Making</h2>
                <p class="text-gray-600">Be part of the legacy in Milwaukee’s next generation of leaders and creators.</p>
            </div>
        </div>

        <div class="mt-16">
            <livewire:components.waiting-list />
        </div>
    </div>
</div>
