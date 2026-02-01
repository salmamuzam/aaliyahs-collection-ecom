<div class="sm:px-8 px-4 py-6">
    <div class="bg-white rounded-md shadow-sm border border-gray-300 overflow-hidden w-full max-w-screen-xl max-lg:max-w-xl mx-auto">
        {{-- Header Section --}}
        @include('livewire.customer.orders.order-header')

        <div class="p-6">
            {{-- Order Info Section --}}
            @include('livewire.customer.orders.order-info')

            {{-- Shipping Information Section --}}
            @include('livewire.customer.orders.shipping-info')

            {{-- Order Items Section --}}
            @include('livewire.customer.orders.order-items')

            {{-- Order Summary Section --}}
            @include('livewire.customer.orders.order-summary')
        </div>
        
        {{-- Footer Actions --}}
        @include('livewire.customer.orders.order-actions')

    </div>
</div>
