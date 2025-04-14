<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Particle Academy - The Community Accelerator</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/particle1.png') }}" type="image/png">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @vite('resources/css/app.css')
    
    <!-- Scripts -->
    @vite('resources/js/app.js')
    @fluxAppearance
</head>
<body class="min-h-screen bg-gray-50 font-sans text-gray-900 antialiased">
    {{ $slot }}
    
    @livewireScripts
    @fluxScripts
</body>
</html>
