@if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
    <div class="mt-4 p-4 bg-brand-burgundy bg-opacity-5 rounded-md border border-brand-burgundy border-opacity-10">
        <p class="text-base text-brand-black">
            {{ __('Your email address is unverified.') }}

            <button type="button" class="font-bold text-brand-burgundy hover:underline focus:outline-none" wire:click.prevent="sendEmailVerification">
                {{ __('Click here to re-send the verification email.') }}
            </button>
        </p>

        @if ($this->verificationLinkSent)
            <p class="mt-2 text-sm font-medium text-brand-green">
                {{ __('A new verification link has been sent to your email address.') }}
            </p>
        @endif
    </div>
@endif
