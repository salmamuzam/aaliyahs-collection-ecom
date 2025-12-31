@if(session('success'))
    <x-admin.alert type="success" :message="session('success')" />
@elseif(session('message'))
    <x-admin.alert type="success" :message="session('message')" />
@elseif(session('error'))
    <x-admin.alert type="danger" :message="session('error')" />
@endif
