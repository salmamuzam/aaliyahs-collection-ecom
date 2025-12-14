<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
<h1 class="text-lg font-bold text-center text-white-900">CHANGE PASSWORD</h1>
 <p class="mt-4 text-sm text-center text-white">Your new password must be different from previous used passwords.</p>
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="block mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" placeholder="amna@gmail.com" class="block w-full mt-1" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password"  placeholder="••••••••" class="block w-full mt-1" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation"  placeholder="••••••••" class="block w-full mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

              <x-button class="justify-center w-full mt-5">
                    {{ __('Reset Password') }}
                </x-button>
        </form>
    </x-authentication-card>
</x-guest-layout>
