@if(session('success'))
    <div class="mb-6">
        <x-admin.alert type="success" :message="session('success')" />
    </div>
@elseif(session('error'))
    <div class="mb-6">
        <x-admin.alert type="danger" :message="session('error')" />
    </div>
@endif

@if(session('info'))
    <div class="mb-6">
        <x-admin.alert type="info" :message="session('info')" />
    </div>
@endif
