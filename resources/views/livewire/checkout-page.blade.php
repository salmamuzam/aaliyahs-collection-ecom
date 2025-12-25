<div>
    <div class="px-4 py-6 bg-purple-50 sm:px-8">
        <div class="max-w-screen-xl mx-auto max-lg:max-w-xl">
            <div class="grid gap-8 lg:grid-cols-2 gap-y-12">
                <div class="w-full max-w-4xl rounded-md h-max">
                    <form wire:submit.prevent="placeOrder">
                        <div>
                            <h2 class="mb-6 text-xl font-semibold text-slate-900">Delivery Details</h2>
                            <div class="grid lg:grid-cols-2 gap-y-6 gap-x-4">
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-slate-900">First Name</label>
                                    <input wire:model="first_name" type="text" placeholder="Enter First Name"
                                         class="px-4 py-2.5 bg-white border border-gray-400 @error('first_name') border-red-500 @enderror text-slate-900 w-full text-sm rounded-md focus:outline-blue-600" />
                                        @error('first_name')
                                        <div class="mt-2 text-sm text-rose-500">
{{ $message }}
                                        </div>
                                        @enderror
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-slate-900">Last Name</label>
                                    <input wire:model="last_name" type="text" placeholder="Enter Last Name"
                                        class="px-4 py-2.5 bg-white border border-gray-400 text-slate-900 w-full @error('last_name') border-red-500 @enderror text-sm rounded-md focus:outline-blue-600" />
                                            @error('last_name')
                                        <div class="mt-2 text-sm text-rose-500">
{{ $message }}
                                        </div>
                                        @enderror
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-slate-900">Email</label>
                                    <input wire:model="email" type="email" placeholder="Enter Email"
                                        class="px-4 py-2.5 bg-white border border-gray-400  @error('email') border-red-500 @enderror text-slate-900 w-full text-sm rounded-md focus:outline-blue-600" />
                                                         @error('email')
                                        <div class="mt-2 text-sm text-rose-500">
{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-slate-900">Phone No.</label>
                                    <input wire:model="phone" type="number" placeholder="Enter Phone No."
                                        class="px-4 py-2.5 bg-white border border-gray-400 @error('phone') border-red-500 @enderror  text-slate-900 w-full text-sm rounded-md focus:outline-blue-600" />
                                               @error('phone')
                                        <div class="mt-2 text-sm text-rose-500">
{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-slate-900">Address Line</label>
                                    <input wire:model="address" type="text" placeholder="Enter Address Line"
                                        class="px-4 py-2.5 bg-white border border-gray-400 @error('address') border-red-500 @enderror  text-slate-900 w-full text-sm rounded-md focus:outline-blue-600" />
                                               @error('address')
                                        <div class="mt-2 text-sm text-rose-500">
{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-slate-900">City</label>
                                    <input wire:model="city" type="text" placeholder="Enter City"
                                        class="px-4 py-2.5 bg-white border border-gray-400 text-slate-900 @error('city') border-red-500 @enderror  w-full text-sm rounded-md focus:outline-blue-600" />
                                               @error('city')
                                        <div class="mt-2 text-sm text-rose-500">
{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-slate-900">State</label>
                                    <input wire:model="state" type="text" placeholder="Enter State"
                                        class="px-4 py-2.5 bg-white border border-gray-400 text-slate-900 w-full @error('state') border-red-500 @enderror text-sm rounded-md focus:outline-blue-600" />
                                               @error('state')
                                        <div class="mt-2 text-sm text-rose-500">
{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-slate-900">Zip Code</label>
                                    <input wire:model="zip" type="text" placeholder="Enter Zip Code"
                                        class="px-4 py-2.5 bg-white border border-gray-400 text-slate-900 w-full @error('zip') border-red-500 @enderror text-sm rounded-md focus:outline-blue-600" />
                                               @error('zip')
                                        <div class="mt-2 text-sm text-rose-500">
{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                            </div>
                        </div>


                        <div class="mt-10">
                            <h2 class="mb-6 text-xl font-semibold text-slate-900">Payment</h2>
                            <div class="flex flex-wrap mt-4 mb-8 gap-y-6 gap-x-12">
                                <div class="flex items-center">
                                    <input wire:model="payment_method" value="card" type="radio"
                                        class="w-5 h-5 cursor-pointer" id="card" checked />
                                    <label for="card" class="flex gap-2 ml-4 cursor-pointer">
                                        <img src="https://readymadeui.com/images/visa.webp" class="w-12" alt="card1" />
                                        <img src="https://readymadeui.com/images/american-express.webp" class="w-12"
                                            alt="card2" />
                                        <img src="https://readymadeui.com/images/master.webp" class="w-12"
                                            alt="card3" />
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input value="cod" type="radio" class="w-5 h-5 cursor-pointer" id="cod" />
                                    <label for="cod" class="flex gap-2 ml-4 cursor-pointer">
                                        <img src="https://png.pngtree.com/png-clipart/20210523/original/pngtree-cash-on-delivery-text-design-for-payment-sale-png-image_6328181.png"
                                            class="w-20" alt="cod" />
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input value="stripe" type="radio" name="pay-method" class="w-5 h-5 cursor-pointer"
                                        id="stripe" />
                                    <label for="stripe" class="flex gap-2 ml-4 cursor-pointer">
                                        <img src="https://cdn-icons-png.flaticon.com/512/5968/5968382.png" class="w-20"
                                            alt="stripe" />
                                    </label>
                                </div>
                            </div>
                            <div class="grid lg:grid-cols-2 gap-y-6 gap-x-4">
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-slate-900">Cardholder's
                                        Name</label>
                                    <input type="text" placeholder="Enter Cardholder's Name"
                                        class="px-4 py-2.5 bg-white border border-gray-400 text-slate-900 w-full text-sm rounded-md focus:outline-blue-600" />
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-slate-900">Card Number</label>
                                    <input type="text" placeholder="Enter Card Number"
                                        class="px-4 py-2.5 bg-white border border-gray-400 text-slate-900 w-full text-sm rounded-md focus:outline-blue-600" />
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-slate-900">Expiry</label>
                                    <input type="text" placeholder="Enter EXP."
                                        class="px-4 py-2.5 bg-white border border-gray-400 text-slate-900 w-full text-sm rounded-md focus:outline-blue-600" />
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-slate-900">CVV</label>
                                    <input type="text" placeholder="Enter CVV"
                                        class="px-4 py-2.5 bg-white border border-gray-400 text-slate-900 w-full text-sm rounded-md focus:outline-blue-600" />
                                </div>
                            </div>
                            <div class="flex gap-4 mt-8 max-lg:flex-col">
                                <button type="button"
                                    class="rounded-md px-4 py-2.5 w-full text-sm font-medium tracking-wide bg-gray-200 hover:bg-gray-300 border border-gray-300 text-slate-900 max-lg:order-1 cursor-pointer">Continue
                                    Shopping</button>
                                <button type="submit"
                                    class="rounded-md px-4 py-2.5 w-full text-sm font-medium tracking-wide bg-blue-600 hover:bg-blue-700 text-white cursor-pointer">Place
                                    Order</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="max-lg:-order-1">
                    <h2 class="mb-6 text-xl font-semibold text-slate-900">Order Summary</h2>
                    <div class="relative bg-white border border-gray-300 rounded-md">
                        <div class="px-6 py-8 md:overflow-auto">
                            <div class="space-y-4">
                                @foreach($cart_items as $ci)
                                    <div class="flex items-center gap-4 max-sm:flex-col">
                                        <div class="w-24 h-24 p-2 rounded-md bg-purple-50">
                                            <img src='{{ url('storage', $ci['image']) }}' alt="{{ $ci['name'] }}"
                                                class="object-cover w-full h-full" />
                                        </div>
                                        <div class="flex justify-between w-full gap-4">
                                            <div>
                                                <h3 class="text-sm font-medium text-slate-900">{{ $ci['name'] }}</h3>
                                                <h6 class="text-[15px] text-slate-900 font-semibold mt-4">LKR
                                                    {{ $ci['total_amount'] }}</h6>
                                            </div>
                                            <div class="flex flex-col items-end justify-between gap-4">
                                                <div>
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="inline w-4 cursor-pointer fill-red-500" viewBox="0 0 24 24">
                                                        <path
                                                            d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1Zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z"
                                                            data-original="#000000"></path>
                                                        <path
                                                            d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z"
                                                            data-original="#000000"></path>
                                                    </svg>
                                                </div>
                                                <div
                                                    class="flex items-center px-2.5 py-1.5 border border-gray-400 text-slate-900 text-xs font-medium bg-transparent rounded-md">
                                                    <button type="button" class="border-0 cursor-pointer outline-0">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 fill-current"
                                                            viewBox="0 0 124 124">
                                                            <path
                                                                d="M112 50H12C5.4 50 0 55.4 0 62s5.4 12 12 12h100c6.6 0 12-5.4 12-12s-5.4-12-12-12z">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                    <span class="mx-3">{{ $ci['quantity'] }}</span>
                                                    <button type="button" class="border-0 cursor-pointer outline-0">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 fill-current"
                                                            viewBox="0 0 42 42">
                                                            <path
                                                                d="M37.059 16H26V4.941C26 2.224 23.718 0 21 0s-5 2.224-5 4.941V16H4.941C2.224 16 0 18.282 0 21s2.224 5 4.941 5H16v11.059C16 39.776 18.282 42 21 42s5-2.224 5-4.941V26h11.059C39.776 26 42 23.718 42 21s-2.224-5-4.941-5z">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>


                            <hr class="my-6 border-gray-300" />
                            <div>
                                <ul class="space-y-4 font-medium text-slate-500">
                                    <li class="flex flex-wrap gap-4 text-sm">Subtotal <span
                                            class="ml-auto font-semibold text-slate-900">LKR. {{ $grand_total }}</span>
                                    </li>
                                    <li class="flex flex-wrap gap-4 text-sm">Shipping <span
                                            class="ml-auto font-semibold text-slate-900">LKR.0.00</span></li>
                                    <li class="flex flex-wrap gap-4 text-sm">Tax <span
                                            class="ml-auto font-semibold text-slate-900">LKR. 0.00</span></li>
                                    <hr class="border-slate-300" />
                                    <li class="flex flex-wrap gap-4 text-[15px] font-semibold text-slate-900">Total
                                        <span class="ml-auto">LKR. {{ $grand_total }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
