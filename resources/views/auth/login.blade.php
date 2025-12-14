<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email or Username --}}

            <div>
                <x-label for="login" value="{{ __('Email or Username') }}" />
                <x-input id="login" class="block w-full mt-1" type="text" name="login" :value="old('login')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="text-sm text-gray-600 ms-2 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
            <div class="mt-4 mb-4">
                {{-- Route/Url from web.php --}}
                <a href="{{ url('auth/google') }}">
                    <x-secondary-button aria-label="Log in with Google" class="justify-center w-full mt-5">
                        <img src="images/icons/google.png" alt="google" class="w-5 h-5">
                        <p class="ml-4 font-medium text-white">Log in with Google</p>
                    </x-secondary-button>
                </a>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
