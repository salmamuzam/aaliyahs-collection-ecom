<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{  $title }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/sidebar.js'])


    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased  bg-[#F3EDE8]">
    <x-banner />
    {{-- Include the navbar --}}
    @include('components.layouts.partials.sidebar')
    <!-- Hamburger Menu Button -->
<button id="hamburger" class="fixed top-4 left-4 z-50 p-2 text-white bg-[#004D61] rounded-lg lg:hidden hover:bg-[#822659] transition-colors">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
    </svg>
</button>
<!-- Overlay for mobile -->
<div id="sidebar-overlay" class="fixed inset-0 z-40 hidden bg-black bg-opacity-50 lg:hidden"></div>
    <main class="min-h-screen lg:ml-64 bg-[#F3EDE8]">
        {{ $slot }}
    </main>

    @livewireScripts
</body>

</html>
