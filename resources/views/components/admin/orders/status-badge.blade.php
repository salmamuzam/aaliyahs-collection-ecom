@props(['status'])

@php
    $variant = match($status) {
        'new' => 'info',
        'processing' => 'success',
        'shipped' => 'warning',
        'delivered' => 'teal',
        'cancelled' => 'danger',
        default => 'default',
    };
@endphp

<x-admin.common.badge :variant="$variant">
    {{ $status }}
</x-admin.badge>

