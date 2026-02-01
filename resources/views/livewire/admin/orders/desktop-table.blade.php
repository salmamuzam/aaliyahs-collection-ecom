<div class="hidden md:block overflow-hidden brand-card">
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white table-fixed">
            <thead class="brand-table-thead">
                <tr>
                    <th class="brand-table-th w-1/12">
                        Order ID
                        @include('livewire.admin.partials.table-sort-icon', ['field' => 'id'])
                    </th>
                    <th class="brand-table-th w-3/12">
                        Customer
                        @include('livewire.admin.partials.table-sort-icon', ['field' => 'customer'])
                    </th>
                    <th class="brand-table-th w-2/12">
                        Status
                        @include('livewire.admin.partials.table-sort-icon', ['field' => 'status'])
                    </th>
                    <th class="brand-table-th w-2/12">
                        Payment
                        @include('livewire.admin.partials.table-sort-icon', ['field' => 'payment_status'])
                    </th>
                    <th class="brand-table-th w-2/12">
                        Total
                        @include('livewire.admin.partials.table-sort-icon', ['field' => 'grand_total'])
                    </th>
                    <th class="brand-table-th w-2/12">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 whitespace-nowrap">
                @forelse ($orders as $order)
                    <tr class="hover:bg-gray-100 transition-colors">
                        <td class="p-4 text-base text-brand-black font-medium text-center">#{{ $order->id }}</td>
                        <td class="p-4 text-base text-brand-black font-medium text-center">
                            {{ $order->address->first_name }} {{ $order->address->last_name }}
                        </td>
                        <td class="p-4 text-center">
                            <x-admin.orders.status-badge :status="$order->status" />
                        </td>
                        <td class="p-4 text-center">
                            <x-admin.orders.payment-status-badge :status="$order->payment_status" />
                        </td>
                        <td class="p-4 text-center text-base text-brand-black">
                            LKR {{ number_format($order->grand_total, 2) }}
                        </td>
                        <td class="p-4 text-center">
                            @include('livewire.admin.orders.action-buttons')
                        </td>
                    </tr>
                @empty
                    @include('livewire.admin.partials.no-results', ['message' => 'No orders found.', 'colspan' => 6])
                @endforelse
            </tbody>
        </table>
    </div>
</div>

