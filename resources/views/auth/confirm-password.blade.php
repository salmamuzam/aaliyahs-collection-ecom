<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>
<h1 class="mb-4 text-lg font-bold text-center text-white">CONFIRM PASSWORD</h1>
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div>
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" placeholder="••••••••" class="block w-full mt-1" type="password" name="password" required autocomplete="current-password" autofocus />
            </div>

              <x-button class="justify-center w-full mt-4">
                    {{ __('Confirm') }}
                </x-button>
        </form>
    </x-authentication-card>
</x-guest-layout>
