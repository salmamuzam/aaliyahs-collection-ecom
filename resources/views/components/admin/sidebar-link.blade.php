@props(['href', 'active' => false])

<li>
    <a wire:navigate href="{{ $href }}"
        @class([
            'text-[17px] font-normal flex items-center rounded px-4 py-2 transition-all hover:bg-brand-burgundy text-white',
            'bg-brand-burgundy' => $active,
        ])>
        <div class="mr-3.5 w-[22px] h-[22px]">
             {{ $slot }}
        </div>
        <span>{{ $label ?? $attributes->get('label') }}</span>
    </a>
</li>
