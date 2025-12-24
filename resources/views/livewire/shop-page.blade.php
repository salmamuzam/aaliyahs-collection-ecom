<div>
    <div class="w-full max-w-[85rem] py-5 px-4 sm:px-6 lg:px-8 mx-auto">
        <section class="py-2 rounded-lg font-poppins dark:bg-gray-800">
            <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
                <div class="flex flex-wrap mb-5 -mx-3">
                    <div class="w-full pr-2 lg:w-1/4 lg:block">
                        <div
                            class="p-4 mb-5 bg-white border border-gray-200 rounded-lg dark:border-gray-900 dark:bg-gray-900">
                            <h2 class="text-2xl font-bold dark:text-gray-400"> Categories</h2>
                            <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                            <ul>
                                @foreach($categories as $category)
                                    <li class="mb-4" wire:key="{{ $category->id }}">
                                        <label for="{{ $category->slug }}" class="flex items-center dark:text-gray-400 ">
                                            <input type="checkbox" id="{{ $category->slug }}"
                                                wire:model.live="selected_categories" value="{{ $category->id }}"
                                                class="w-4 h-4 mr-2">
                                            <span class="text-lg">{{ $category->name }}</span>
                                        </label>
                                    </li>
                                @endforeach

                            </ul>

                        </div>



                        <div
                            class="p-4 mb-5 bg-white border border-gray-200 rounded-lg dark:bg-gray-900 dark:border-gray-900">
                            <h2 class="text-2xl font-bold dark:text-gray-400">Price</h2>
                            <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                            <div>
                                <div class="font-semibold">LKR {{ $price_range}}</div>
                                <input wire:model.live="price_range" type="range"
                                    class="w-full h-1 mb-4 bg-blue-100 rounded appearance-none cursor-pointer"
                                    max="50000" value="30000" step="1000">
                                <div class="flex justify-between ">
                                    <span class="inline-block text-lg font-bold text-blue-400 ">LKR 1,000</span>
                                    <span class="inline-block text-lg font-bold text-blue-400 ">LKR 50,000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-3 lg:w-3/4">
                        <div class="mb-4">
                            <div
                                class="items-center justify-between hidden px-3 py-2 bg-gray-100 rounded-lg md:flex dark:bg-gray-900 ">
                                <div class="flex items-center justify-between">
                                    <select wire:model.live="sort" id=""
                                        class="block w-40 text-base bg-gray-100 rounded-lg cursor-pointer dark:text-gray-400 dark:bg-gray-900">
                                        <option value="latest">Sort by Latest</option>
                                        <option value="price">Sort by Price</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 max-xl:gap-4">

                            @foreach($products as $product)
                                <div wire:key="{{ $product->id }}"
                                    class="p-3 bg-white border border-gray-200 rounded-lg shadow-sm">
                                    <a href="/shop/{{ $product->id }}" class="block">

                                        <img src="{{ url('storage', $product->image) }}" alt="{{ $product->name }}"
                                            class="object-contain w-full h-full rounded-lg" />



                                        <h5 class="mt-2 text-base font-semibold text-slate-900">{{ $product->name }}</h5>
                                        <h6 class="mt-2 ml-auto text-base font-bold text-red-900">LKR
                                            {{ number_format($product->price, 2, '.', ',') }}</h6>


                                    </a>
                                    <div class="flex items-center gap-2 mt-4">
                                        <div class="flex items-center justify-center w-12 bg-pink-200 rounded-lg cursor-pointer hover:bg-pink-300 h-9"
                                            title="Wishlist">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16px"
                                                class="inline-block fill-pink-600" viewBox="0 0 64 64">
                                                <path
                                                    d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                                                    data-original="#000000"></path>
                                            </svg>
                                        </div>
                                        <a wire:click.prevent="addToCart({{ $product->id }})" type="button"
                                            class="w-full px-2 py-2 ml-auto text-sm font-medium tracking-wide text-white bg-indigo-600 border-none rounded-lg outline-none cursor-pointer hover:bg-indigo-700"><span
                                                wire:loading.remove wire:target="addToCart({{ $product->id }})">Add
                                                to cart </span><span wire:loading
                                                wire:target="addToCart({{ $product->id }})">Adding...</span></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- pagination start -->

                        <div class="flex justify-end mt-6">
                            {{ $products->links() }}
                        </div>

                        <!-- pagination end -->
                    </div>
                </div>
            </div>
        </section>

    </div>
