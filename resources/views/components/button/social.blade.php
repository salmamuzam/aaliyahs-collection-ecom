@props(['icon', 'alt' => 'icon'])

<button type="button" {{ $attributes->merge(['class' => 'w-full flex items-center justify-center gap-3 py-2.5 px-4 border border-gray-300 rounded-md bg-white hover:bg-gray-50 transition-colors shadow-sm']) }}>
    <img src="{{ $icon }}" alt="{{ $alt }}" class="w-5 h-5" onerror="this.src='/images/icons/google.png';"/> 
    <span class="text-brand-black font-medium text-base font-sans">{{ $slot }}</span>
</button>
