<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf


            {{-- First Name --}}
<h1 class="text-lg font-bold text-center text-white-900">CREATE AN ACCOUNT</h1>
            <p class="mt-4 text-sm text-center text-[#1A1A1A]">Already have an account? <a href="{{ route('login') }}" class="ml-1 font-semibold text-[#1A1A1A] hover:underline whitespace-nowrap">Login here</a></p>
            <div class="grid gap-8 sm:grid-cols-2">
            <div class="mt-4">
                <x-label for="first_name" value="{{ __('First Name') }}" />
                <x-input id="first_name" placeholder="Fathima" class="block w-full mt-1" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
            </div>

            {{-- Last Name --}}

            <div class="mt-4">
                <x-label for="last_name" value="{{ __('Last Name') }}" />
                <x-input id="last_name" placeholder="Amna" class="block w-full mt-1" type="text" name="last_name" :value="old('last_name')" required autocomplete="last_name" />
            </div>
</div>
            {{-- Username --}}
<div class="grid gap-8 sm:grid-cols-2">
            <div class="mt-4">
                <x-label for="username" value="{{ __('Username') }}" />
                <x-input id="username" placeholder="its.amna" class="block w-full mt-1" type="text" name="username" :value="old('username')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" placeholder="amna@gmail.com" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>
</div>
<div class="grid gap-8 sm:grid-cols-2">
            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" placeholder="••••••••"  class="block w-full mt-1" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" placeholder="••••••••" class="block w-full mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
</div>
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

           <x-button class="justify-center w-full mt-4">
                    {{ __('Register') }}
                </x-button>

        </form>
    </x-authentication-card>
</x-guest-layout>
