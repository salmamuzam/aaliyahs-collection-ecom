<div class="sm:px-8 px-4 py-6">
    <div class="bg-white rounded-md shadow-sm border border-gray-300 overflow-hidden w-full max-w-screen-xl max-lg:max-w-xl mx-auto">
        {{-- Header Section --}}
        <div class="px-6 py-4" style="background-color: #004D61;">
            <div class="flex items-center justify-between gap-2">
                <h2 class="text-xl font-bold font-playfair text-white">ORDER DETAILS</h2>
                @php
                    $paymentBadgeClass = '';
                    $paymentBadgeText = '';
                    
                    if ($order->payment_status == 'pending') {
                        $paymentBadgeClass = 'bg-yellow-200 text-yellow-800';
                        $paymentBadgeText = 'Pending';
                    } elseif ($order->payment_status == 'paid') {
                        $paymentBadgeClass = 'bg-green-200 text-green-800';
                        $paymentBadgeText = 'Paid';
                    } elseif ($order->payment_status == 'failed') {
                        $paymentBadgeClass = 'bg-red-200 text-red-800';
                        $paymentBadgeText = 'Failed';
                    }
                @endphp
                <span class="{{ $paymentBadgeClass }} text-xs font-medium px-2.5 py-1 rounded-full">{{ $paymentBadgeText }}</span>
            </div>
            <p class="text-slate-200 text-base mt-2">Here are the details of your order.</p>
        </div>

        <div class="p-6">
            {{-- Order Info Section --}}
            <div class="flex flex-wrap justify-between items-center gap-4">
                <div class="max-sm:w-[48%]">
                    <p class="text-[#1A1A1A] text-base font-bold">Order Number</p>
                    <p class="text-[#1A1A1A] text-base font-medium mt-2">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                </div>
                <div class="max-sm:w-[48%] max-sm:text-right">
                    <p class="text-[#1A1A1A] text-base font-bold">Date</p>
                    <p class="text-[#1A1A1A] text-base font-medium mt-2">{{ $order->created_at->format('F d, Y') }}</p>
                </div>
                <div class="max-sm:w-full max-sm:flex max-sm:justify-between max-sm:items-center max-sm:mt-2 max-sm:pt-2 max-sm:border-t max-sm:border-gray-200">
                    <p class="text-[#1A1A1A] text-base font-bold">Total</p>
                    <p class="text-base font-medium mt-2" style="color: #004D61;">LKR {{ number_format($order->grand_total, 2) }}</p>
                </div>
            </div>

            {{-- Shipping Information Section --}}
            <div class="bg-gray-100 rounded-md border border-gray-300 p-4 mt-8">
                <h3 class="text-xl font-bold font-playfair mb-6 uppercase" style="color: #004D61;">SHIPPING INFORMATION</h3>
                <div class="grid grid-cols-2 gap-4 lg:flex lg:flex-wrap lg:justify-between lg:w-full">
                    <div>
                        <p class="text-[#1A1A1A] text-base font-bold">Customer</p>
                        <p class="text-[#1A1A1A] text-base font-medium mt-2">{{ $address->full_name }}</p>
                    </div>
                    <div class="max-sm:text-right">
                        <p class="text-[#1A1A1A] text-base font-bold">Order Status</p>
                        @php
                            $statusBadge = '';
                            if ($order->status == 'cancelled') {
                                $statusBadge = '<span class="px-2 py-1 text-xs font-medium uppercase tracking-wider text-red-800 bg-red-200 rounded-lg bg-opacity-50">Cancelled</span>';
                            } elseif ($order->status == 'delivered') {
                                $statusBadge = '<span class="px-2 py-1 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50">Delivered</span>';
                            } elseif ($order->status == 'shipped') {
                                $statusBadge = '<span class="px-2 py-1 text-xs font-medium uppercase tracking-wider text-blue-800 bg-blue-200 rounded-lg bg-opacity-50">Shipped</span>';
                            } elseif ($order->status == 'processing') {
                                $statusBadge = '<span class="px-2 py-1 text-xs font-medium uppercase tracking-wider text-cyan-800 bg-cyan-200 rounded-lg bg-opacity-50">Processing</span>';
                            } elseif ($order->status == 'new') {
                                $statusBadge = '<span class="px-2 py-1 text-xs font-medium uppercase tracking-wider text-purple-800 bg-purple-200 rounded-lg bg-opacity-50">New</span>';
                            } else {
                                $statusBadge = '<span class="px-2 py-1 text-xs font-medium uppercase tracking-wider text-gray-800 bg-gray-200 rounded-lg bg-opacity-50">'.ucfirst($order->status).'</span>';
                            }
                        @endphp
                        <div class="mt-2 text-base font-medium">{!! $statusBadge !!}</div>
                    </div>
                    <div>
                        <p class="text-[#1A1A1A] text-base font-bold">Address</p>
                        <p class="text-[#1A1A1A] text-base font-medium mt-2">{{ $address->street_address }}</p>
                    </div>
                    <div class="max-sm:text-right">
                        <p class="text-[#1A1A1A] text-base font-bold">Phone</p>
                        <p class="text-[#1A1A1A] text-base font-medium mt-2">{{ $address->phone }}</p>
                    </div>
                </div>
            </div>

            {{-- Order Items Section --}}
            <div class="mt-8">
                <h3 class="text-xl font-bold font-playfair mb-6 uppercase" style="color: #004D61;">ORDER ITEMS ({{ $order_items->count() }})</h3>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-x-12 lg:gap-y-4">
                    @foreach($order_items as $item)
                        <div wire:key="{{ $item->id }}" class="flex items-center gap-4 max-sm:flex-col lg:py-4 {{ !$loop->first ? 'max-sm:border-t max-sm:pt-4 max-sm:border-gray-300' : '' }}">
                            <div class="w-24 h-auto shrink-0 rounded-md overflow-hidden aspect-[3/4] border border-gray-300">
                                <img src="{{ url('storage', $item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover object-top" />
                            </div>
                            <div class="flex-1 max-sm:text-center">
                                <h4 class="text-base font-medium text-[#1A1A1A]">{{ $item->product->name }}</h4>
                                <div class="mt-2">
                                     <div class="flex items-center px-2.5 py-1.5 border border-gray-400 text-[#1A1A1A] text-xs font-medium font-sans outline-0 bg-[#ccdbdf] rounded-md w-fit max-sm:mx-auto">
                                        <span class="font-bold mr-1">Qty:</span> {{ $item->quantity }}
                                    </div>
                                </div>
                            </div>
                            <div class="text-right max-sm:text-center max-sm:w-full">
                                <p class="text-[#1A1A1A] text-base font-semibold">LKR {{ number_format($item->total_amount, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Order Summary Section --}}
            <div class="bg-gray-100 rounded-md border border-gray-300 p-4 mt-8">
                <h3 class="text-xl font-bold font-playfair mb-6 uppercase" style="color: #004D61;">ORDER SUMMARY</h3>
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <p class="text-base text-[#1A1A1A] font-bold">Subtotal</p>
                        <p class="text-[#1A1A1A] text-base font-normal">LKR {{ number_format($order->grand_total, 2) }}</p>
                    </div>
                    <div class="flex justify-between pt-3 border-t border-gray-300">
                        <p class="text-[15px] font-bold text-[#1A1A1A]">Total</p>
                        <p class="text-[15px] font-semibold" style="color: #004D61;">LKR {{ number_format($order->grand_total, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
