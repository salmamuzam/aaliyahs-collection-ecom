<div class="px-4 py-6 sm:px-8">
      <div class="max-w-screen-xl mx-auto max-lg:max-w-xl">
        @include('livewire.guest.partials.alerts')
        <div class="grid gap-12 lg:grid-cols-2">
            <!-- Order Summary (Left Column) -->
            @include('livewire.customer.checkout.order-summary')

            <!-- Form (Right Column) -->
            @include('livewire.customer.checkout.checkout-form')
        </div>
      </div>
    </div>
