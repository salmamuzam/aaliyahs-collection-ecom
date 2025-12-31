<x-layouts.guest>
    <div class="brand-auth-wrapper">
        {{-- Logo Section --}}
        <div class="max-w-[480px] w-full mb-4 text-center">
            <a href="/" wire:navigate>
                <div class="flex justify-center transition-all duration-300 hover:scale-105 active:scale-95">
                    <x-authentication-card-logo />
                </div>
            </a>
        </div>

        {{-- Card Section --}}
        <div class="max-w-[480px] w-full p-6 sm:p-10 brand-card z-10" x-data="{ loading: false }">
            <h1 class="text-brand-green text-center text-2xl font-bold font-playfair mb-6 uppercase">RESET PASSWORD</h1>

            @include('auth.includes.alerts')

            <form method="POST" action="{{ route('password.update') }}" novalidate @submit="loading = true" class="space-y-6">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                {{-- Email --}}
                <x-form.input label="Email" name="email" type="email" required :value="old('email', $request->email)" autofocus autocomplete="username" placeholder="Enter email">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                </x-form.input>

                {{-- Password --}}
                <x-form.password-input label="Password" name="password" required autocomplete="new-password" placeholder="Enter password" />

                {{-- Confirm Password --}}
                <x-form.password-input 
                    label="Confirm Password" 
                    name="password_confirmation" 
                    required 
                    autocomplete="new-password" 
                    placeholder="Confirm password" 
                />

                <div class="!mt-8">
                    <x-button.primary x-bind:disabled="loading" class="w-full">
                        <span x-show="!loading">Reset Password</span>
                        <span x-show="loading" style="display: none;">Resetting...</span>
                    </x-button.primary>
                </div>
            </form>
        </div>
    </div>
</x-layouts.guest>
