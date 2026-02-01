@if(session('success'))
    <x-admin.common.alert type="success" :message="session('success')" />
@elseif(session('message'))
    <x-admin.common.alert type="success" :message="session('message')" />
@elseif(session('error'))
    <x-admin.common.alert type="danger" :message="session('error')" />
@endif

