<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/navbar.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased bg-[#F3EDE8] flex flex-col min-h-screen">
    <x-banner />
    
    {{-- Include the navbar --}}
    @include('layouts.partials.navbar')

    <main class="w-full flex-grow">
        <div class="w-full flex flex-col items-center justify-center py-8 px-4 sm:px-6 lg:px-8">
            
            {{-- Logo Section --}}
            <div class="max-w-[480px] w-full mb-4 text-center">
                <a href="/">
                    <div class="flex justify-center">
                        <x-authentication-card-logo />
                    </div>
                </a>
            </div>

            {{-- Card Section --}}
            <div class="max-w-[480px] w-full p-6 sm:p-8 rounded-md bg-white border border-gray-300 shadow-sm z-10">
                <h1 class="text-[#3E5641] text-center text-2xl font-bold font-playfair mb-2 uppercase">VERIFY EMAIL</h1>
                
                <p class="text-[#1A1A1A] text-center text-base font-sans mb-6 mt-2">
                    Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
                </p>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-600 text-center">
                        A new verification link has been sent to the email address you provided in your profile settings.
                    </div>
                @endif

                <div class="mt-8 flex items-center justify-between flex-col gap-4">
                    <form method="POST" action="{{ route('verification.send') }}" class="w-full">
                        @csrf
                        <button type="submit" class="w-full py-2.5 px-4 text-[15px] font-medium tracking-wide rounded-md text-white bg-[#3E5641] hover:bg-[#2c3e2f] focus:outline-none transition-colors cursor-pointer shadow-md">
                            Resend Verification Email
                        </button>
                    </form>

                    <div class="flex items-center justify-between w-full">
                        <a href="{{ route('profile.show') }}" class="text-sm font-semibold text-[#3E5641] hover:underline font-sans">
                            Edit Profile
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm font-semibold text-[#3E5641] hover:underline font-sans ms-2 bg-transparent border-0 cursor-pointer">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- Include the footer --}}
    @include('layouts.partials.footer')
    
    @livewireScripts
</body>
</html>


