<div class="px-6 lg:px-12 pt-6 lg:pt-10 pb-4 lg:pb-8">
    <div class="h-10 w-48 bg-gray-200 animate-pulse rounded mb-8"></div>

    <div class="mb-6 h-12 w-full max-w-md bg-gray-200 animate-pulse rounded-md"></div>

    <div class="hidden md:block overflow-hidden brand-card">
        <div class="h-12 w-full bg-gray-100 border-b border-gray-200"></div>
        <div class="divide-y divide-gray-200">
            @foreach(range(1, 5) as $i)
                <div class="p-4 flex justify-between items-center h-20">
                    <div class="h-5 w-16 bg-gray-200 animate-pulse rounded"></div>
                    <div class="h-5 w-48 bg-gray-PO animate-pulse rounded"></div>
                    <div class="h-5 w-32 bg-gray-200 animate-pulse rounded"></div>
                    <div class="h-5 w-24 bg-gray-200 animate-pulse rounded"></div>
                    <div class="h-5 w-20 bg-gray-200 animate-pulse rounded"></div>
                    <div class="h-8 w-24 bg-gray-200 animate-pulse rounded"></div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="md:hidden grid grid-cols-1 gap-4">
        @foreach(range(1, 3) as $i)
            <div class="brand-card p-4 space-y-4">
                <div class="flex justify-between items-center">
                    <div class="h-5 w-12 bg-gray-200 animate-pulse rounded"></div>
                    <div class="h-6 w-20 bg-gray-200 animate-pulse rounded-full"></div>
                </div>
                <div class="h-4 w-3/4 bg-gray-200 animate-pulse rounded"></div>
                <div class="h-5 w-24 bg-gray-200 animate-pulse rounded"></div>
            </div>
        @endforeach
    </div>
</div>
