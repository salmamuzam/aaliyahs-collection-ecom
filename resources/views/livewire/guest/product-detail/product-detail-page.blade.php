<div class="sm:pt-8 pt-6 sm:pb-0 pb-0 bg-brand-beige">
    <section class="max-w-6xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="brand-card p-4 sm:p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 items-stretch">
                {{-- Product Images Slider --}}
                @include('livewire.guest.product-detail.image-gallery')

                {{-- Product Info --}}
                @include('livewire.guest.product-detail.product-info')
            </div>
        </div>
    </section>

    {{-- INNOVATION: Interactive Product Reviews --}}
    <section class="mt-8 border-t border-gray-400">
        <livewire:guest.product-reviews :product_id="$product->id" />
    </section>

</div>
