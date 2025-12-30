<div {{ $attributes->merge(['class' => '']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="mt-4">
        <div class="px-4 py-5 sm:p-6 bg-white shadow-sm rounded-md border border-gray-300">
            {{ $content }}
        </div>
    </div>
</div>
