<div class="px-6 lg:px-12 pt-6 lg:pt-10 pb-4 lg:pb-8">
    <x-admin.common.page-header title="All categories">
        <x-slot:actions>
            <a wire:navigate href="{{ route('admin.categories.create') }}"
                class="flex items-center px-5 py-2.5 text-base font-semibold text-center text-white rounded-lg bg-brand-green hover:bg-opacity-90 transition-colors shadow-sm shadow-green-100">
                <svg class="h-4 w-4 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                </svg>
                Add category
            </a>
        </x-slot:actions>
    </x-admin.page-header>
    @include('livewire.admin.partials.alerts')
    @include('livewire.admin.partials.search-box', ['placeholder' => 'Search by category name...'])


    @include('livewire.admin.categories.desktop-table')
    @if($categories->hasPages())
            <div class="p-4 border-t border-gray-200 uppercase bg-gray-50 text-sm">
                {{ $categories->links() }}
            </div>
    @endif
    
    <div class="md:hidden grid grid-cols-2 gap-4">
        @forelse($categories as $category)
            <x-admin.categories.mobile-card :category="$category" />
        @empty
        @endforelse

        {{-- Pagination --}}
        <div class="mt-4 col-span-2">
             {{ $categories->links() }}
        </div>
    </div>
</div>

