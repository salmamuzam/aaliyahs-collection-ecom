@props(['submit'])

<div {{ $attributes->merge(['class' => '']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="mt-4">
        <form wire:submit="{{ $submit }}">
            <div class="px-4 py-5 bg-white sm:p-6 border border-gray-300 shadow-sm {{ isset($actions) ? 'rounded-t-md border-b-0' : 'rounded-md' }}">
                <div class="grid grid-cols-6 gap-6">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div class="flex items-center justify-end px-4 py-3 bg-gray-500/5 text-end sm:px-6 shadow-sm rounded-b-md border border-gray-300 border-t-0">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
