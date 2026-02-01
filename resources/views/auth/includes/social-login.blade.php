<div class="flex items-center gap-4 my-8">
    <div class="h-px w-full bg-gray-200"></div>
    <span class="text-sm text-brand-black font-medium whitespace-nowrap">OR CONTINUE WITH</span>
    <div class="h-px w-full bg-gray-200"></div>
</div>

<div class="grid gap-4">
    <a href="{{ url('auth/google') }}" class="block w-full">
        <x-shared.buttons.social icon="{{ asset('images/icons/google.png') }}" alt="google">
            Google Account
        </x-button.social>
    </a>
</div>
