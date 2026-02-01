<div>
    <div class="w-full max-w-[85rem] pt-2 pb-0 px-4 sm:px-6 lg:px-8 mx-auto">
        @include('livewire.guest.partials.alerts')
        <section class="pt-2 pb-0 rounded-md font-poppins dark:bg-gray-800">
            <div class="px-4 py-2 mx-auto max-w-7xl lg:py-3 md:px-6">
                <div class="flex flex-wrap mb-5 -mx-3">
                    @include('livewire.guest.shop.filters')
                    
                    <div class="w-full px-3 lg:w-3/4">
                        @include('livewire.guest.shop.product-grid')
                    </div>
                </div>
            </div>
        </section>

    </div>
