@props(['status'])

@php
    $variant = match($status) {
        'pending' => 'warning',
        'paid' => 'success',
        'failed' => 'danger',
        default => 'default',
    };
@endphp

<x-admin.common.badge :variant="$variant">
    {{ $status }}
</x-admin.badge>

