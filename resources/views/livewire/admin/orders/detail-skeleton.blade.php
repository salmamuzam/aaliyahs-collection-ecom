<div class="px-6 lg:px-12 pt-6 lg:pt-10 pb-4 lg:pb-8">
    <div class="h-10 w-64 bg-gray-200 animate-pulse rounded mb-8"></div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Left Column: Order Items Skeleton --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="brand-card overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 h-14"></div>
                <div class="divide-y divide-gray-200">
                    @foreach(range(1, 3) as $i)
                        <div class="p-6 flex items-center gap-6">
                            <div class="w-20 h-24 flex-shrink-0 bg-gray-200 animate-pulse rounded-md"></div>
                            <div class="flex-1 space-y-2">
                                <div class="h-5 w-1/3 bg-gray-200 animate-pulse rounded"></div>
                                <div class="h-4 w-1/4 bg-gray-200 animate-pulse rounded"></div>
                            </div>
                            <div class="text-right space-y-2">
                                <div class="h-5 w-24 bg-gray-200 animate-pulse rounded ml-auto"></div>
                                <div class="h-4 w-16 bg-gray-200 animate-pulse rounded ml-auto"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Right Column: Order Info Skeleton --}}
        <div class="space-y-6">
            <div class="brand-card p-6 space-y-4">
                <div class="h-6 w-32 bg-gray-200 animate-pulse rounded mb-4"></div>
                @foreach(range(1, 3) as $i)
                    <div class="flex justify-between items-center">
                        <div class="h-4 w-20 bg-gray-200 animate-pulse rounded"></div>
                        <div class="h-4 w-16 bg-gray-200 animate-pulse rounded"></div>
                    </div>
                @endforeach
            </div>

            <div class="brand-card p-6 space-y-4">
                <div class="h-6 w-40 bg-gray-200 animate-pulse rounded mb-4"></div>
                @foreach(range(1, 4) as $i)
                    <div class="space-y-2">
                        <div class="h-3 w-24 bg-gray-200 animate-pulse rounded"></div>
                        <div class="h-5 w-full bg-gray-200 animate-pulse rounded"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
