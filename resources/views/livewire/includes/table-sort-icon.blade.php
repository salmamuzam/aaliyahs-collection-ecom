@props(['field'])

<span class="ml-1 cursor-pointer" wire:click="sortBy('{{ $field }}')">
    @if($sortColumn === $field)
        @if($sortOrder === 'asc')
            <i class="fa-solid fa-sort-up"></i>
        @else
            <i class="fa-solid fa-sort-down"></i>
        @endif
    @else
        <i class="fa-solid fa-sort opacity-50"></i>
    @endif
</span>
