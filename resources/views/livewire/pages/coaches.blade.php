<div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100">
    <div class="container mx-auto px-4 py-12">
        <!-- Hero Section -->
        <div class="text-center mb-16">
            <a href="/" wire:wire:navigate><img src="{{ asset('images/particle1.png') }}" alt="Particle Academy Logo" class="mx-auto h-24 md:h-32 mb-6"></a>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 particle-text-gradient">Meet Our Coaches</h1>
            <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto">Coaching Milwaukee to thrive in the age of exponential, direct-to-consumer innovation.</p>
        </div>

        <!-- Coaches Info Section (placeholder for now) -->
        <div class="relative">
            <!-- "This could be You" Overlay -->
            <div class="particle-coming-soon-overlay particle-pulse opacity-80 flex text-center justify-center">
                2026 Goal!
                <br />
                This could be You
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                    <div class="w-20 h-20 mx-auto rounded-full bg-gradient-to-r from-cyan-400 to-purple-600 mb-4"></div>
                    <h2 class="text-xl font-semibold mb-2">Coach Name</h2>
                    <p class="text-gray-500 mb-2">Specialty Area</p>
                    <p class="text-gray-600">Short bio or inspirational quote from the coach goes here.</p>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                    <div class="w-20 h-20 mx-auto rounded-full bg-gradient-to-r from-cyan-400 to-purple-600 mb-4"></div>
                    <h2 class="text-xl font-semibold mb-2">Coach Name</h2>
                    <p class="text-gray-500 mb-2">Specialty Area</p>
                    <p class="text-gray-600">Short bio or inspirational quote from the coach goes here.</p>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                    <div class="w-20 h-20 mx-auto rounded-full bg-gradient-to-r from-cyan-400 to-purple-600 mb-4"></div>
                    <h2 class="text-xl font-semibold mb-2">Coach Name</h2>
                    <p class="text-gray-500 mb-2">Specialty Area</p>
                    <p class="text-gray-600">Short bio or inspirational quote from the coach goes here.</p>
                </div>
            </div>
        </div>
        <div class="mt-16">
            <livewire:components.waiting-list />
        </div>
    </div>
</div>
