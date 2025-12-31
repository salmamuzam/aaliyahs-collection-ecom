<div class="max-w-[480px] w-full mb-6 text-center">
    <a href="/" wire:navigate>
        <div class="flex justify-center transition-all duration-300 hover:scale-105 active:scale-95">
            <x-authentication-card-logo />
        </div>
    </a>
</div>

<div class="w-full mb-8 text-center">
    <h1 class="text-brand-green text-2xl md:text-3xl brand-heading-playfair mb-3 uppercase">{{ $title }}</h1>
    <p class="text-brand-black text-base font-sans">
        {{ $subtitle }}
        @isset($link)
            <a href="{{ $link['url'] }}" wire:navigate class="brand-link ml-1">{{ $link['text'] }}</a>
        @endisset
    </p>
</div>
