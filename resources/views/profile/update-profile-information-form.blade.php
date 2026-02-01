<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            @include('profile.includes.photo-form')
        @endif

        <!-- First Name -->
        <div class="col-span-6 sm:col-span-3">
            <x-shared.label for="first_name" value="{{ __('First Name') }}" />
            <x-shared.input id="first_name" type="text" class="block w-full mt-1" wire:model="state.first_name" required autocomplete="first_name" />
            <x-shared.input-error for="first_name" class="mt-2" />
        </div>

         <!-- Last Name -->
        <div class="col-span-6 sm:col-span-3">
            <x-shared.label for="last_name" value="{{ __('Last Name') }}" />
            <x-shared.input id="last_name" type="text" class="block w-full mt-1" wire:model="state.last_name" required autocomplete="last_name" />
            <x-shared.input-error for="last_name" class="mt-2" />
        </div>

         <!-- Username -->
        <div class="col-span-6 sm:col-span-3">
            <x-shared.label for="username" value="{{ __('Username') }}" />
            <x-shared.input id="username" type="text" class="block w-full mt-1" wire:model="state.username" required autocomplete="username" />
            <x-shared.input-error for="username" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-3">
            <x-shared.label for="email" value="{{ __('Email') }}" />
            <x-shared.input id="email" type="email" class="block w-full mt-1" wire:model="state.email" required autocomplete="username" />
            <x-shared.input-error for="email" class="mt-2" />

            @include('profile.includes.verification-notice')
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-shared.button wire:loading.attr="disabled" wire:target="photo, updateProfileInformation">
            <span wire:loading.remove wire:target="updateProfileInformation">{{ __('Save') }}</span>
            <span wire:loading wire:target="updateProfileInformation">{{ __('Saving...') }}</span>
        </x-button>
    </x-slot>
</x-form-section>


