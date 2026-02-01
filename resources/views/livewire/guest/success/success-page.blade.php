<x-layouts.app>
<section class="py-4 md:py-6">
    <div class="p-6 mx-auto max-w-7xl max-lg:max-w-4xl">
        <x-shared.sections.section-header title="THANKS FOR YOUR ORDER!" size="text-xl" />
        <p class="mb-6 text-base text-brand-black md:mb-8">Your order <a href="/my-orders" wire:navigate
                class="font-medium text-brand-burgundy hover:underline">{{ $order->id }}</a> has been received.</p>
        @include('livewire.guest.success.order-info')
        @include('livewire.guest.success.action-buttons')
    </div>
</section>
</x-layouts.app>
