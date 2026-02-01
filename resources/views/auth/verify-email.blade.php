<x-layouts.guest>
    <div class="brand-auth-wrapper">
        {{-- Logo Section --}}
        <div class="max-w-[480px] w-full mb-4 text-center">
            <div class="flex justify-center transition-all duration-300 hover:scale-105 active:scale-95">
                <x-auth.authentication-card-logo />
            </div>
        </div>

        {{-- Card Section --}}
        <div class="max-w-[480px] w-full p-6 sm:p-10 brand-card z-10">
            <h1 class="text-brand-green text-center text-2xl font-bold font-playfair mb-2 uppercase">VERIFY EMAIL</h1>
            
            <p class="text-brand-black text-center text-base font-sans mb-6 mt-2">
                Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 p-4 rounded-md bg-green-100 border border-gray-300 text-base font-medium text-green-800 text-center">
                    A new verification link has been sent to the email address you provided in your profile settings.
                </div>
            @endif

            <div class="mt-8 flex items-center justify-between flex-col gap-4">
                <form method="POST" action="{{ route('verification.send') }}" novalidate class="w-full">
                    @csrf
                    <x-shared.buttons.primary>
                        Resend Verification Email
                    </x-button.primary>
                </form>

                <div class="flex items-center justify-between w-full">
                    <a href="{{ route('profile.show') }}" wire:navigate class="text-sm font-semibold text-brand-green hover:underline font-sans">
                        Edit Profile
                    </a>

                    <form method="POST" action="{{ route('logout') }}" novalidate class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-semibold text-brand-green hover:underline font-sans ms-2 bg-transparent border-0 cursor-pointer">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.guest>
