<x-app-layout>
    <div class="w-full">
        <div class="py-10 brand-container">
            @if(auth()->user()?->user_type === 'admin' && request('view') === 'admin')
                <x-admin.page-header title="API Tokens" />
            @else
                <x-customer.page-header title="API TOKENS" />
            @endif

            @livewire('api.api-token-manager')
        </div>
    </div>
</x-app-layout>
