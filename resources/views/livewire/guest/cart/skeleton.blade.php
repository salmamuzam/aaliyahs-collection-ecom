<div class="sm:px-8 px-4 py-8 max-w-screen-xl mx-auto">
    <div class="h-10 w-48 bg-gray-200 animate-pulse rounded mb-8"></div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Cart Items Skeleton --}}
        <div class="lg:col-span-2">
            <div class="brand-card overflow-hidden">
                <div class="p-6 space-y-6">
                    @foreach(range(1, 2) as $i)
                        <div class="flex items-center gap-6 pb-6 border-b border-gray-100 last:border-0 last:pb-0">
                            <div class="w-24 h-32 bg-gray-200 animate-pulse rounded-md"></div>
                            <div class="flex-1 space-y-2">
                                <div class="h-5 w-1/2 bg-gray-200 animate-pulse rounded"></div>
                                <div class="h-4 w-1/3 bg-gray-200 animate-pulse rounded"></div>
                                <div class="h-8 w-24 bg-gray-200 animate-pulse rounded mt-4"></div>
                            </div>
                            <div class="text-right">
                                <div class="h-6 w-24 bg-gray-200 animate-pulse rounded"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Summary Skeleton --}}
        <div>
            <div class="brand-card p-6 space-y-6">
                <div class="h-6 w-32 bg-gray-200 animate-pulse rounded border-b border-gray-100 pb-2"></div>
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <div class="h-4 w-20 bg-gray-200 animate-pulse rounded"></div>
                        <div class="h-4 w-24 bg-gray-200 animate-pulse rounded"></div>
                    </div>
                    <div class="flex justify-between pt-4 border-t border-gray-100">
                        <div class="h-6 w-16 bg-gray-200 animate-pulse rounded"></div>
                        <div class="h-6 w-32 bg-gray-200 animate-pulse rounded"></div>
                    </div>
                </div>
                <div class="h-12 w-full bg-gray-200 animate-pulse rounded-md pt-6"></div>
            </div>
        </div>
    </div>
</div>
