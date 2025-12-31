<div class="bg-[#F3EDE8] py-8">
    <div class="tracking-wide max-w-7xl mx-auto w-full px-4">
      <div class="brand-card grid items-stretch grid-cols-1 md:grid-cols-2 gap-0 overflow-hidden">

        {{-- Left Side: Product Image --}}
        <div class="relative bg-white border-r border-gray-100">
          <div class="relative w-full h-full md:absolute md:inset-0 flex flex-col items-center justify-center">
             @if(!empty($product->images))
                {{-- Main Image --}}
                <div class="relative w-full h-[400px] md:h-full flex items-center justify-center">
                     <img src="{{ url('storage', $product->images[0]) }}" alt="{{ $product->name }}" id="mainImage" 
                     class="w-full h-full object-cover object-top" />
                </div>

                {{-- Dot Indicators Slider --}}
                @if(count($product->images) > 1)
                <div class="flex items-center justify-center gap-3 absolute md:bottom-6 bottom-4 left-0 right-0 mx-auto">
                    @foreach($product->images as $index => $image)
                    <div class="w-3.5 h-3.5 shrink-0 rounded-full cursor-pointer transition-all {{ $index === 0 ? 'bg-brand-burgundy scale-110' : 'bg-brand-teal' }}"
                         onclick="changeImage('{{ url('storage', $image) }}', this); updateDots(this)">
                         {{-- Hidden image reference for JS --}}
                         <span class="hidden" data-src="{{ url('storage', $image) }}"></span>
                    </div>
                    @endforeach
                </div>
                @endif
             @endif
          </div>
        </div>

        {{-- Right Side: Details --}}
        <div class="bg-white py-6 px-6 md:px-8 h-full flex flex-col">
          <div class="mb-4">
            <h2 class="text-2xl font-bold text-brand-black brand-heading-playfair capitalize">{{ $product->name }}</h2>
          </div>

          <div class="flex items-center justify-between mt-2 border-b border-black pb-6">
            {{-- Category Badge --}}
            @if($product->category)
                @php
                    $categoryColors = [
                        'bg-purple-50 text-purple-700 border-purple-100',
                        'bg-blue-50 text-blue-700 border-blue-100',
                        'bg-cyan-50 text-cyan-700 border-cyan-100',
                        'bg-emerald-50 text-emerald-700 border-emerald-100',
                        'bg-amber-50 text-amber-700 border-amber-100',
                        'bg-indigo-50 text-indigo-700 border-indigo-100',
                    ];
                    $badgeColor = $categoryColors[$product->category->id % count($categoryColors)];
                @endphp
                <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-md border {{ $badgeColor }}">
                    {{ $product->category->name }}
                </span>
            @else
                 <span class="text-sm text-gray-400 font-medium tracking-widest uppercase">Collection</span>
            @endif

            <h3 class="text-brand-burgundy text-xl font-bold font-sans text-right">LKR {{ number_format($product->price, 2) }}</h3>
          </div>

          {{-- Description --}}
          <div class="mt-8">
            <h3 class="text-lg font-bold text-brand-teal uppercase tracking-wider mb-3">Description</h3>
            <p class="text-brand-black text-base leading-relaxed text-justify">
                {{ $product->description }}
            </p>
          </div>

          {{-- Quantity --}}
          <div class="mt-4">
            <h3 class="text-lg font-bold text-brand-teal uppercase tracking-wider mb-3">Quantity</h3>

            <div class="flex mt-2 rounded-full overflow-hidden bg-gray-100 border border-gray-200 w-36">
              <button wire:click="decreaseQty" type="button" class="w-full h-10 text-brand-black hover:bg-gray-200 transition-colors flex items-center justify-center cursor-pointer outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-current" viewBox="0 0 124 124">
                  <path d="M112 50H12C5.4 50 0 55.4 0 62s5.4 12 12 12h100c6.6 0 12-5.4 12-12s-5.4-12-12-12z"></path>
                </svg>
              </button>
              <span class="w-full h-10 px-2 font-bold flex items-center justify-center text-brand-black text-base">
                {{ $quantity }}
              </span>
              <button wire:click="increaseQty" type="button" class="w-full h-10 text-brand-black hover:bg-gray-200 transition-colors flex items-center justify-center cursor-pointer outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-current" viewBox="0 0 42 42">
                  <path d="M37.059 16H26V4.941C26 2.224 23.718 0 21 0s-5 2.224-5 4.941V16H4.941C2.224 16 0 18.282 0 21s2.224 5 4.941 5H16v11.059C16 39.776 18.282 42 21 42s5-2.224 5-4.941V26h11.059C39.776 26 42 23.718 42 21s-2.224-5-4.941-5z"></path>
                </svg>
              </button>
            </div>
          </div>

          {{-- Buttons --}}
          <div class="flex gap-4 mt-8">
            {{-- Wishlist Button (Card Style) --}}
            <div wire:click.prevent="addToFavorites({{ $product->id }})"
                class="bg-brand-burgundy bg-opacity-10 hover:bg-opacity-20 w-14 h-14 flex items-center justify-center rounded-md cursor-pointer transition-all duration-300 active:scale-75 border-2 border-transparent"
                title="Wishlist">
                @if ($isFavorite)
                    <div class="relative flex items-center justify-center">
                        {{-- Celebrate Burst (Only shows when isFavorite becomes true) --}}
                        <svg viewBox="0 0 100 100" class="absolute w-10 h-10 animate-heart-celebrate opacity-0 pointer-events-none stroke-brand-burgundy" style="stroke-width: 6; overflow: visible;">
                            <path d="M50 25 L50 0" />
                            <path d="M50 75 L50 100" />
                            <path d="M25 50 L0 50" />
                            <path d="M75 50 L100 50" />
                            <path d="M32.32 32.32 L14.64 14.64" />
                            <path d="M67.68 67.68 L85.36 85.36" />
                            <path d="M32.32 67.68 L14.64 85.36" />
                            <path d="M67.68 32.32 L85.36 14.64" />
                        </svg>
                        {{-- Filled Heart --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" class="fill-brand-burgundy animate-heart-filled relative z-10"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                    </div>
                @else
                    {{-- Outline Heart --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" class="fill-brand-burgundy inline-block"
                        viewBox="0 0 64 64">
                        <path
                            d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                            data-original="#000000"></path>
                    </svg>
                @endif
            </div>

            {{-- Add to Cart Button (Card Style) --}}
            <button type="button" wire:click.prevent="addToCart({{ $product->id }})"
                class="w-full px-6 py-3.5 bg-brand-green hover:bg-opacity-90 text-white text-lg font-bold tracking-wide rounded-md transition-all shadow-lg flex items-center justify-center gap-2">
                <span wire:loading.remove wire:target="addToCart({{ $product->id }})">Add to cart</span>
                <span wire:loading wire:target="addToCart({{ $product->id }})">Adding...</span>
            </button>
          </div>
        </div>
      </div>
    </div>

  @vite('resources/js/product-detail.js')
</div>
