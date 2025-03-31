@props(['labels' => [], 'data' => []])

<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
    <div class="max-w-xl">
        <table class="w-full table-fixed border-collapse">
            <tbody class="break-all">
                @foreach ($labels as $index => $label)
                    <tr class="{{ $index % 2 === 0 ? 'bg-gray-100' : '' }}">
                        <td class="px-4 py-2 w-1/3">{{ $label }}</td>
                        <td class="px-4 py-2">
                            {!! $data[array_keys($data)[$index]] ?? '-' !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
