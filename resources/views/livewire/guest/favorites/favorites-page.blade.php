<div class="w-full">
    <div class="">
        <div class="p-6 mx-auto max-w-7xl max-lg:max-w-4xl">
            @include('livewire.guest.partials.alerts')
            <x-customer.common.page-header title="YOUR WISHLIST" />

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-2">
                @forelse($favorite_items as $item)
                    @include('livewire.guest.favorites.favorite-item')
                @empty
                    <div class="col-span-full">
                        @include('livewire.guest.partials.empty-state', [
                            'title' => 'Your wishlist is empty!',
                            'icon' => '<path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>'
                        ])
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

