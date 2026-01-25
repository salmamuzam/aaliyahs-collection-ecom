@props(['product', 'isFavorite' => false])

<div wire:key="{{ $product->id }}" class="bg-white shadow-sm border border-gray-300 rounded-md p-3">
    <a href="/shop/{{ $product->id }}" class="block" wire:navigate>
        <div class="aspect-[3/4] overflow-hidden rounded-md">
            <img src="{{ \App\Helpers\ImageHelper::getUrl($product->images[0] ?? null) }}"
                alt="{{ $product->name }}"
                class="w-full h-full object-cover object-top hover:scale-105 transition-transform duration-300" />
        </div>

        <div class="mt-4">
            <h5 class="text-base font-sans text-brand-black">{{ $product->name }}</h5>
            <h6 class="text-base text-brand-burgundy font-bold mt-1">LKR
                {{ number_format($product->price, 2, '.', ',') }}</h6>
        </div>
    </a>
    <div class="flex items-center gap-2 mt-6">
        <div wire:click.prevent="toggleFavorite({{ $product->id }})"
            class="bg-brand-burgundy bg-opacity-10 hover:bg-opacity-20 w-12 h-9 flex items-center justify-center rounded-md cursor-pointer transition-all duration-300 active:scale-75"
            title="Wishlist">
            @if ($isFavorite)
                {{-- Normal: Show Filled Heart --}}
                <div wire:loading.remove wire:target="toggleFavorite({{ $product->id }})" class="flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" class="fill-brand-burgundy relative z-10" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>
                </div>

                {{-- Loading: Optimistic Unfill (Show Outline Static) --}}
                <div wire:loading wire:target="toggleFavorite({{ $product->id }})" style="display:none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" class="fill-brand-burgundy inline-block" viewBox="0 0 64 64">
                         <path d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z" />
                    </svg>
                </div>
            @else
                {{-- State: Not Favorite --}}

                {{-- Normal: Show Outline Heart --}}
                <div wire:loading.remove wire:target="toggleFavorite({{ $product->id }})">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" class="fill-brand-burgundy inline-block" viewBox="0 0 64 64">
                        <path d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z" />
                    </svg>
                </div>

                {{-- Loading: Optimistic Fill (Show Filled Static) --}}
                <div wire:loading wire:target="toggleFavorite({{ $product->id }})" style="display:none" class="flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" class="fill-brand-burgundy relative z-10" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>
                </div>
            @endif
        </div>
        <button wire:click.prevent="addToCart({{ $product->id }})" type="button"
            class="text-sm px-2 py-2 font-medium cursor-pointer w-full bg-brand-green hover:bg-opacity-90 text-white tracking-wide ml-auto outline-none border-none rounded-md transition-colors">
            <span wire:loading.remove wire:target="addToCart({{ $product->id }})">Add to cart</span>
            <span wire:loading wire:target="addToCart({{ $product->id }})">Adding...</span>
        </button>
    </div>
</div>
