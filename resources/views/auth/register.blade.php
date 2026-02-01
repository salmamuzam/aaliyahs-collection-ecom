<x-layouts.guest>
    <div class="brand-auth-wrapper">
        
        {{-- Logo Section --}}
        @include('auth.includes.header')

        {{-- Card Section --}}
        <div class="max-w-4xl w-full p-6 sm:p-10 brand-card z-10">
            
            {{-- Header Text --}}
            <div class="w-full mb-8 text-center">
                <h1 class="text-brand-green text-2xl md:text-3xl brand-heading-playfair mb-3 uppercase">Create Account</h1>
                <p class="text-brand-black text-base font-sans">
                    Already have an account?
                    <a href="{{ route('login') }}" wire:navigate class="brand-link ml-1">Login here</a>
                </p>
            </div>
            
            @include('auth.includes.alerts')

            {{-- Standard POST ensures validation "Required" errors are 100% reliable --}}
            <form method="POST" action="{{ route('register') }}" novalidate class="space-y-6">
                @csrf

                {{-- First Name & Last Name --}}
                <div class="grid gap-4 sm:grid-cols-2">
                    <x-shared.forms.input label="First Name" name="first_name" required :value="old('first_name')" autofocus autocomplete="first_name" placeholder="Enter first name">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </x-form.input>

                    <x-shared.forms.input label="Last Name" name="last_name" required :value="old('last_name')" autocomplete="last_name" placeholder="Enter last name">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </x-form.input>
                </div>

                {{-- Username & Email --}}
                <div class="grid gap-4 sm:grid-cols-2">
                    <x-shared.forms.input label="Username" name="username" required :value="old('username')" autocomplete="username" placeholder="Enter username">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 1 0-2.636 6.364M16.5 12V8.25" />
                        </svg>
                    </x-form.input>

                    <x-shared.forms.input label="Email" name="email" type="email" required :value="old('email')" autocomplete="username" placeholder="Enter email">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                    </x-form.input>
                </div>

                {{-- Password --}}
                <div class="grid gap-4 sm:grid-cols-2">
                    <x-shared.forms.password-input label="Password" name="password" required autocomplete="new-password" placeholder="Enter password" />
                    <x-shared.forms.password-input label="Confirm Password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <label class="flex items-center cursor-pointer group">
                            <div class="relative">
                                <input type="checkbox" name="terms" id="terms" required 
                                    class="peer sr-only" />
                                <div class="w-5 h-5 border-2 border-slate-300 rounded group-hover:border-brand-green peer-checked:bg-brand-green peer-checked:border-brand-green transition-all duration-200"></div>
                                <svg class="absolute w-3.5 h-3.5 top-0.5 left-0.5 text-white opacity-0 peer-checked:opacity-100 transition-opacity duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div class="ml-3 text-base font-sans text-brand-black">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a wire:navigate href="'.route('terms.show').'" class="brand-link font-bold">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a wire:navigate href="'.route('policy.show').'" class="brand-link font-bold">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </label>
                        @error('terms')
                            <span class="text-brand-burgundy text-base mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                @endif

                <div class="!mt-8">
                    <x-shared.buttons.primary class="w-full">
                        Create Account
                    </x-button.primary>
                </div>

                @include('auth.includes.social-login')

            </form>
        </div>
    </div>
</x-layouts.guest>
