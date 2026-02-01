<div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl text-brand-teal brand-heading-playfair">
        {{ $isView ? 'View' : ($product ? 'Edit' : 'Create') }} Product
    </h2>
    <a wire:navigate href="{{ route('admin.products') }}" class="px-5 py-2.5 text-base font-semibold text-white bg-brand-green rounded-lg hover:bg-opacity-90 transition-colors shadow-sm">
        Back
    </a>
</div>
