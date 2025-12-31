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
            <h1 class="text-brand-green text-center text-2xl font-bold font-playfair mb-2 uppercase">CONFIRM PASSWORD</h1>
            
            <p class="text-brand-black text-center text-base font-sans mb-6 mt-2">
                This is a secure area of the application. Please confirm your password before continuing.
            </p>

            @include('auth.includes.alerts')

            <form method="POST" action="{{ route('password.confirm') }}" novalidate @submit="loading = true" class="space-y-6">
                @csrf

                {{-- Password --}}
                <x-form.password-input label="Password" name="password" required autocomplete="current-password" autofocus placeholder="Enter password" />

                <div class="!mt-8">
                    <x-button.primary x-bind:disabled="loading">
                        <span x-show="!loading">Confirm</span>
                        <span x-show="loading" style="display: none;">Confirming...</span>
                    </x-button.primary>
                </div>
            </form>
        </div>
    </div>
</x-layouts.guest>
