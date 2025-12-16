<div class="h-screen p-5">
    <h1 class="mb-2 text-xl">Categories</h1>
    <div class="hidden overflow-auto rounded-lg shadow md:block">
        <table class="w-full">
            <thead class="border-b-2 border-[#822659] bg-[#004D61] text-white">
                <tr>
                    <th class="p-3 text-sm font-semibold tracking-wide text-center">
                        Image
                    </th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-center">
                        Name
                    </th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-center">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#1A1A1A]">
                @foreach($categories as $category)
                <tr class="bg-[#F0F0F0]">
                    <td class="p-3 text-sm text-[#1A1A1A] text-center"></td>
                    <td class="p-3 text-sm text-[#1A1A1A] text-center">{{ $category->name }}</td>
                    <td class="p-3 text-sm text-[#1A1A1A] text-center">Edit</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="grid grid-cols-1 gap-4 md:hidden">
        <div class="bg-[#F0F0F0] p-4 rounded-lg shadow">

        </div>
    </div>
</div>
