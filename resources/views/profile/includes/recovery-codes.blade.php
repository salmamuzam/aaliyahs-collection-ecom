@if ($showingRecoveryCodes)
    <div class="max-w-xl mt-4 text-base text-brand-black">
        <p class="font-semibold text-brand-burgundy">
            {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
        </p>
    </div>

    <div class="grid max-w-xl gap-2 px-6 py-6 mt-6 font-mono text-base bg-gray-50 border border-gray-200 rounded-lg shadow-inner">
        @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
            <div class="text-brand-black">{{ $code }}</div>
        @endforeach
    </div>
@endif
