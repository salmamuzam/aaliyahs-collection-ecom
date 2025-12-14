<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <h1 class="text-lg font-bold text-center text-white-900">RESET YOUR PASSWORD</h1>
            <p class="mt-4 text-sm text-center text-white">Enter your email and we'll send you a link to reset your password.</p>

        @session('status')
            <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
                {{ $value }}
            </div>
        @endsession

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block w-full mt-1" placeholder="amna@gmail.com" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

              <x-button class="justify-center w-full mt-5">
{{ __('Email Password Reset Link') }}
                </x-button>

    
        </form>
    </x-authentication-card>
</x-guest-layout>
