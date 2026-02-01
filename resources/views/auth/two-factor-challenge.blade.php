<x-layouts.guest>
    <div class="brand-auth-wrapper">
        {{-- Logo Section --}}
        <div class="max-w-[480px] w-full mb-4 text-center">
            <div class="flex justify-center transition-all duration-300 hover:scale-105 active:scale-95">
                <x-auth.authentication-card-logo />
            </div>
        </div>

        {{-- Card Section --}}
        <div x-data="{ recovery: false }" class="max-w-[480px] w-full p-6 sm:p-10 brand-card z-10">
            <h1 class="text-brand-green text-center text-2xl font-bold font-playfair mb-2 uppercase">TWO FACTOR CONFIRMATION</h1>

            <div class="mb-4 text-base text-brand-black font-sans text-center mt-2" x-show="! recovery">
                {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
            </div>

            <div class="mb-4 text-base text-brand-black font-sans text-center mt-2" x-show="recovery" style="display: none;">
                {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
            </div>

            @include('auth.includes.alerts')

            <form method="POST" action="{{ route('two-factor.login') }}" novalidate class="space-y-6">
                @csrf

                {{-- Code --}}
                <div x-show="! recovery">
                    <x-shared.forms.input label="Code" name="code" type="text" inputmode="numeric" autofocus x-ref="code" autocomplete="one-time-code" placeholder="Enter code" required />
                </div>

                {{-- Recovery Code --}}
                <div x-show="recovery" style="display: none;">
                    <x-shared.forms.input label="Recovery Code" name="recovery_code" type="text" x-ref="recovery_code" autocomplete="one-time-code" placeholder="Enter recovery code" required />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="button" class="text-sm font-semibold text-brand-green hover:underline cursor-pointer bg-transparent border-0"
                            x-show="! recovery"
                            x-on:click="
                                recovery = true;
                                $nextTick(() => { $refs.recovery_code.focus() })
                            ">
                        {{ __('Use a recovery code') }}
                    </button>

                    <button type="button" class="text-sm font-semibold text-brand-green hover:underline cursor-pointer bg-transparent border-0"
                            x-show="recovery"
                            style="display: none;"
                            x-on:click="
                                recovery = false;
                                $nextTick(() => { $refs.code.focus() })
                            ">
                        {{ __('Use an authentication code') }}
                    </button>
                </div>

                <div class="!mt-8">
                    <x-shared.buttons.primary>
                        Log in
                    </x-button.primary>
                </div>
            </form>
        </div>
    </div>
</x-layouts.guest>
