<div class="">
    <div class="bg-gradient-to-tr from-gray-200 via-gray-100 to-gray-50">
        <div class="p-6 mx-auto max-w-7xl max-lg:max-w-4xl">
            <h2 class="text-xl font-semibold text-slate-900">Your shopping cart</h2>

            <div class="relative grid gap-4 mt-6 lg:grid-cols-3">
                <div class="space-y-4 lg:col-span-2">
                    @forelse($cart_items as $item)
                        <div wire:key="{{ $item['product_id'] }}"
                            class="relative p-6 bg-white border border-gray-300 rounded-md shadow-sm">
                            <div class="flex items-center gap-4 max-sm:flex-col max-sm:gap-6">
                                <div class="w-52 h-52 shrink-0">
                                    <img src='{{ url('storage', $item['image']) }}' class="object-contain w-full h-full"
                                        alt="{{ $item['name'] }}" />
                                </div>
                                <div class="w-full sm:border-l sm:pl-4 sm:border-gray-300">
                                    <h3 class="text-base font-semibold text-slate-900">
                                        {{ $item['name'] }}
                                    </h3>


                                    <hr class="my-4 border-gray-300" />

                                    <div class="flex flex-wrap items-center justify-between gap-4">
                                        <div class="flex items-center gap-4">
                                            <h4 class="text-sm font-semibold text-slate-900">Qty:</h4>
                                            <button wire:click="decreaseQty({{ $item['product_id'] }})" type="button"
                                                class="flex items-center justify-center w-[18px] h-[18px] bg-blue-600 outline-none rounded-sm cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-2 fill-white"
                                                    viewBox="0 0 124 124">
                                                    <path
                                                        d="M112 50H12C5.4 50 0 55.4 0 62s5.4 12 12 12h100c6.6 0 12-5.4 12-12s-5.4-12-12-12z"
                                                        data-original="#000000"></path>
                                                </svg>
                                            </button>
                                            <span
                                                class="font-semibold text-base leading-[16px]">{{ $item['quantity'] }}</span>
                                            <button wire:click="increaseQty({{ $item['product_id'] }})"type="button"
                                                class="flex items-center justify-center w-[18px] h-[18px] bg-blue-600 outline-none rounded-sm cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-2 fill-white"
                                                    viewBox="0 0 42 42">
                                                    <path
                                                        d="M37.059 16H26V4.941C26 2.224 23.718 0 21 0s-5 2.224-5 4.941V16H4.941C2.224 16 0 18.282 0 21s2.224 5 4.941 5H16v11.059C16 39.776 18.282 42 21 42s5-2.224 5-4.941V26h11.059C39.776 26 42 23.718 42 21s-2.224-5-4.941-5z"
                                                        data-original="#000000"></path>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="flex items-center">
                                            <h4 class="text-base font-semibold text-slate-900"> LKR
                                                {{ $item['unit_amount'] }}</h4>
                                                <button wire:click="removeItem({{ $item['product_id'] }})">
                                            <svg wire:Loading.remove wire:target="removeItem({{ $item['product_id'] }})" xmlns="http://www.w3.org/2000/svg"
                                                class="w-3 cursor-pointer shrink-0 fill-gray-400 hover:fill-red-500 absolute top-3.5 right-3.5"
                                                viewBox="0 0 320.591 320.591">
                                                <path
                                                    d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                                                    data-original="#000000"></path>
                                                <path
                                                    d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                                                    data-original="#000000"></path>
                                            </svg>
                                            <span wire:loading wire:target="removeItem({{ $item['product_id'] }})" class="text-red-500 top-3.5 absolute  right-3.5">Removing...</span>
                                            </button>
                                        </div>

                                    </div>
                                    <div class="mt-6">
                                        <span class="font-semibold text-base text-red-600 leading-[16px]">Total: LKR
                                            {{ $item['total_amount'] }}</span>
                                    </div>
                                </div>

                            </div>

                        </div>
                    @empty
                        <div class="max-w-4xl px-10 py-4 mx-auto bg-white rounded-lg shadow-lg">

                            <div class="flex flex-col items-center justify-center py-12">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    class="w-24 h-24 mb-4 text-gray-400">
                                    <path
                                        d="M4.00488 16V4H2.00488V2H5.00488C5.55717 2 6.00488 2.44772 6.00488 3V15H18.4433L20.4433 7H8.00488V5H21.7241C22.2764 5 22.7241 5.44772 22.7241 6C22.7241 6.08176 22.7141 6.16322 22.6942 6.24254L20.1942 16.2425C20.083 16.6877 19.683 17 19.2241 17H5.00488C4.4526 17 4.00488 16.5523 4.00488 16ZM6.00488 23C4.90031 23 4.00488 22.1046 4.00488 21C4.00488 19.8954 4.90031 19 6.00488 19C7.10945 19 8.00488 19.8954 8.00488 21C8.00488 22.1046 7.10945 23 6.00488 23ZM18.0049 23C16.9003 23 16.0049 22.1046 16.0049 21C16.0049 19.8954 16.9003 19 18.0049 19C19.1095 19 20.0049 19.8954 20.0049 21C20.0049 22.1046 19.1095 23 18.0049 23Z">
                                    </path>
                                </svg>
                                <p class="mb-4 text-lg font-semibold text-gray-600">Your shopping cart is empty.</p>
                                <button
                                    class="px-6 py-2 text-white transition-colors duration-300 bg-blue-500 rounded-md shadow-md hover:bg-blue-600">
                                    Let's go shopping!
                                </button>
                            </div>
                        </div>
                    @endforelse

                </div>

                <div class="sticky top-0 p-6 bg-white border border-gray-300 rounded-md shadow-sm h-max">
                    <h3 class="text-base font-semibold text-slate-900">Order Summary</h3>
                    <ul class="mt-4 text-sm font-medium divide-y divide-gray-300 text-slate-500">
                        <li class="flex flex-wrap gap-4 py-3">Subtotal <span
                                class="ml-auto font-semibold text-slate-900">LKR {{ $grand_total }}</span></li>
                        <li class="flex flex-wrap gap-4 py-3">Shipping <span
                                class="ml-auto font-semibold text-slate-900">LKR 0.00</span></li>
                        <li class="flex flex-wrap gap-4 py-3">Tax <span
                                class="ml-auto font-semibold text-slate-900">LKR 0.00</span></li>
                        <li class="flex flex-wrap gap-4 py-3 font-semibold text-slate-900">Total <span
                                class="ml-auto">LKR {{ $grand_total }}</span></li>
                    </ul>
                    @if($cart_items)
                    <button type="button"
                        class="mt-6 text-sm font-medium px-4 py-2.5 tracking-wide w-full bg-blue-600 hover:bg-blue-700 text-white rounded-md cursor-pointer">Proceed
                        to Checkout</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
