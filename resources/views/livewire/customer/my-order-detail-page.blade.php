<div class="sm:px-8 px-4 py-6">
    <div class="bg-white rounded-md shadow-sm border border-gray-300 overflow-hidden w-full max-w-screen-xl max-lg:max-w-xl mx-auto">
        {{-- Header Section --}}
        <div class="px-6 py-4 bg-brand-teal">
            <div class="flex items-center justify-between gap-2">
                <h2 class="text-xl font-bold brand-heading-playfair text-white">ORDER DETAILS</h2>
                <x-customer.badge :status="$order->payment_status" class="px-2.5 py-1 rounded-full !bg-white !bg-opacity-100" />
            </div>
            <p class="text-slate-100 text-base mt-2">Here are the details of your order.</p>
        </div>

        <div class="p-6">
            {{-- Order Info Section --}}
            <div class="flex flex-wrap justify-between items-center gap-4">
                <div class="max-sm:w-[48%]">
                    <p class="text-brand-black text-base font-bold">Order Number</p>
                    <p class="text-brand-black text-base font-medium mt-2">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                </div>
                <div class="max-sm:w-[48%] max-sm:text-right">
                    <p class="text-brand-black text-base font-bold">Date</p>
                    <p class="text-brand-black text-base font-medium mt-2">{{ $order->created_at->format('F d, Y') }}</p>
                </div>
                <div class="max-sm:w-full max-sm:flex max-sm:justify-between max-sm:items-center max-sm:mt-2 max-sm:pt-2 max-sm:border-t max-sm:border-gray-200">
                    <p class="text-brand-black text-base font-bold">Total</p>
                    <p class="text-base font-medium mt-2 text-brand-teal">LKR {{ number_format($order->grand_total, 2) }}</p>
                </div>
            </div>

            {{-- Shipping Information Section --}}
            <div class="bg-gray-100 rounded-md border border-gray-300 p-4 mt-8 text-brand-black">
                <h3 class="text-xl font-bold brand-heading-playfair mb-6 uppercase text-brand-teal">SHIPPING INFORMATION</h3>
                <div class="grid grid-cols-2 gap-4 lg:flex lg:flex-wrap lg:justify-between lg:w-full">
                    <div>
                        <p class="text-brand-black text-base font-bold">Customer</p>
                        <p class="text-brand-black text-base font-medium mt-2">{{ $address->full_name }}</p>
                    </div>
                    <div class="max-sm:text-right">
                        <p class="text-brand-black text-base font-bold">Order Status</p>
                        <div class="mt-2 text-base font-medium">
                            <x-customer.badge :status="$order->status" />
                        </div>
                    </div>
                    <div>
                        <p class="text-brand-black text-base font-bold">Address</p>
                        <p class="text-brand-black text-base font-medium mt-2">{{ $address->street_address }}</p>
                    </div>
                    <div class="max-sm:text-right">
                        <p class="text-brand-black text-base font-bold">Phone</p>
                        <p class="text-brand-black text-base font-medium mt-2">{{ $address->phone }}</p>
                    </div>
                </div>
            </div>

            {{-- Order Items Section --}}
            <div class="mt-8">
                <h3 class="text-xl font-bold brand-heading-playfair mb-6 uppercase text-brand-teal">ORDER ITEMS ({{ $order_items->count() }})</h3>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-x-12 lg:gap-y-4">
                    @foreach($order_items as $item)
                        <div wire:key="{{ $item->id }}" class="flex items-center gap-4 max-sm:flex-col lg:py-4 {{ !$loop->first ? 'max-sm:border-t max-sm:pt-4 max-sm:border-gray-300' : '' }}">
                            <div class="w-24 h-auto shrink-0 rounded-md overflow-hidden aspect-[3/4] border border-gray-300">
                                <img src="{{ url('storage', $item->product->images[0]) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover object-top" />
                            </div>
                            <div class="flex-1 max-sm:text-center">
                                <h4 class="text-base font-medium text-brand-black">{{ $item->product->name }}</h4>
                                <div class="mt-2">
                                     <div class="flex items-center px-2.5 py-1.5 border border-gray-400 text-brand-black text-xs font-medium font-sans outline-0 bg-brand-teal bg-opacity-10 rounded-md w-fit max-sm:mx-auto">
                                        <span class="font-bold mr-1">Qty:</span> {{ $item->quantity }}
                                    </div>
                                </div>
                            </div>
                            <div class="text-right max-sm:text-center max-sm:w-full">
                                <p class="text-brand-black text-base font-semibold">LKR {{ number_format($item->total_amount, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Order Summary Section --}}
            <div class="bg-gray-100 rounded-md border border-gray-300 p-4 mt-8">
                <h3 class="text-xl font-bold brand-heading-playfair mb-6 uppercase text-brand-teal">ORDER SUMMARY</h3>
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <p class="text-base text-brand-black font-bold">Subtotal</p>
                        <p class="text-brand-black text-base font-normal">LKR {{ number_format($order->grand_total, 2) }}</p>
                    </div>
                    <div class="flex justify-between pt-3 border-t border-gray-300">
                        <p class="text-[15px] font-bold text-brand-black">Total</p>
                        <p class="text-[15px] font-semibold text-brand-teal">LKR {{ number_format($order->grand_total, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
