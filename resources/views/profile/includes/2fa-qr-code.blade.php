@if ($showingQrCode)
    <div class="max-w-xl mt-6 text-base text-brand-black">
        <p class="font-semibold">
            @if ($showingConfirmation)
                {{ __('To finish enabling two factor authentication, scan the following QR code using your phone\'s authenticator application or enter the setup key and provide the generated OTP code.') }}
            @else
                {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application or enter the setup key.') }}
            @endif
        </p>
    </div>

    <div class="inline-block p-4 mt-4 bg-white border border-gray-200 rounded-md shadow-sm">
        {!! $this->user->twoFactorQrCodeSvg() !!}
    </div>

    <div class="max-w-xl mt-4 text-base text-brand-black">
        <p class="font-semibold">
            {{ __('Setup Key') }}: <span class="font-mono text-brand-burgundy">{{ decrypt($this->user->two_factor_secret) }}</span>
        </p>
    </div>

    @if ($showingConfirmation)
        <div class="mt-6 p-4 bg-brand-teal bg-opacity-5 rounded-md border border-brand-teal border-opacity-10">
            <x-shared.label for="code" value="{{ __('Verification Code') }}" />

            <x-shared.input id="code" type="text" name="code" class="block w-full sm:w-1/2 mt-1" inputmode="numeric" autofocus autocomplete="one-time-code"
                wire:model="code"
                wire:keydown.enter="confirmTwoFactorAuthentication" 
                placeholder="000000" />

            <x-shared.input-error for="code" class="mt-2" />
        </div>
    @endif
@endif
