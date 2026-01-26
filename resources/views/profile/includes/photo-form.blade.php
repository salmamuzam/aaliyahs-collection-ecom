<div x-data="{photoName: null, photoPreview: null}" 
    x-on:saved.window="photoPreview = null; photoName = null"
    class="col-span-6">
    <!-- Profile Photo File Input -->
    <input type="file" id="photo" class="hidden"
                wire:model.live="photo"
                x-ref="photo"
                x-on:change="
                        photoName = $refs.photo.files[0].name;
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            photoPreview = e.target.result;
                        };
                        reader.readAsDataURL($refs.photo.files[0]);
                " />

    <x-label for="photo" value="{{ __('Photo') }}" />

    <!-- Current Profile Photo -->
    <div class="mt-2" x-show="! photoPreview">
        <img src="{{ $this->user->profile_photo_path ? \App\Helpers\ImageHelper::getUrl($this->user->profile_photo_path) : $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="object-cover rounded-full size-20 border border-gray-300 shadow-sm">
    </div>

    <!-- New Profile Photo Preview -->
    <div class="mt-2" x-show="photoPreview" style="display: none;">
        <span class="block bg-center bg-no-repeat bg-cover rounded-full size-20 border border-gray-300 shadow-sm"
              x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
        </span>
    </div>

    <div class="flex gap-2 mt-4">
        <x-secondary-button type="button" x-on:click.prevent="$refs.photo.click()">
            {{ __('Select A New Photo') }}
        </x-secondary-button>

        @if ($this->user->profile_photo_path)
            <x-danger-button type="button" wire:click="deleteProfilePhoto">
                {{ __('Remove Photo') }}
            </x-danger-button>
        @endif
    </div>

    <x-input-error for="photo" class="mt-2" />
</div>
