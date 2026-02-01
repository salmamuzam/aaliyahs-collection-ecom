@props(['submit'])

<div {{ $attributes->merge(['class' => '']) }}>
    <x-shared.sections.section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="mt-6">
        <form wire:submit="{{ $submit }}">
            <div class="px-6 py-8 bg-white brand-card {{ isset($actions) ? 'rounded-b-none border-b-0 shadow-none' : '' }}">
                <div class="grid grid-cols-6 gap-6">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div class="flex items-center justify-end px-6 py-4 bg-gray-50 border border-gray-300 border-t-0 rounded-b-md shadow-sm">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
