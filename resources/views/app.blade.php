<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Default SEO — pages may override via Inertia's <Head>. --}}
    <title>Particle Academy - The Community Accelerator</title>
    <meta name="title" content="Particle Academy - The Community Accelerator">
    <meta name="description" content="Empowering individuals to transform their lives through community, knowledge, and practical skills. Join our waiting list today.">
    <meta name="keywords" content="community accelerator, entrepreneurship, leadership, digital skills, martial arts, business development, innovation, mentorship">
    <meta name="author" content="Particle Academy">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="Particle Academy - The Community Accelerator">
    <meta property="og:description" content="Empowering individuals to transform their lives through community, knowledge, and practical skills. Join our waiting list today.">
    <meta property="og:image" content="{{ asset('images/particle1.png') }}">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}">
    <meta property="twitter:title" content="Particle Academy - The Community Accelerator">
    <meta property="twitter:description" content="Empowering individuals to transform their lives through community, knowledge, and practical skills. Join our waiting list today.">
    <meta property="twitter:image" content="{{ asset('images/particle1.png') }}">

    <link rel="canonical" href="{{ url('/') }}">
    <link rel="icon" href="{{ asset('images/particle1.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">

    @routes
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.tsx'])
    @inertiaHead
</head>
<body class="min-h-screen bg-gray-50 font-sans text-gray-900 antialiased">
    @inertia

    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "Organization",
        "name": "Particle Academy",
        "description": "The Community Accelerator empowering individuals through mentorship and comprehensive support.",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('images/particle1.png') }}",
        "contactPoint": {
            "@@type": "ContactPoint",
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

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>AOS.init({ once: true });</script>

    @if (app()->environment('production'))
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-9ZCEJMHBR0"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-9ZCEJMHBR0');
    </script>
    @endif
</body>
</html>
