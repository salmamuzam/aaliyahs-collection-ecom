<x-layouts.guest>
    <div class="brand-auth-wrapper">
        
        {{-- Logo Section --}}
        @include('auth.includes.header')

        {{-- Main Card --}}
        <div class="max-w-[480px] w-full p-6 sm:p-10 brand-card z-10">
            
            {{-- Header Text --}}
            <div class="w-full mb-8 text-center">
                <h1 class="text-brand-green text-2xl md:text-3xl brand-heading-playfair mb-3 uppercase">Sign In</h1>
                <p class="text-brand-black text-base font-sans">
                    Don't have an account?
                    <a href="{{ route('register') }}" wire:navigate class="brand-link ml-1">Register here</a>
                </p>
            </div>
            
            @include('auth.includes.alerts')

            {{-- Standard POST ensures validation errors are 100% reliable and visible --}}
            <form method="POST" action="{{ route('login') }}" novalidate class="space-y-6">
                @csrf

                {{-- Email or Username --}}
                <x-shared.form.input 
                    label="Email or Username" 
                    name="login" 
                    required 
                    :value="old('login')" 
                    autofocus 
                    autocomplete="username" 
                    placeholder="Enter email or username"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </x-form.input>

                {{-- Password --}}
                <x-shared.form.password-input 
                    label="Password" 
                    name="password" 
                    required 
                    autocomplete="current-password" 
                    placeholder="Enter password" 
                />

                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember" type="checkbox" class="h-4 w-4 shrink-0 text-brand-green focus:ring-brand-green border-slate-300 rounded" />
                        <label for="remember-me" class="ml-3 block text-base font-sans text-brand-black">
                            Remember me
                        </label>
                    </div>
                    @if (Route::has('password.request'))
                        <div class="text-base">
                            <a href="{{ route('password.request') }}" wire:navigate class="brand-link">
                                Forgot your password?
                            </a>
                        </div>
                    @endif
                </div>

                <div class="!mt-8">
                    <x-shared.button.primary class="w-full">
                        Sign in
                    </x-button.primary>
                </div>

                @include('auth.includes.social-login')

            </form>
        </div>
    </div>
</x-layouts.guest>
