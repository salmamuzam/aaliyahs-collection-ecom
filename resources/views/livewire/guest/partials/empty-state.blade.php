<div class="flex flex-col items-center justify-center py-16 px-4 brand-card {{ $class ?? '' }}">
    <div class="mb-6 p-6 rounded-full bg-brand-green bg-opacity-5">
        <svg xmlns="http://www.w3.org/2000/svg" width="60px" height="60px"
            class="{{ ($stroke ?? false) ? 'stroke-brand-green' : 'fill-brand-green' }}" 
            viewBox="{{ $viewBox ?? '0 0 24 24' }}" 
            @if($stroke ?? false) fill="none" stroke-width="1.5" @endif>
            {!! $icon !!}
        </svg>
    </div>
    <h3 class="mb-4 text-2xl md:text-3xl text-center brand-heading-playfair text-brand-black uppercase tracking-wide">{{ $title }}</h3>
    @if($description ?? true)
        <p class="mb-8 text-brand-black italic font-sans text-center max-w-md">
            {{ $description ?? 'It looks like you haven\'t added anything here yet. Explore our latest collections and find something you love!' }}
        </p>
    @endif
    
    @if($showButton ?? true)
        <a href="{{ $buttonLink ?? '/shop' }}" wire:navigate
            class="inline-block px-10 py-3.5 text-base font-medium tracking-widest text-center text-white rounded-md cursor-pointer font-sans bg-brand-green hover:bg-brand-teal transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5 active:translate-y-0 uppercase">
            {{ $buttonText ?? 'Let\'s go shopping!' }}
        </a>
    @endif
</div>
