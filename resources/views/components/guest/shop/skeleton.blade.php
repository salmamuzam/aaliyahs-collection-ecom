<div class="grid grid-cols-2 lg:grid-cols-3 max-xl:gap-4 gap-6 h-full">
    @foreach(range(1,6) as $i)
    <div class="bg-white shadow-sm border border-gray-300 rounded-md p-3 h-full flex flex-col">
        <div class="aspect-[3/4] w-full bg-gray-200 animate-pulse rounded-md"></div>
        <div class="mt-4 space-y-3 flex-1">
            <div class="h-4 w-3/4 bg-gray-200 rounded animate-pulse"></div>
            <div class="h-4 w-1/4 bg-gray-200 rounded animate-pulse"></div>
        </div>
        <div class="flex items-center gap-2 mt-6">
            <div class="w-12 h-9 bg-gray-200 rounded animate-pulse"></div>
            <div class="h-9 flex-1 bg-gray-200 rounded animate-pulse"></div>
        </div>
    </div>
    @endforeach
</div>
