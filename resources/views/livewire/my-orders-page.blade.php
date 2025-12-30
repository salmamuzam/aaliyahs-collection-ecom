<div class="w-full">
    <div class="">
        <div class="p-6 mx-auto max-w-7xl max-lg:max-w-4xl">
            <h1 class="text-2xl mb-6 font-bold font-playfair text-[#004D61]">YOUR ORDERS</h1>

        @if(count($orders) > 0)
        <!-- Desktop Table View -->
        <div class="hidden overflow-auto bg-white border border-gray-300 rounded-md shadow-sm md:block">
            <table class="w-full">
                <thead class="border-b-2 border-gray-200 bg-gray-50">
                    <tr>
                        <th class="w-24 p-3 text-base font-semibold font-sans tracking-wide text-center text-[#1A1A1A] whitespace-nowrap">Order ID</th>
                        <th class="w-32 p-3 text-base font-semibold font-sans tracking-wide text-center text-[#1A1A1A]">Date</th>
                        <th class="w-32 p-3 text-base font-semibold font-sans tracking-wide text-center text-[#1A1A1A]">Status</th>
                        <th class="w-32 p-3 text-base font-semibold font-sans tracking-wide text-center text-[#1A1A1A]">Payment</th>
                        <th class="w-36 p-3 text-base font-semibold font-sans tracking-wide text-center text-[#1A1A1A]">Total</th>
                        <th class="w-24 p-3 text-base font-semibold font-sans tracking-wide text-center text-[#1A1A1A]">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($orders as $order)
                        @php
                            $statusBadge = '';
                            // Cancelled - Red badge
                            if ($order->status == 'cancelled') {
                                $statusBadge = '<span class="p-1.5 text-xs font-medium uppercase tracking-wider text-red-800 bg-red-200 rounded-lg bg-opacity-50">Cancelled</span>';
                            }
                            // Delivered - Green badge
                            if ($order->status == 'delivered') {
                                $statusBadge = '<span class="p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50">Delivered</span>';
                            }
                            // Shipped - Blue badge
                            if ($order->status == 'shipped') {
                                $statusBadge = '<span class="p-1.5 text-xs font-medium uppercase tracking-wider text-blue-800 bg-blue-200 rounded-lg bg-opacity-50">Shipped</span>';
                            }
                            // Processing - Cyan badge
                            if ($order->status == 'processing') {
                                $statusBadge = '<span class="p-1.5 text-xs font-medium uppercase tracking-wider text-cyan-800 bg-cyan-200 rounded-lg bg-opacity-50">Processing</span>';
                            }
                            // New - Purple badge
                            if ($order->status == 'new') {
                                $statusBadge = '<span class="p-1.5 text-xs font-medium uppercase tracking-wider text-purple-800 bg-purple-200 rounded-lg bg-opacity-50">New</span>';
                            }

                            if($order->payment_status == 'pending'){
                                $paymentBadge = '<span class="p-1.5 text-xs font-medium tracking-wider text-purple-800 uppercase bg-purple-200 bg-opacity-50 rounded-lg">Pending</span>';
                            }

                             if($order->payment_status == 'paid'){
                                $paymentBadge = '<span class="p-1.5 text-xs font-medium tracking-wider text-cyan-800 uppercase bg-cyan-200 bg-opacity-50 rounded-lg">Paid</span>';
                            }
                             if($order->payment_status == 'failed'){
                                $paymentBadge = '<span class="p-1.5 text-xs font-medium tracking-wider text-blue-800 uppercase bg-blue-200 bg-opacity-50 rounded-lg">Failed</span>';
                            }
                        @endphp
                        <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                            <td class="p-3 text-base font-sans text-[#1A1A1A] whitespace-nowrap text-center">
                                <a href="/my-orders/{{ $order->id }}" class="font-bold text-blue-500 hover:underline">#{{ $order->id }}</a>
                            </td>
                            <td class="p-3 text-base font-sans text-[#1A1A1A] whitespace-nowrap text-center">
                                {{ $order->created_at->format('d/m/Y') }}
                            </td>
                            <td class="p-3 text-base font-sans text-[#1A1A1A] whitespace-nowrap">
                                <div class="flex justify-center">
                                    {!! $statusBadge !!}
                                </div>
                            </td>
                            <td class="p-3 text-base font-sans text-[#1A1A1A] whitespace-nowrap">
                                <div class="flex justify-center">
                                    {!! $paymentBadge !!}
                                </div>
                            </td>
                            <td class="p-3 text-base font-sans text-[#1A1A1A] whitespace-nowrap font-medium text-center">
                                LKR {{ number_format($order->grand_total, 2) }}
                            </td>
                            <td class="p-3 text-base font-sans text-[#1A1A1A] whitespace-nowrap text-center">
                                <a href="/my-orders/{{ $order->id }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-amber-700 hover:bg-amber-800 focus:ring-4 focus:outline-none focus:ring-amber-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-2 -ml-0.5">
                                        <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                    </svg>
                                    View
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
                @php
                    $statusBadge = '';
                    $paymentBadge = '';
                    // Cancelled - Red badge
                    if ($order->status == 'cancelled') {
                        $statusBadge = '<span class="p-1.5 text-xs font-medium uppercase tracking-wider text-red-800 bg-red-200 rounded-lg bg-opacity-50">Cancelled</span>';
                    }
                    // Delivered - Green badge
                    if ($order->status == 'delivered') {
                        $statusBadge = '<span class="p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50">Delivered</span>';
                    }
                    // Shipped - Blue badge
                    if ($order->status == 'shipped') {
                        $statusBadge = '<span class="p-1.5 text-xs font-medium uppercase tracking-wider text-blue-800 bg-blue-200 rounded-lg bg-opacity-50">Shipped</span>';
                    }
                    // Processing - Cyan badge
                    if ($order->status == 'processing') {
                        $statusBadge = '<span class="p-1.5 text-xs font-medium uppercase tracking-wider text-cyan-800 bg-cyan-200 rounded-lg bg-opacity-50">Processing</span>';
                    }
                    // New - Purple badge
                    if ($order->status == 'new') {
                        $statusBadge = '<span class="p-1.5 text-xs font-medium uppercase tracking-wider text-purple-800 bg-purple-200 rounded-lg bg-opacity-50">New</span>';
                    }

                    // Payment status badges
                    if($order->payment_status == 'pending'){
                        $paymentBadge = '<span class="p-1.5 text-xs font-medium tracking-wider text-purple-800 uppercase bg-purple-200 bg-opacity-50 rounded-lg">Pending</span>';
                    }
                    if($order->payment_status == 'paid'){
                        $paymentBadge = '<span class="p-1.5 text-xs font-medium tracking-wider text-cyan-800 uppercase bg-cyan-200 bg-opacity-50 rounded-lg">Paid</span>';
                    }
                    if($order->payment_status == 'failed'){
                        $paymentBadge = '<span class="p-1.5 text-xs font-medium tracking-wider text-blue-800 uppercase bg-blue-200 bg-opacity-50 rounded-lg">Failed</span>';
                    }
                @endphp
                <div class="p-4 space-y-3 bg-white border border-gray-300 rounded-md shadow-sm">
                    <div class="flex items-center space-x-2 text-base">
                        <div>
                            <a href="/my-orders/{{ $order->id }}" class="text-[#004D61] font-bold hover:underline">#{{ $order->id }}</a>
                        </div>
                        <div class="font-sans text-[#1A1A1A]">{{ $order->created_at->format('d/m/Y') }}</div>
                        <div>
                            {!! $statusBadge !!}
                        </div>
                    </div>
                    <div class="text-base font-sans text-[#1A1A1A]">
                        <span class="font-bold">Payment:</span>
                        {!! $paymentBadge !!}
                    </div>
                    <div class="text-base font-medium font-sans text-[#1A1A1A]">
                        LKR {{ number_format($order->grand_total, 2) }}
                    </div>
                    <div>
                        <a href="/my-orders/{{ $order->id }}" class="text-[#004D61] hover:underline text-base font-medium">View details →</a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $orders->links() }}
        </div>
        @else
            <div class="col-span-full relative w-full p-6 mx-auto bg-white border border-gray-300 rounded-md shadow-sm">
                <div class="flex flex-col items-center justify-center py-12">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mb-6 text-[#3E5641]">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <p class="text-xl text-center font-playfair text-[#1A1A1A]">No orders found!</p>
                </div>
            </div>
        @endif
        </div>
    </div>
</div>
