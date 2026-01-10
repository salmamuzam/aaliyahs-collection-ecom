<div class="px-6 lg:px-12 pt-6 lg:pt-10 pb-4 lg:pb-8">
    <x-admin.page-header title="Order Details #{{ $order->id }}">
        <x-slot:actions>
            <a wire:navigate href="{{ route('admin.orders') }}"
                class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Orders
            </a>
        </x-slot:actions>
    </x-admin.page-header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Left Column: Order Items --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="brand-card overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-brand-black">Order Items</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    @foreach($order->items as $item)
                        <div class="p-6 flex items-center gap-6">
                            <div class="w-20 h-24 flex-shrink-0 bg-gray-100 rounded-md overflow-hidden border border-gray-200">
                                @if(!empty($item->product->images))
                                    <img src="{{ url('storage', $item->product->images[0]) }}" class="w-full h-full object-cover object-top">
                                @endif
                            </div>
                            <div class="flex-1">
                                <h4 class="text-base font-bold text-brand-black">{{ $item->product->name }}</h4>
                                <p class="text-sm text-gray-500 mt-1">Quantity: {{ $item->quantity }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-base font-bold text-brand-black">LKR {{ number_format($item->total_amount, 2) }}</p>
                                <p class="text-xs text-gray-500">LKR {{ number_format($item->unit_amount, 2) }} each</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    <div class="flex justify-between items-center text-lg font-bold text-brand-black">
                        <span>Total Amount</span>
                        <span class="text-brand-burgundy">LKR {{ number_format($order->grand_total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Column: Order Info --}}
        <div class="space-y-6">
            {{-- Status Card --}}
            <div class="brand-card p-6 space-y-4">
                <h3 class="text-lg font-bold text-brand-black border-b border-gray-100 pb-2">Order Status</h3>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-500 uppercase font-bold tracking-wider">Status</span>
                    <x-admin.status-badge :status="$order->status" />
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-500 uppercase font-bold tracking-wider">Payment Status</span>
                    <x-admin.payment-status-badge :status="$order->payment_status" />
                </div>
                <div class="flex justify-between items-center pt-2">
                    <span class="text-sm text-gray-500 uppercase font-bold tracking-wider">Method</span>
                    <span class="text-sm font-bold text-brand-black uppercase">{{ $order->payment_method }}</span>
                </div>
            </div>

            {{-- Shipping Info --}}
            <div class="brand-card p-6 space-y-4">
                <h3 class="text-lg font-bold text-brand-black border-b border-gray-100 pb-2">Shipping Information</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Customer Name</p>
                        <p class="text-base font-medium text-brand-black">{{ $order->address->first_name }} {{ $order->address->last_name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Email</p>
                        <p class="text-base font-medium text-brand-black">{{ $order->user->email ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Phone</p>
                        <p class="text-base font-medium text-brand-black">{{ $order->address->phone }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Address</p>
                        <p class="text-base font-medium text-brand-black">{{ $order->address->street_address }}</p>
                        <p class="text-base font-medium text-brand-black">{{ $order->address->city }}, {{ $order->address->state }} {{ $order->address->zip_code }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
