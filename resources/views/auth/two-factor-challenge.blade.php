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
            <div x-data="{ recovery: false }" class="max-w-[480px] w-full p-6 sm:p-8 rounded-md bg-white border border-gray-300 shadow-sm z-10">
                <h1 class="text-[#3E5641] text-center text-2xl font-bold font-playfair mb-2 uppercase">TWO FACTOR CONFIRMATION</h1>

                <div class="mb-4 text-base text-[#1A1A1A] font-sans text-center mt-2" x-show="! recovery">
                    {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
                </div>

                <div class="mb-4 text-base text-[#1A1A1A] font-sans text-center mt-2" x-show="recovery" style="display: none;">
                    {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
                </div>

                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('two-factor.login') }}" class="space-y-6">
                    @csrf

                    {{-- Code --}}
                    <div x-show="! recovery">
                        <label class="text-[#1A1A1A] text-base font-bold font-sans mb-2 block">Code</label>
                        <div class="relative flex items-center">
                            <input name="code" type="text" inputmode="numeric" autofocus x-ref="code" autocomplete="one-time-code"
                                class="w-full text-[#1A1A1A] text-base font-sans border border-slate-300 px-4 py-3 pr-4 rounded-md focus:ring-[#3E5641] focus:border-[#3E5641] outline-none transition-all placeholder-gray-400"
                                placeholder="Enter code" />
                        </div>
                    </div>

                    {{-- Recovery Code --}}
                    <div x-show="recovery" style="display: none;">
                        <label class="text-[#1A1A1A] text-base font-bold font-sans mb-2 block">Recovery Code</label>
                        <div class="relative flex items-center">
                            <input name="recovery_code" type="text" x-ref="recovery_code" autocomplete="one-time-code"
                                class="w-full text-[#1A1A1A] text-base font-sans border border-slate-300 px-4 py-3 pr-4 rounded-md focus:ring-[#3E5641] focus:border-[#3E5641] outline-none transition-all placeholder-gray-400"
                                placeholder="Enter recovery code" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="button" class="text-sm font-semibold text-[#3E5641] hover:underline cursor-pointer bg-transparent border-0"
                                x-show="! recovery"
                                x-on:click="
                                    recovery = true;
                                    $nextTick(() => { $refs.recovery_code.focus() })
                                ">
                            {{ __('Use a recovery code') }}
                        </button>

                        <button type="button" class="text-sm font-semibold text-[#3E5641] hover:underline cursor-pointer bg-transparent border-0"
                                x-show="recovery"
                                style="display: none;"
                                x-on:click="
                                    recovery = false;
                                    $nextTick(() => { $refs.code.focus() })
                                ">
                            {{ __('Use an authentication code') }}
                        </button>
                    </div>

                    <div class="!mt-8">
                        <button type="submit" class="w-full py-2.5 px-4 text-[15px] font-medium tracking-wide rounded-md text-white bg-[#3E5641] hover:bg-[#2c3e2f] focus:outline-none transition-colors cursor-pointer shadow-md">
                            Log in
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    {{-- Include the footer --}}
    @include('layouts.partials.footer')
    
    @livewireScripts
</body>
</html>


