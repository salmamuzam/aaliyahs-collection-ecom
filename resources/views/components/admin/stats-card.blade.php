@props(['count', 'label', 'href'])

<a wire:navigate href="{{ $href }}" class="text-center brand-card px-4 py-5 border-b-4 border-b-brand-teal transform transition-all hover:scale-105 hover:shadow-md cursor-pointer block">
    <div class="flex justify-center text-brand-teal">
        {{ $slot }}
    </div>
    <div class="mt-4">
        <h3 class="text-brand-green text-5xl font-bold uppercase">{{ $count }}</h3>
        <p class="text-base text-brand-black font-bold mt-3 uppercase tracking-wider">{{ $label }}</p>
    </div>
</a>
