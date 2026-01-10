<div class="px-6 lg:px-12 pt-6 lg:pt-10 pb-4 lg:pb-8">
    <x-admin.page-header title="All Orders" />
    <div class="mt-1">
        @include('livewire.includes.admin-alerts')
    </div>
    @include('livewire.includes.search-box', ['placeholder' => 'Search by Order ID or Customer Name...'])

    <div class="hidden md:block overflow-hidden brand-card">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white table-fixed">
                <thead class="brand-table-thead">
                    <tr>
                        <th class="brand-table-th w-1/12">
                            Order ID
                            @include('livewire.includes.table-sort-icon', ['field' => 'id'])
                        </th>
                        <th class="brand-table-th w-3/12">
                            Customer
                            @include('livewire.includes.table-sort-icon', ['field' => 'customer'])
                        </th>
                        <th class="brand-table-th w-2/12">
                            Status
                            @include('livewire.includes.table-sort-icon', ['field' => 'status'])
                        </th>
                        <th class="brand-table-th w-2/12">
                            Payment
                            @include('livewire.includes.table-sort-icon', ['field' => 'payment_status'])
                        </th>
                        <th class="brand-table-th w-2/12">
                            Total
                            @include('livewire.includes.table-sort-icon', ['field' => 'grand_total'])
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
                                <x-admin.status-badge :status="$order->status" />
                            </td>
                            <td class="p-4 text-center">
                                <x-admin.payment-status-badge :status="$order->payment_status" />
                            </td>
                            <td class="p-4 text-center text-base text-brand-black">
                                LKR {{ number_format($order->grand_total, 2) }}
                            </td>
                            <td class="p-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                <a wire:navigate href="{{ route('orders.view', $order->id) }}" title="View Details"
                                    class="p-2 text-amber-600 hover:bg-amber-50 rounded-md transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                @if($order->status == 'new' || $order->status == 'cancelled')
                                                <button type="button" wire:click="approveOrder({{ $order->id }})" wire:loading.attr="disabled" wire:target="approveOrder({{ $order->id }}), cancelOrder({{ $order->id }})" title="Approve"
                                                    class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-md cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none">
                                                    <svg wire:loading.remove wire:target="approveOrder({{ $order->id }})" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    <svg wire:loading wire:target="approveOrder({{ $order->id }})" class="brand-spinner h-5 w-5 text-emerald-600" style="shape-rendering: optimizeSpeed;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                    </svg>
                                                </button>
                                        @endif

                                        @if($order->payment_method == 'cod' && $order->payment_status != 'paid')
                                                 <button type="button" wire:click="markAsPaid({{ $order->id }})" wire:loading.attr="disabled" wire:target="markAsPaid({{ $order->id }})" title="Mark as Paid"
                                                     class="p-2 text-blue-600 hover:bg-blue-50 rounded-md cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none">
                                                     <svg wire:loading.remove wire:target="markAsPaid({{ $order->id }})" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                     </svg>
                                                     <svg wire:loading wire:target="markAsPaid({{ $order->id }})" class="brand-spinner h-5 w-5 text-blue-600" style="shape-rendering: optimizeSpeed;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                         <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                     </svg>
                                                 </button>
                                         @endif

                                         @if($order->payment_method == 'cod' && $order->payment_status != 'paid')
                                    <button type="button" wire:click="markAsPaid({{ $order->id }})" wire:loading.attr="disabled" wire:target="markAsPaid({{ $order->id }})" title="Mark as Paid"
                                        class="bg-blue-50 hover:bg-blue-100 w-10 h-10 flex items-center justify-center rounded-md cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none">
                                        <svg wire:loading.remove wire:target="markAsPaid({{ $order->id }})" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <svg wire:loading wire:target="markAsPaid({{ $order->id }})" class="brand-spinner h-5 w-5 text-blue-600" style="shape-rendering: optimizeSpeed;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </button>
                                @endif

                                @if($order->status == 'new' || $order->status == 'processing')
                                                <button type="button" wire:click="cancelOrder({{ $order->id }})" wire:loading.attr="disabled" wire:target="approveOrder({{ $order->id }}), cancelOrder({{ $order->id }})" title="Cancel"
                                                    class="p-2 text-rose-600 hover:bg-rose-50 rounded-md cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none">
                                                    <svg wire:loading.remove wire:target="cancelOrder({{ $order->id }})" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                    <svg wire:loading wire:target="cancelOrder({{ $order->id }})" class="brand-spinner h-5 w-5 text-rose-600" style="shape-rendering: optimizeSpeed;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                    </svg>
                                                </button>
                                        @endif
                                    </div>
                            </td>
                        </tr>
                    @empty
                        @include('livewire.includes.admin-no-results', ['message' => 'No orders found.', 'colspan' => 6])
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
            <div class="p-4 border-t border-gray-200 uppercase bg-gray-50 text-sm">
                {{ $orders->links() }}
            </div>
        @endif
    </div>

    {{-- Mobile View --}}
    <div class="md:hidden space-y-4">
        @forelse ($orders as $order)
            <x-admin.mobile-order-card :order="$order">
                 <x-slot:actions>
                    <div class="flex items-center justify-center gap-2">
                        <a wire:navigate href="{{ route('orders.view', $order->id) }}" title="View Details"
                            class="p-2 text-amber-600 hover:bg-amber-50 rounded-md transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </a>
                        @if($order->status == 'new' || $order->status == 'cancelled')
                                <button type="button" wire:click="approveOrder({{ $order->id }})" wire:loading.attr="disabled" wire:target="approveOrder({{ $order->id }}), cancelOrder({{ $order->id }})" title="Approve"
                                    class="bg-emerald-50 hover:bg-emerald-100 w-10 h-10 flex items-center justify-center rounded-md cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none">
                                    <svg wire:loading.remove wire:target="approveOrder({{ $order->id }})" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <svg wire:loading wire:target="approveOrder({{ $order->id }})" class="brand-spinner h-5 w-5 text-emerald-600" style="shape-rendering: optimizeSpeed;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </button>
                            @endif

                            @if($order->status == 'new' || $order->status == 'processing')
                                <button type="button" wire:click="cancelOrder({{ $order->id }})" wire:loading.attr="disabled" wire:target="approveOrder({{ $order->id }}), cancelOrder({{ $order->id }})" title="Cancel"
                                    class="bg-rose-50 hover:bg-rose-100 w-10 h-10 flex items-center justify-center rounded-md cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none">
                                    <svg wire:loading.remove wire:target="cancelOrder({{ $order->id }})" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    <svg wire:loading wire:target="cancelOrder({{ $order->id }})" class="brand-spinner h-5 w-5 text-rose-600" style="shape-rendering: optimizeSpeed;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </button>
                            @endif
                        </div>
                 </x-slot:actions>
            </x-admin.mobile-order-card>
        @empty
            <div class="text-center p-6 bg-white brand-card">
                <p class="text-gray-500">No orders found.</p>
            </div>
        @endforelse

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>
</div>
