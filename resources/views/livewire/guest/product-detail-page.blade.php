<div class="py-6 md:pt-10 md:pb-8 bg-brand-beige">
    <section class="max-w-6xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="brand-card p-4 sm:p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 items-stretch">
                {{-- Product Images Slider --}}
                <div class="relative bg-gray-50 rounded-md overflow-hidden group border border-gray-300 aspect-[4/5] md:aspect-auto md:min-h-0">
                    
                    @if(!empty($product->images))
                    <div class="absolute inset-0 w-full h-full">
                        <img class="w-full h-full object-cover object-top transition-all duration-300" 
                             src="{{ url('storage', $product->images[$currentImageIndex]) }}" alt="{{ $product->name }}">
                    </div>
                    
                    @if(count($product->images) > 1)
                    <div class="arrows w-full absolute inset-y-1/2 flex justify-between px-4 z-10 opacity-0 group-hover:opacity-100 transition-opacity">
                        <button wire:click="prevImage" class="w-10 h-10 bg-white/80 hover:bg-white text-brand-burgundy rounded-full shadow-lg flex items-center justify-center transition-all active:scale-95 focus:outline-none cursor-pointer">
                            <i class="fa-solid fa-chevron-left text-xl"></i>
                        </button>
                        <button wire:click="nextImage" class="w-10 h-10 bg-white/80 hover:bg-white text-brand-burgundy rounded-full shadow-lg flex items-center justify-center transition-all active:scale-95 focus:outline-none cursor-pointer">
                            <i class="fa-solid fa-chevron-right text-xl"></i>
                        </button>
                    </div>

                    {{-- Image Counter Badge --}}
                    <div class="absolute bottom-4 right-4 bg-black/50 text-white px-3 py-1 rounded-full text-xs font-medium tracking-wider backdrop-blur-sm z-10">
                        {{ $currentImageIndex + 1 }} / {{ count($product->images) }}
                    </div>
                    @endif
                    @endif
                </div>

                {{-- Product Info --}}
                <div class="flex flex-col justify-between space-y-6 py-2">
                    <div class="space-y-6">
                        <div class="space-y-4">
                            <div class="inline-flex">
                                <span class="bg-brand-teal bg-opacity-10 text-brand-teal px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest border border-brand-teal border-opacity-20">
                                    {{ $product->category->name ?? 'Aaliyah Collection' }}
                                </span>
                            </div>
                            <h1 class="text-2xl sm:text-3xl font-extrabold text-brand-black leading-tight font-sans block">
                                {{ $product->name }}
                            </h1>
                        </div>

                        <div class="flex items-center space-x-4">
                            <h2 class="text-xl sm:text-2xl font-black text-brand-burgundy">
                                LKR {{ number_format($product->price, 2) }}
                            </h2>
                        </div>

                        <div class="space-y-3">
                            <p class="text-brand-teal font-bold uppercase tracking-wider text-sm">Description</p>
                            <div class="text-brand-black text-base md:text-lg leading-relaxed text-center text-justify">
                                {{ $product->description }}
                            </div>
                        </div>

                        <div class="space-y-4 pt-4">
                            <h4 class="text-sm font-bold uppercase tracking-widest text-brand-teal">Select Quantity</h4>
                            <div class="flex items-center gap-4">
                                <button wire:click="decreaseQty" type="button"
                                     wire:loading.attr="disabled"
                                     class="flex items-center justify-center w-8 h-8 bg-brand-green outline-none rounded-md cursor-pointer hover:bg-opacity-90 transition-all active:scale-90">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-white" viewBox="0 0 124 124">
                                         <path d="M112 50H12C5.4 50 0 55.4 0 62s5.4 12 12 12h100c6.6 0 12-5.4 12-12s-5.4-12-12-12z"></path>
                                     </svg>
                                </button>
                                <span class="text-lg font-bold text-brand-black w-8 text-center">{{ $quantity }}</span>
                                <button wire:click="increaseQty" type="button"
                                     wire:loading.attr="disabled"
                                     class="flex items-center justify-center w-8 h-8 bg-brand-green outline-none rounded-md cursor-pointer hover:bg-opacity-90 transition-all active:scale-90">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-white" viewBox="0 0 42 42">
                                         <path d="M37.059 16H26V4.941C26 2.224 23.718 0 21 0s-5 2.224-5 4.941V16H4.941C2.224 16 0 18.282 0 21s2.224 5 4.941 5H16v11.059C16 39.776 18.282 42 21 42s5-2.224 5-4.941V26h11.059C39.776 26 42 23.718 42 21s-2.224-5-4.941-5z"></path>
                                     </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-6">
                        {{-- Favorites Button --}}
                        <div wire:click.prevent="addToFavorites({{ $product->id }})"
                            class="bg-brand-burgundy bg-opacity-10 hover:bg-opacity-20 w-16 h-12 flex items-center justify-center rounded-md cursor-pointer transition-all duration-300 active:scale-75"
                            title="Wishlist">
                            @if ($isFavorite)
                                <div class="relative flex items-center justify-center">
                                    {{-- Celebrate Burst --}}
                                    <svg viewBox="0 0 100 100" class="absolute w-12 h-12 animate-heart-celebrate opacity-0 pointer-events-none stroke-brand-burgundy" style="stroke-width: 6; overflow: visible;">
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
                        
                        {{-- Add to Cart Button --}}
                        <button wire:click.prevent="addToCart({{ $product->id }})" wire:loading.attr="disabled"
                            class="flex-1 flex items-center justify-center space-x-3 bg-brand-green hover:bg-opacity-90 text-white px-8 py-3.5 rounded-md font-bold transition-all active:scale-95 disabled:opacity-50">
                            <span wire:loading.remove wire:target="addToCart({{ $product->id }})">Add To Cart</span>
                            <span wire:loading wire:target="addToCart({{ $product->id }})">Adding...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
