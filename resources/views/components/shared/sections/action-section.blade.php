<div {{ $attributes->merge(['class' => '']) }}>
    <x-shared.sections.section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="mt-6">
        <div class="px-6 py-8 brand-card">
            {{ $content }}
        </div>
    </div>
</div>
