{{-- Errors are now displayed directly under each input field in the form --}}

@if (session('status') || session('success'))
    <div class="mb-6 p-4 rounded-md bg-green-100 border border-gray-300 text-base font-medium text-green-800">
        {{ session('status') ?? session('success') }}
    </div>
@endif
