<div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100">
    <div class="container mx-auto px-4 py-12">
        {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
        
        <!-- Hero Unit Component -->
        <livewire:components.hero-unit />
        
        <!-- Mission Statement Section -->
        <div class="mt-16">
            <livewire:components.mission-statement />
        </div>
        
        <!-- Program Overview Section -->
        <div class="mt-16">
            <livewire:components.program-overview />
        </div>
        
        <!-- Key Features Section -->
        <div class="mt-16">
            <livewire:components.key-features />
        </div>
        
        <!-- Success Stories Section -->
        <div class="mt-16">
            <livewire:components.success-stories />
        </div>
        
        <!-- Community Engagement Section -->
        <div class="mt-16">
            <livewire:components.community-engagement />
        </div>
        
        <!-- Waiting List Component -->
        <div class="mt-16">
            <livewire:components.waiting-list />
        </div>
        
        <!-- Additional Content can be added here -->
        <div class="mt-16 text-center text-gray-500 text-sm">
            <p><span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-500 to-purple-600">©</span> {{ date('Y') }} Particle Academy - The Community Accelerator</p>
        </div>
    </div>
</div>
