<form wire:submit="saveCategory" class="grid gap-4 sm:grid-cols-2 text-brand-black">
    @csrf
    {{-- Name Input --}}
    <div class="col-span-full">
        <label class="block mb-2 text-base font-medium text-brand-black">Name</label>
        <input {{ $isView ? 'disabled' : '' }} wire:model="name" type="text"
            class="brand-form-input"
            placeholder="Enter category name" />
        @include('livewire.admin.partials.form-error', ['field' => 'name'])
    </div>

    {{-- Existing Image --}}
    @if($category && $category->image)
        <div class="col-span-full">
            <label class="block mb-2 text-base font-medium text-brand-black">Current Image</label>
            <img class="object-cover h-40 border border-gray-200 rounded-md shadow-sm" src="{{ \App\Helpers\ImageHelper::getUrl($category->image) }}" alt="Category Image">
        </div>
    @endif

    {{-- Upload Image --}}
    @if(!$isView)
        <div class="col-span-full">
            <label class="block mb-2 text-base font-medium text-brand-black">Upload Image</label>
            <input wire:model="image" type="file"
                class="brand-form-input file:mr-4 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-brand-green file:text-white hover:file:bg-opacity-90" />
            <p class="mt-2 text-xs text-gray-500">JPG, JPEG, PNG, SVG, and WEBP supported.</p>

            @if($image && method_exists($image, 'temporaryUrl'))
                @php
                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'svg', 'webp'];
                    $extension = strtolower($image->getClientOriginalExtension());
                @endphp

                @if(in_array($extension, $allowedExtensions))
                    <div class="mt-4">
                        <p class="mb-2 text-base font-medium text-brand-black">Image Preview</p>
                        <img src="{{ $image->temporaryUrl() }}" class="object-cover h-40 rounded-md shadow-sm">
                    </div>
                @else
                    <div class="mt-4">
                        <p class="text-base font-medium text-brand-burgundy">Invalid file type. Please upload JPG, JPEG, PNG, SVG, or WEBP images only.</p>
                    </div>
                @endif
            @endif

            @include('livewire.admin.partials.form-error', ['field' => 'image'])
        </div>
    @endif

    @if(!$isView)
        <div class="mt-4 col-span-full">
                <button type="submit"
                class="text-white bg-brand-green hover:bg-opacity-90 text-base rounded-md font-medium px-4 py-2.5 cursor-pointer w-full shadow-md hover:shadow-lg transition-all flex items-center justify-center">
                @if($category)
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                @endif
                {{ $category ? 'Update Category' : 'Create Category' }}
            </button>
        </div>
    @endif
</form>
