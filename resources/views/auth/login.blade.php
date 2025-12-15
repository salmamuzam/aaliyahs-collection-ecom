<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 text-sm font-medium text-emerald-600 dark:text-emerald-400">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf
 <h1 class="text-lg font-bold text-center text-white-900">LOG IN TO YOUR ACCOUNT</h1>
            <p class="mt-4 text-sm text-center text-[#1A1A1A]">Don't have an account? <a href="{{ route('register') }}" class="ml-1 font-semibold text-[#1A1A1A] hover:underline whitespace-nowrap">Register here</a></p>

            {{-- Email or Username --}}

            <div class="mt-4">
                <x-label for="login" value="{{ __('Email or Username') }}" />
                <x-input id="login" class="block w-full mt-1" type="text" name="login" :value="old('login')" placeholder="amna@gmail.com or its.amna" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block w-full mt-1" placeholder="••••••••" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">

            </div>

            <div class="flex items-center justify-between gap-4 mt-5">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="text-sm text-gray-600 ms-2">{{ __('Remember me') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif


            </div>
               <x-button class="justify-center w-full mt-5">
                    {{ __('Log in') }}
                </x-button>
                     <div class="flex items-center gap-4 my-4">
            <hr class="w-full border-slate-300" />
            <p class="text-sm text-center text-white-900">OR</p>
            <hr class="w-full border-slate-300" />
          </div>
            <div>
                {{-- Route/Url from web.php --}}
                <a href="{{ url('auth/google') }}">
                    <x-secondary-button aria-label="Log in with Google" class="justify-center w-full">
                        <img src="images/icons/google.png" alt="google" class="w-5 h-5">
                        <p class="ml-4 font-medium text-white">Log in with Google</p>
                    </x-secondary-button>
                </a>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
