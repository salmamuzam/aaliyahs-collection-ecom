<div class="py-10 sm:px-8 px-6" style="background-color: #e5edef;">
    <div class="max-w-screen-xl mx-auto">
        <x-shared.sections.section-header title="BEST SELLERS" align="center" />
        
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($this->bestSellers as $product)
                <x-guest.common.product-card :product="$product" :is-favorite="$this->isInFavorites($product->id)" />
            @endforeach
        </div>
    </div>
</div>

