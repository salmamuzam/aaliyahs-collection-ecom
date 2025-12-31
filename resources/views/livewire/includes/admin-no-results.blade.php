@props(['message', 'colspan'])

<tr>
    <td colspan="{{ $colspan }}" class="p-8 text-center text-gray-500 font-sans">
        {{ $message }}
    </td>
</tr>
