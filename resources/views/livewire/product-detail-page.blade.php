<div>
    <section class="py-8 antialiased bg-white md:py-16 dark:bg-gray-900">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            <div class="lg:flex lg:gap-8 xl:gap-16">

                <!-- Image Section -->
                <div class="flex-1 max-w-md mx-auto shrink-0 lg:max-w-full lg:relative">
                    <img class="object-contain w-full h-full lg:absolute lg:inset-0 dark:hidden"
                        src="{{ url('storage', $product->image) }}" alt="{{ $product->name }}" />
                    <img class="hidden object-contain w-full h-full lg:absolute lg:inset-0 dark:block"
                        src="{{ url('storage', $product->image) }}" alt="{{ $product->name }}" />
                </div>

                <!-- Content Section -->
                <div class="flex-1 mt-6 sm:mt-8 lg:mt-0">
                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                        {{ $product->name }}
                    </h1>

                    <p class="mt-4 text-2xl font-extrabold text-gray-900 sm:text-3xl dark:text-white">
                        LKR {{ $product->price }}
                    </p>

                    <div class="mt-4 sm:gap-4 sm:items-center sm:flex sm:mt-8">
                        <div class="w-32 mb-8 ">

                            <div class="relative flex flex-row w-full h-10 mt-6 bg-transparent rounded-lg">
                                <button wire:click="decreaseQty"
                                    class="w-20 h-full text-gray-600 bg-gray-300 rounded-l outline-none cursor-pointer dark:hover:bg-gray-700 dark:text-gray-400 hover:text-gray-700 dark:bg-gray-900 hover:bg-gray-400">
                                    <span class="m-auto text-2xl font-thin">-</span>
                                </button>
                                <input wire:model="quantity" type="number" readonly
                                    class="flex items-center w-full font-semibold text-center text-gray-700 placeholder-gray-700 bg-gray-300 outline-none dark:text-gray-400 dark:placeholder-gray-400 dark:bg-gray-900 focus:outline-none text-md hover:text-black"
                                    placeholder="1">
                                <button wire:click="increaseQty"
                                    class="w-20 h-full text-gray-600 bg-gray-300 rounded-r outline-none cursor-pointer dark:hover:bg-gray-700 dark:text-gray-400 dark:bg-gray-900 hover:text-gray-700 hover:bg-gray-400">
                                    <span class="m-auto text-2xl font-thin">+</span>
                                </button>
                            </div>
                        </div>
                        <a href="#"
                            class="flex items-center justify-center py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                            role="button">
                            <svg class="w-5 h-5 -ms-2 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                            </svg>
                            Add to favorites
                        </a>

                        <button wire:click="addToCart({{ $product->id}})" href="#"
                            class="text-white mt-4 sm:mt-0 bg-pink-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 flex items-center justify-center"
                            role="button">
                            <svg class="w-5 h-5 -ms-2 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                            </svg>
                            <span wire:loading.remove wire:target="addToCart({{ $product->id}})"> Add to cart</span><span wire:loading wire:target="addToCart({{ $product->id}})">Adding...</span>
                        </button>
                    </div>

                    <hr class="my-6 border-gray-200 md:my-8 dark:border-gray-800" />

                    <p class="mb-6 text-justify text-gray-500 dark:text-gray-400">
                        {{ $product->description }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>
