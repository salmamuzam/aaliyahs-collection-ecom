<div class="w-full">
    <div class="">
        <div class="px-6 pt-6 pb-6 mx-auto max-w-7xl max-lg:max-w-4xl">
            <x-customer.page-header title="YOUR ORDERS" />

        @if(count($orders) > 0)
        <!-- Desktop Table View -->
        <div class="hidden overflow-auto bg-white border border-gray-300 rounded-md shadow-sm md:block">
            <table class="w-full">
                <thead class="brand-table-thead">
                    <tr>
                        <th class="brand-table-th">Order ID</th>
                        <th class="brand-table-th">Date</th>
                        <th class="brand-table-th">Status</th>
                        <th class="brand-table-th">Payment</th>
                        <th class="brand-table-th">Total</th>
                        <th class="brand-table-th">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($orders as $order)
                        <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                            <td class="p-3 text-base font-sans text-brand-black whitespace-nowrap text-center">
                                <a href="/my-orders/{{ $order->id }}" class="font-bold text-blue-500 hover:underline">#{{ $order->id }}</a>
                            </td>
                            <td class="p-3 text-base font-sans text-brand-black whitespace-nowrap text-center">
                                {{ $order->created_at->format('d/m/Y') }}
                            </td>
                            <td class="p-3 text-base font-sans text-brand-black whitespace-nowrap">
                                <div class="flex justify-center">
                                    <x-customer.badge :status="$order->status" />
                                </div>
                            </td>
                            <td class="p-3 text-base font-sans text-brand-black whitespace-nowrap">
                                <div class="flex justify-center">
                                    <x-customer.badge :status="$order->payment_status" />
                                </div>
                            </td>
                            <td class="p-3 text-base font-sans text-brand-black whitespace-nowrap font-medium text-center">
                                LKR {{ number_format($order->grand_total, 2) }}
                            </td>
                            <td class="p-3 text-base font-sans text-brand-black whitespace-nowrap text-center">
                                <a href="/my-orders/{{ $order->id }}" title="View"
                                    class="p-2 text-amber-600 hover:bg-amber-50 rounded-md transition-colors inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:hidden">
            @foreach($orders as $order)
                <x-customer.mobile-order-card :order="$order" />
            @endforeach
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
            <div class="mt-6 mb-4 uppercase text-base font-medium">
                {{ $orders->links() }}
            </div>
        @endif
        @else
            <div class="col-span-full relative w-full p-6 mx-auto brand-card">
                @include('livewire.includes.empty-state', [
                    'title' => 'No orders found!',
                    'stroke' => true,
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />'
                ])
            </div>
        @endif
        </div>
    </div>
</div>
