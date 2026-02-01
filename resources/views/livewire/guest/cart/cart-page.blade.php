<div class="w-full">
    <div class="">
        <div class="p-6 mx-auto max-w-7xl max-lg:max-w-4xl">
            @include('livewire.guest.partials.alerts')
            <x-shared.sections.section-header title="YOUR SHOPPING CART" />

            <div class="relative grid gap-4 mt-6 lg:grid-cols-3">
                <div class="space-y-4 lg:col-span-2">
                    @forelse($cart_items as $item)
                        @include('livewire.guest.cart.cart-item')
                    @empty
                        @include('livewire.guest.partials.empty-state', [
                            'title' => 'Your shopping cart is empty!',
                            'icon' => '<path d="M20 7h-4V5c0-2.206-1.794-4-4-4S8 2.794 8 5v2H4c-1.103 0-2 .897-2 2v11c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V9c0-1.103-.897-2-2-2zM10 5c0-1.103.897-2 2-2s2 .897 2 2v2h-4V5zm10 15H4V9h4v2c0 .552.448 1 1 1s1-.448 1-1V9h4v2c0 .552.448 1 1 1s1-.448 1-1V9h4v11z" />'
                        ])
                    @endforelse

                </div>

                @include('livewire.guest.cart.order-summary')
            </div>
        </div>
    </div>
</div>
