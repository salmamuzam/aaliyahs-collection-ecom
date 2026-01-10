<div class="sm:px-8 px-4 py-6">
    <div class="bg-white rounded-md shadow-sm border border-gray-300 overflow-hidden w-full max-w-screen-xl max-lg:max-w-xl mx-auto">
        {{-- Header Skeleton --}}
        <div class="px-6 py-4 bg-brand-teal animate-pulse">
            <div class="flex items-center justify-between gap-2">
                <div class="h-8 w-48 bg-white/20 rounded"></div>
                <div class="h-8 w-24 bg-white/20 rounded-full"></div>
            </div>
            <div class="h-4 w-64 bg-white/20 rounded mt-2"></div>
        </div>

        <div class="p-6">
            {{-- Order Info Skeleton --}}
            <div class="flex flex-wrap justify-between items-center gap-4">
                @foreach(range(1, 3) as $i)
                    <div class="min-w-[120px]">
                        <div class="h-4 w-24 bg-gray-200 animate-pulse rounded"></div>
                        <div class="h-5 w-32 bg-gray-200 animate-pulse rounded mt-2"></div>
                    </div>
                @endforeach
            </div>

            {{-- Shipping Info Skeleton --}}
            <div class="bg-gray-100 rounded-md border border-gray-300 p-4 mt-8">
                <div class="h-6 w-56 bg-gray-200 animate-pulse rounded mb-6"></div>
                <div class="grid grid-cols-2 gap-4 lg:flex lg:flex-wrap lg:justify-between lg:w-full">
                    @foreach(range(1, 4) as $i)
                        <div class="min-w-[150px]">
                            <div class="h-4 w-20 bg-gray-200 animate-pulse rounded"></div>
                            <div class="h-5 w-32 bg-gray-200 animate-pulse rounded mt-2"></div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Order Items Skeleton --}}
            <div class="mt-8">
                <div class="h-6 w-48 bg-gray-200 animate-pulse rounded mb-6"></div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-x-12 lg:gap-y-4">
                    @foreach(range(1, 2) as $i)
                        <div class="flex items-center gap-4">
                            <div class="w-24 h-32 bg-gray-200 animate-pulse rounded-md"></div>
                            <div class="flex-1 space-y-3">
                                <div class="h-5 w-full bg-gray-200 animate-pulse rounded"></div>
                                <div class="h-8 w-20 bg-gray-200 animate-pulse rounded"></div>
                            </div>
                            <div class="h-6 w-24 bg-gray-200 animate-pulse rounded"></div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Order Summary Skeleton --}}
            <div class="bg-gray-100 rounded-md border border-gray-300 p-4 mt-8 space-y-4">
                <div class="h-6 w-48 bg-gray-200 animate-pulse rounded mb-6"></div>
                <div class="flex justify-between">
                    <div class="h-5 w-24 bg-gray-200 animate-pulse rounded"></div>
                    <div class="h-5 w-32 bg-gray-200 animate-pulse rounded"></div>
                </div>
                <div class="flex justify-between pt-3 border-t border-gray-300">
                    <div class="h-6 w-20 bg-gray-200 animate-pulse rounded"></div>
                    <div class="h-6 w-32 bg-gray-200 animate-pulse rounded"></div>
                </div>
            </div>
        </div>
    </div>
</div>
