<div class="mb-4">
    <div class="items-center justify-between hidden px-3 py-2 bg-white rounded-md border border-gray-300 md:flex">
        <h2 class="text-2xl font-bold brand-heading-playfair text-brand-teal uppercase tracking-wide">OUR COLLECTIONS</h2>
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" @click.away="open = false" type="button"
                class="flex items-center justify-between w-48 px-3 py-2 text-base font-medium bg-white rounded-md text-brand-black focus:outline-none">
                <span>{{ $sort === 'latest' ? 'SORT BY LATEST' : 'SORT BY PRICE' }}</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div x-show="open" style="display: none;"
                class="absolute right-0 z-10 w-48 mt-1 bg-white rounded-md shadow-lg">
                <div class="py-1">
                    <a href="#" wire:click.prevent="$set('sort', 'latest')" @click="open = false"
                        class="block px-4 py-2 text-sm text-brand-black hover:bg-brand-green hover:text-white transition-colors duration-200">
                        SORT BY LATEST
                    </a>
                    <a href="#" wire:click.prevent="$set('sort', 'price')" @click="open = false"
                        class="block px-4 py-2 text-sm text-brand-black hover:bg-brand-green hover:text-white transition-colors duration-200">
                        SORT BY PRICE
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="relative min-h-[400px]">
    {{-- VIEW 1: Loading State (Skeleton) --}}
    <div wire:loading.grid wire:target="selected_categories, price_range, sort, gotoPage, nextPage, previousPage" class="absolute inset-0 z-20 bg-brand-beige w-full h-full">
        <x-guest.shop.skeleton />
    </div>

    {{-- VIEW 2: Real Content --}}
    <div class="grid grid-cols-2 lg:grid-cols-3 max-xl:gap-4 gap-6">
        @forelse($products as $product)
            <x-guest.common.product-card :product="$product" :is-favorite="$this->isInFavorites($product->id)" />
        @empty
            @include('livewire.guest.partials.empty-state', [
                'title' => 'No products found!',
                'description' => 'Try different filters!',
                'buttonText' => 'Explore Full Collection',
                'buttonLink' => '/shop',
                'showButton' => true,
                'class' => 'col-span-full',
                'viewBox' => '0 0 512 512',
                'icon' => '<path d="M497.695 108.838a16.002 16.002 0 0 0-9.92-14.8L261.787 1.2a16.003 16.003 0 0 0-12.16 0L23.639 94.038a16 16 0 0 0-9.92 14.8v293.738a16 16 0 0 0 9.92 14.8l225.988 92.838a15.947 15.947 0 0 0 12.14-.001c.193-.064-8.363 3.445 226.008-92.837a16 16 0 0 0 9.92-14.8zm-241.988 76.886-83.268-34.207L352.39 73.016l88.837 36.495zm-209.988-51.67 71.841 29.513v83.264c0 8.836 7.164 16 16 16s16-7.164 16-16v-70.118l90.147 37.033v257.797L45.719 391.851zM255.707 33.297l55.466 22.786-179.951 78.501-61.035-25.074zm16 180.449 193.988-79.692v257.797l-193.988 79.692z" />'
            ])
        @endforelse
    </div>
    
    <div class="mt-6 uppercase text-base font-medium">
        {{ $products->links() }}
    </div>
</div>

