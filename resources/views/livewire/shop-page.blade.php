<div>
    <div class="w-full max-w-[85rem] pt-2 pb-0 px-4 sm:px-6 lg:px-8 mx-auto">
        <section class="pt-2 pb-0 rounded-lg font-poppins dark:bg-gray-800">
            <div class="px-4 py-2 mx-auto max-w-7xl lg:py-3 md:px-6">
                <div class="flex flex-wrap mb-5 -mx-3">
                    <div class="w-full px-3 lg:w-1/4 lg:block">
                            <div
                                class="p-4 mb-5 bg-white border border-gray-200 rounded-lg dark:border-gray-900 dark:bg-gray-900">
                                <h2 class="text-2xl font-bold font-playfair text-[#1A1A1A] dark:text-gray-400"> CATEGORIES</h2>
                                <div class="w-16 pb-2 mb-6 border-b border-[#822659] dark:border-gray-400"></div>
                                <ul>
                                    @foreach($categories as $category)
                                        <li class="mb-4" wire:key="{{ $category->id }}">
                                            <label for="{{ $category->slug }}" class="flex items-center dark:text-gray-400 ">
                                                <input type="checkbox" id="{{ $category->slug }}"
                                                    wire:model.live="selected_categories" value="{{ $category->id }}"
                                                    class="w-4 h-4 mr-2 text-[#822659] focus:ring-[#822659] border-[#822659] rounded">
                                                <span class="text-lg text-[#1A1A1A]">{{ $category->name }}</span>
                                            </label>
                                        </li>
                                    @endforeach

                                </ul>

                            </div>



                            <div
                                class="p-4 mb-5 bg-white border border-gray-200 rounded-lg dark:bg-gray-900 dark:border-gray-900">
                                <h2 class="text-2xl font-bold font-playfair text-[#1A1A1A] dark:text-gray-400">PRICE</h2>
                                <div class="w-16 pb-2 mb-6 border-b border-[#822659] dark:border-gray-400"></div>
                                <div>
                                    <div class="text-[#1A1A1A]">LKR {{ number_format($price_range, 2) }}</div>
                                    <input wire:model.live="price_range" type="range"
                                        class="w-full h-1 mb-4 bg-gray-200 rounded appearance-none cursor-pointer accent-[#822659]"
                                        max="50000" value="30000" step="1000">
                                    <div class="flex justify-between ">
                                        <span class="inline-block text-lg text-[#822659]">LKR 1,000</span>
                                        <span class="inline-block text-lg text-[#822659]">LKR 50,000</span>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="w-full px-3 lg:w-3/4">
                        <div class="mb-4">
                            <div
                                class="items-center justify-between hidden px-3 py-2 bg-white rounded-lg md:flex dark:bg-gray-900 ">
                                <h1 class="text-2xl font-bold font-playfair text-[#004D61]">OUR COLLECTIONS</h1>
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" @click.away="open = false" type="button"
                                        class="flex items-center justify-between w-48 px-3 py-2 text-base font-medium bg-white rounded-lg text-[#1A1A1A] focus:outline-none">
                                        <span>{{ $sort === 'latest' ? 'SORT BY LATEST' : 'SORT BY PRICE' }}</span>
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                    <div x-show="open" style="display: none;"
                                        class="absolute right-0 z-10 w-48 mt-1 bg-white rounded-lg shadow-lg">
                                        <div class="py-1">
                                            <a href="#" wire:click.prevent="$set('sort', 'latest')" @click="open = false"
                                                class="block px-4 py-2 text-sm text-[#1A1A1A] hover:bg-[#3E5641] hover:text-white transition-colors duration-200">
                                                SORT BY LATEST
                                            </a>
                                            <a href="#" wire:click.prevent="$set('sort', 'price')" @click="open = false"
                                                class="block px-4 py-2 text-sm text-[#1A1A1A] hover:bg-[#3E5641] hover:text-white transition-colors duration-200">
                                                SORT BY PRICE
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 lg:grid-cols-3 max-xl:gap-4 gap-6">
                            @foreach($products as $product)
                                <div wire:key="{{ $product->id }}" class="bg-white shadow-sm border border-gray-200 rounded-lg p-3">
                                    <a href="/shop/{{ $product->id }}" class="block">
                                        <div class="aspect-[3/4] overflow-hidden rounded-lg">
                                            <img src="{{ url('storage', $product->image) }}" alt="{{ $product->name }}"
                                                class="w-full h-full object-cover object-top hover:scale-105 transition-transform duration-300" />
                                        </div>

                                        <div class="mt-4">
                                            <h5 class="text-base font-sans text-[#1A1A1A]">{{ $product->name }}</h5>
                                            <h6 class="text-base text-[#822659] mt-1">LKR {{ number_format($product->price, 2, '.', ',') }}</h6>
                                        </div>
                                    </a>
                                    <div class="flex items-center gap-2 mt-6">
                                        <div class="bg-[#e6d3dd] hover:bg-[#d9c0d1] w-12 h-9 flex items-center justify-center rounded-lg cursor-pointer"
                                            title="Wishlist">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16px" class="fill-[#822659] inline-block"
                                                viewBox="0 0 64 64">
                                                <path
                                                    d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                                                    data-original="#000000"></path>
                                            </svg>
                                        </div>
                                        <button wire:click.prevent="addToCart({{ $product->id }})" type="button"
                                            class="text-sm px-2 py-2 font-medium cursor-pointer w-full bg-[#3E5641] hover:bg-[#324534] text-white tracking-wide ml-auto outline-none border-none rounded-lg">
                                            <span wire:loading.remove wire:target="addToCart({{ $product->id }})">Add to cart</span>
                                            <span wire:loading wire:target="addToCart({{ $product->id }})">Adding...</span>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-6 uppercase">
                            {{ $products->links() }}
                        </div>

                        <!-- pagination end -->
                    </div>
                </div>
            </div>
        </section>

    </div>
