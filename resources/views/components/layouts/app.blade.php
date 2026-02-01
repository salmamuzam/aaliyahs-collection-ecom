<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo/white_logo.png') }}">

    @if (auth()->user()?->user_type === 'admin' && (request()->routeIs('admin.overview') || (request()->routeIs('profile.show') && request('view') === 'admin') || request()->routeIs('categories*') || request()->routeIs('products*') || request()->is('admin*')))
        <title>{{ $title ?? 'Admin Dashboard' }}</title>
        <!-- Fonts -->
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Source+Sans+3:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/sidebar.js', 'resources/js/dropdown.js'])
    @else
        <title>{{ $title ?? 'Aaliyah Collection' }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Source+Sans+3:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/dropdown.js'])
    @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased bg-brand-beige flex flex-col min-h-screen">

    @if (auth()->user()?->user_type === 'admin' && (request()->routeIs('admin.overview') || (request()->routeIs('profile.show') && request('view') === 'admin') || request()->routeIs('categories*') || request()->routeIs('products*') || request()->is('admin*')))
        <!-- Admin Layout Structure -->
        <x-banner /> 
        @include('components.layouts.partials.sidebar')

        <!-- Hamburger Menu Button -->
        <button id="hamburger" class="fixed top-4 left-4 z-50 p-2 text-white bg-brand-teal rounded-lg lg:hidden hover:bg-brand-burgundy transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Overlay for mobile -->
        <div id="sidebar-overlay" class="fixed inset-0 z-40 hidden bg-black bg-opacity-50 lg:hidden"></div>

        <main class="min-h-screen lg:ml-64 bg-brand-beige">
            {{ $slot }}
        </main>

    @else
        <!-- Customer Layout Structure -->
        <x-banner />
        @include('components.layouts.partials.navbar')

        <main class="flex-grow w-full bg-brand-beige">
            {{ $slot }}
        </main>

        @include('components.layouts.partials.footer')
    @endif



    @stack('modals')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @livewireChartsScripts
    @livewireScripts

    {{-- INNOVATION: Global Offline Detector --}}
    <div wire:offline class="fixed top-0 left-0 w-full z-[9999]">
        <div class="bg-red-600 text-white text-center py-2 px-4 shadow-lg font-bold animate-pulse">
            <i class="fa-solid fa-triangle-exclamation mr-2"></i>
            CONNECTION LOST: You are currently offline. Some features may not work until you reconnect.
        </div>
    </div>
</body>

</html>
