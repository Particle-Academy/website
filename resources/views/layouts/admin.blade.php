<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Primary Meta Tags -->
    <title>{{ config('app.name', 'Particle Academy') }} - Admin</title>
    <meta name="title" content="Particle Academy - Admin Dashboard">
    <meta name="description" content="Administrative dashboard for Particle Academy platform.">
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
<body class="font-sans antialiased bg-gray-50">
    <flux:header container class="bg-gradient-to-r from-cyan-500 to-purple-600 border-b border-cyan-600">
        <flux:sidebar.toggle class="lg:hidden text-white" icon="bars-2" inset="left" />
        
        <flux:brand href="{{ route('admin.dashboard') }}" logo="{{ asset('images/particle1.png') }}" name="Particle Academy" class="max-lg:hidden text-white" />
        
        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item icon="squares-2x2" href="{{ route('admin.dashboard') }}" active="{{ request()->routeIs('admin.dashboard') }}" class="text-white hover:text-cyan-100">
                Dashboard
            </flux:navbar.item>
            
            <flux:navbar.item icon="user-group" href="{{ route('admin.waitinglist') }}" active="{{ request()->routeIs('admin.waitinglist') }}" class="text-white hover:text-cyan-100">
                Waiting List
            </flux:navbar.item>
            
            <flux:navbar.item icon="star" href="{{ route('admin.stories') }}" active="{{ request()->routeIs('admin.stories') }}" class="text-white hover:text-cyan-100">
                Success Stories
            </flux:navbar.item>
            
            <flux:navbar.item icon="building-storefront" href="{{ route('admin.partners') }}" active="{{ request()->routeIs('admin.partners') }}" class="text-white hover:text-cyan-100">
                Partners
            </flux:navbar.item>
        </flux:navbar>
        
        <flux:spacer />
        
        <flux:navbar>
            <flux:navbar.item icon="home" href="{{ url('/') }}" label="View Site" class="text-white hover:text-cyan-100" />
        </flux:navbar>
        
        <flux:dropdown position="bottom" align="end">
            <flux:profile name="{{ auth()->user()->name ?? 'Admin' }}" class="text-white" />
            
            <flux:menu>
                <flux:menu.item icon="user" href="#">My Profile</flux:menu.item>
                <flux:menu.separator />
                <flux:menu.item icon="cog-6-tooth" href="#">Settings</flux:menu.item>
                <flux:menu.separator />
                <flux:menu.item wire:click="$dispatch('logout')" icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </flux:header>
    
    <flux:sidebar stashable sticky class="lg:hidden bg-white border border-gray-200">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />
        
        <flux:brand href="{{ route('admin.dashboard') }}" logo="{{ asset('images/particle1.png') }}" name="Particle Academy" class="px-2" />
        
        <flux:navlist variant="outline">
            <flux:navlist.item icon="squares-2x2" href="{{ route('admin.dashboard') }}" active="{{ request()->routeIs('admin.dashboard') }}">
                Dashboard
            </flux:navlist.item>
            
            <flux:navlist.item icon="user-group" href="{{ route('admin.waitinglist') }}" active="{{ request()->routeIs('admin.waitinglist') }}">
                Waiting List
            </flux:navlist.item>
            
            <flux:navlist.item icon="star" href="{{ route('admin.stories') }}" active="{{ request()->routeIs('admin.stories') }}">
                Success Stories
            </flux:navlist.item>
            
            <flux:navlist.item icon="building-storefront" href="{{ route('admin.partners') }}" active="{{ request()->routeIs('admin.partners') }}">
                Partners
            </flux:navlist.item>
        </flux:navlist>
        
        <flux:spacer />
        
        <flux:navlist variant="outline">
            <flux:navlist.item icon="home" href="{{ url('/') }}">View Site</flux:navlist.item>
            <flux:navlist.item wire:click="$dispatch('logout')" icon="arrow-right-start-on-rectangle">Logout</flux:navlist.item>
        </flux:navlist>
    </flux:sidebar>
    
    <flux:main container>
        <!-- Page Heading -->
        <div class="mb-6">
            <flux:heading size="xl" level="1" class="particle-text-gradient">
                @yield('header', 'Admin Dashboard')
            </flux:heading>
        </div>
        
        <!-- Flash Messages -->
        @if (session()->has('message'))
            <flux:callout variant="success" class="mb-6">
                {{ session('message') }}
            </flux:callout>
        @endif
        
        @if (session()->has('error'))
            <flux:callout variant="error" class="mb-6">
                {{ session('error') }}
            </flux:callout>
        @endif
        
        <!-- Page Content -->
        {{ $slot }}
    </flux:main>
    
    @livewireScripts
    @fluxScripts
</body>
</html>
