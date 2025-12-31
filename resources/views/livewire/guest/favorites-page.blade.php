<div class="w-full">
    <div class="">
        <div class="p-6 mx-auto max-w-7xl max-lg:max-w-4xl">
            @include('livewire.includes.guest-alerts')
            <x-customer.page-header title="YOUR WISHLIST" />

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-2">
                @forelse($favorite_items as $item)
                    <div wire:key="{{ $item['product_id'] }}" class="bg-white shadow-sm border border-gray-300 rounded-md p-3">
                        <a href="/shop/{{ $item['product_id'] }}" class="block" wire:navigate>
                            <div class="aspect-[3/4] overflow-hidden rounded-md">
                                <img src="{{ url('storage', $item['image']) }}"
                                    alt="{{ $item['name'] }}"
                                    class="w-full h-full object-cover object-top hover:scale-105 transition-transform duration-300" />
                            </div>

                            <div class="mt-4">
                                <h5 class="text-base font-sans text-brand-black truncate">{{ $item['name'] }}</h5>
                                <h6 class="text-base text-brand-burgundy font-bold mt-1">LKR {{ number_format($item['unit_amount'], 2) }}</h6>
                            </div>
                        </a>
                        
                        <div class="flex items-center gap-2 mt-4">
                            {{-- Wishlist Icon (Filled - click to remove) --}}
                            <div wire:click="removeItem({{ $item['product_id'] }})"
                                class="bg-brand-burgundy bg-opacity-10 hover:bg-opacity-20 w-12 h-9 flex items-center justify-center rounded-md cursor-pointer transition-all duration-300 active:scale-75 shrink-0"
                                title="Remove from Wishlist">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16px" class="fill-brand-burgundy relative z-10"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                </svg>
                            </div>

                            {{-- Add to Cart Button --}}
                            <button wire:click.prevent="addToCart({{ $item['product_id'] }})" type="button"
                                class="text-sm px-2 py-2 font-medium cursor-pointer w-full bg-brand-green hover:bg-opacity-90 text-white tracking-wide ml-auto outline-none border-none rounded-md transition-colors shadow-sm disabled:opacity-70 disabled:cursor-not-allowed">
                                <span wire:loading.remove wire:target="addToCart({{ $item['product_id'] }})">Add to cart</span>
                                <span wire:loading wire:target="addToCart({{ $item['product_id'] }})">Adding...</span>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        @include('livewire.includes.empty-state', [
                            'title' => 'Your wishlist is empty!',
                            'icon' => '<path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>'
                        ])
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
