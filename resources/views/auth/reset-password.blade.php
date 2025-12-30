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
                <h1 class="text-[#3E5641] text-center text-2xl font-bold font-playfair mb-6 uppercase">RESET PASSWORD</h1>

                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    {{-- Email --}}
                    <div>
                        <label class="text-[#1A1A1A] text-base font-bold font-sans mb-2 block">Email</label>
                        <div class="relative flex items-center">
                            <input name="email" type="email" required value="{{ old('email', $request->email) }}" autofocus autocomplete="username"
                                class="w-full text-[#1A1A1A] text-base font-sans border border-slate-300 px-4 py-3 pr-12 rounded-md focus:ring-[#3E5641] focus:border-[#3E5641] outline-none transition-all placeholder-gray-400"
                                placeholder="Enter email" />
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 absolute right-4 text-[#bbb]">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                        </div>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="text-[#1A1A1A] text-base font-bold font-sans mb-2 block">Password</label>
                        <div class="relative flex items-center" x-data="{ show: false }">
                            <input name="password" :type="show ? 'text' : 'password'" type="password" required autocomplete="new-password"
                                class="w-full text-[#1A1A1A] text-base font-sans border border-slate-300 px-4 py-3 pr-12 rounded-md focus:ring-[#3E5641] focus:border-[#3E5641] outline-none transition-all placeholder-gray-400"
                                placeholder="Enter password" />
                            <div @click="show = !show" class="absolute right-4 cursor-pointer text-[#bbb] hover:text-[#3E5641] transition-colors">
                                <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                                <svg x-show="show" style="display: none;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label class="text-[#1A1A1A] text-base font-bold font-sans mb-2 block">Confirm Password</label>
                        <div class="relative flex items-center" x-data="{ show: false }">
                            <input name="password_confirmation" :type="show ? 'text' : 'password'" type="password" required autocomplete="new-password"
                                class="w-full text-[#1A1A1A] text-base font-sans border border-slate-300 px-4 py-3 pr-12 rounded-md focus:ring-[#3E5641] focus:border-[#3E5641] outline-none transition-all placeholder-gray-400"
                                placeholder="Confirm password" />
                            <div @click="show = !show" class="absolute right-4 cursor-pointer text-[#bbb] hover:text-[#3E5641] transition-colors">
                                <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                                <svg x-show="show" style="display: none;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="!mt-8">
                        <button type="submit" class="w-full py-2.5 px-4 text-[15px] font-medium tracking-wide rounded-md text-white bg-[#3E5641] hover:bg-[#2c3e2f] focus:outline-none transition-colors cursor-pointer shadow-md">
                            Reset Password
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


