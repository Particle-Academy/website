<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Primary Meta Tags -->
    <title>{{ config('app.name', 'Particle Academy') }} - Admin</title>
    <meta name="title" content="Particle Academy - The Community Accelerator">
    <meta name="description" content="Empowering individuals to transform their lives through community, knowledge, and practical skills. Join our waiting list today.">
    <meta name="author" content="Particle Academy">
    
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
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-r from-cyan-100 to-purple-100">
        <div class="mb-6">
            <a href="/" class="flex items-center">
                <span class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-cyan-500 to-purple-600">Particle Academy</span>
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-6 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
    
    @livewireScripts
    @fluxScripts
</body>
</html>
