<div>
    @if($component)
        <livewire:dynamic-component :component="$component" />
    @else
        {{-- Fallback for microsites without specific components yet --}}
        <div class="container mx-auto px-4 py-12">
            <h1 class="text-4xl font-bold text-center mb-8">Microsite: {{ $subdomain }}</h1>
            <p class="text-center text-xl text-gray-600">Coming Soon</p>
        </div>
    @endif
</div>
