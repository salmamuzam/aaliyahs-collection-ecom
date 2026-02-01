<x-shared.sections.action-section>
    <x-slot name="title">
        {{ __('Two Factor Authentication') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Add additional security to your account using two factor authentication.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-brand-black">
            @if ($this->enabled)
                @if ($showingConfirmation)
                    {{ __('Finish enabling two factor authentication.') }}
                @else
                    {{ __('You have enabled two factor authentication.') }}
                @endif
            @else
                {{ __('You have not enabled two factor authentication.') }}
            @endif
        </h3>

        <div class="max-w-xl mt-3 text-base text-brand-black">
            <p>
                {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
            </p>
        </div>

        @if ($this->enabled)
            @include('profile.includes.2fa-qr-code')
            @include('profile.includes.recovery-codes')
        @endif

        <div class="mt-5">
            @if (! $this->enabled)
                <x-auth.confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-shared.buttons.button type="button" wire:loading.attr="disabled">
                        {{ __('Enable') }}
                    </x-button>
                </x-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-auth.confirms-password wire:then="regenerateRecoveryCodes">
                        <x-shared.buttons.secondary class="me-3">
                            {{ __('Regenerate Recovery Codes') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @elseif ($showingConfirmation)
                    <x-auth.confirms-password wire:then="confirmTwoFactorAuthentication">
                        <x-shared.buttons.button type="button" class="me-3" wire:loading.attr="disabled">
                            {{ __('Confirm') }}
                        </x-button>
                    </x-confirms-password>
                @else
                    <x-auth.confirms-password wire:then="showRecoveryCodes">
                        <x-shared.buttons.secondary class="me-3">
                            {{ __('Show Recovery Codes') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @endif

                @if ($showingConfirmation)
                    <x-auth.confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-shared.buttons.secondary wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @else
                    <x-auth.confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-shared.buttons.danger wire:loading.attr="disabled">
                            {{ __('Disable') }}
                        </x-danger-button>
                    </x-confirms-password>
                @endif

            @endif
        </div>
    </x-slot>
</x-action-section>


