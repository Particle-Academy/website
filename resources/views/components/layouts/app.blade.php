<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Primary Meta Tags -->
    <title>Particle Academy - The Community Accelerator</title>
    <meta name="title" content="Particle Academy - The Community Accelerator">
    <meta name="description" content="Empowering individuals to transform their lives through community, knowledge, and practical skills. Join our waiting list today.">
    <meta name="keywords" content="community accelerator, entrepreneurship, leadership, digital skills, martial arts, business development, innovation, mentorship">
    <meta name="author" content="Particle Academy">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="Particle Academy - The Community Accelerator">
    <meta property="og:description" content="Empowering individuals to transform their lives through community, knowledge, and practical skills. Join our waiting list today.">
    <meta property="og:image" content="{{ asset('images/particle1.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}">
    <meta property="twitter:title" content="Particle Academy - The Community Accelerator">
    <meta property="twitter:description" content="Empowering individuals to transform their lives through community, knowledge, and practical skills. Join our waiting list today.">
    <meta property="twitter:image" content="{{ asset('images/particle1.png') }}">
    
    <!-- Canonical link -->
    <link rel="canonical" href="{{ url('/') }}">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/particle1.png') }}" type="image/png">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
    <!-- AOS Animate On Scroll CDN -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />
</head>
<body class="min-h-screen bg-gray-50 font-sans text-gray-900 antialiased">
    {{ $slot }}
    <!-- Additional Content can be added here -->
    <div class="mt-8 mb-16 text-center text-gray-500 text-sm">
        <p><span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-500 to-purple-600">©</span> {{ date('Y') }} Particle Academy - The Community Accelerator</p>
        <flux:navbar class="mt-4 justify-center space-x-8">
            <flux:navbar.item href="{{ route('coaches') }}" class="text-cyan-600 hover:text-purple-600 font-semibold transition-colors">Coaches</flux:navbar.item>
            <flux:navbar.item href="{{ route('partners') }}" class="text-cyan-600 hover:text-purple-600 font-semibold transition-colors">Partners</flux:navbar.item>
        </flux:navbar>
    </div>
   

    <!-- Structured data for rich search results -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "Organization",
        "name": "Particle Academy",
        "description": "The Community Accelerator empowering individuals through mentorship and comprehensive support.",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('images/particle1.png') }}",
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+1-123-456-7890",
            "contactType": "customer service",
            "email": "info@particle.academy"
        },
        "sameAs": [
            "https://facebook.com/particleacademy",
            "https://twitter.com/particleacademy",
            "https://instagram.com/particleacademy"
        ]
    }
    </script>
    <!-- AOS Animate On Scroll CDN -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>AOS.init({ once: true });</script>
    <!-- Google tag (gtag.js) -->
    @if( env('APP_ENV') === 'production' )
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-9ZCEJMHBR0"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-9ZCEJMHBR0');
    </script>
    @endif

    @livewireScripts
    @fluxScripts
</body>
</html>
