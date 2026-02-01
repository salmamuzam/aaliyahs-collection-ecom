<div class="hidden md:block overflow-hidden brand-card">
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white table-fixed">
            <thead class="brand-table-thead">
                <tr>
                    <th class="brand-table-th w-1/6">Order ID</th>
                    <th class="brand-table-th w-2/6">Customer</th>
                    <th class="brand-table-th w-1/6">Status</th>
                    <th class="brand-table-th w-1/6">Payment</th>
                    <th class="brand-table-th w-1/6">Total</th>

                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 whitespace-nowrap">
                @forelse($recentOrders as $order)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="p-4 text-base text-brand-black font-medium font-sans text-center">#{{ $order->id }}</td>
                        <td class="p-4 text-base text-brand-black font-medium font-sans text-center">{{ $order->user->first_name . ' ' . $order->user->last_name ?? 'Guest' }}</td>
                        <td class="p-4 text-center font-sans">
                            <x-admin.orders.status-badge :status="$order->status" />
                        </td>
                        <td class="p-4 text-center">
                            <x-admin.common.badge :variant="$order->payment_status == 'paid' ? 'success' : 'danger'">
                                {{ $order->payment_status }}
                            </x-admin.badge>
                        </td>
                        <td class="p-4 text-base text-brand-black font-medium font-sans text-center">LKR {{ number_format($order->grand_total, 2) }}</td>

                    </tr>
                @empty
                    @include('livewire.admin.partials.no-results', ['message' => 'No recent orders found.', 'colspan' => 5])
                @endforelse
            </tbody>
        </table>
    </div>
</div>

