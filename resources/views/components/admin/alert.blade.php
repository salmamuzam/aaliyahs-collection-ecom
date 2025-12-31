@props(['type' => 'success', 'message'])

@if($type === 'success')
<div class="flex items-start bg-green-100 border border-gray-300 rounded-md text-green-800 p-4 relative mb-4" role="alert">
    <div class="inline-block">
        <span class="font-semibold text-base inline-block mr-4">Success!</span>
        <span class="block text-base font-medium sm:inline max-sm:mt-2 mr-4">{{ $message }}</span>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg"
        class="w-7 hover:bg-green-200 rounded-lg transition-all p-2 cursor-pointer ml-auto shrink-0 fill-green-500" viewBox="0 0 320.591 320.591" onclick="this.parentElement.style.display='none'">
        <path
        d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
        data-original="#000000" />
        <path
        d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
        data-original="#000000" />
    </svg>
</div>
@else
<div class="flex items-start bg-red-100 border border-gray-300 rounded-md text-red-800 p-4 relative mb-4" role="alert">
    <div class="inline-block">
        <span class="font-semibold text-base inline-block mr-4">Error!</span>
        <span class="block text-base font-medium sm:inline max-sm:mt-2 mr-4">{{ $message }}</span>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg"
        class="w-7 hover:bg-red-200 rounded-lg transition-all p-2 cursor-pointer ml-auto shrink-0 fill-red-500" viewBox="0 0 320.591 320.591" onclick="this.parentElement.style.display='none'">
        <path
        d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
        data-original="#000000" />
        <path
        d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
        data-original="#000000" />
    </svg>
</div>
@endif
