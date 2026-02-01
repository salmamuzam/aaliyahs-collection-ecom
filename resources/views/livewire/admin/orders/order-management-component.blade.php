<div class="px-6 lg:px-12 pt-6 lg:pt-10 pb-4 lg:pb-8">
    <x-admin.common.page-header title="All Orders" />
    <div class="mt-1">
        @include('livewire.admin.partials.alerts')
    </div>
    @include('livewire.admin.partials.search-box', ['placeholder' => 'Search by Order ID or Customer Name...'])

    @include('livewire.admin.orders.desktop-table')
    @if($orders->hasPages())
        <div class="p-4 border-t border-gray-200 uppercase bg-gray-50 text-sm">
            {{ $orders->links() }}
        </div>
    @endif

    {{-- Mobile View --}}
    <div class="md:hidden space-y-4">
        @forelse ($orders as $order)
            <x-admin.orders.mobile-card :order="$order">
                 <x-slot:actions>
                    @include('livewire.admin.orders.action-buttons')
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

