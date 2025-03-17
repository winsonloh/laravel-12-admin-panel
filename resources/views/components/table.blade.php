@props(['create' => [], 'headers' => [], 'labels' => [], 'data' => [], 'pagination' => null, 'pills' => false])

<div class="flex flex-col md:flex-row justify-between md:items-center mb-4">
    @if ($create)
        <a href="{{ $create['url'] }}">
            <x-button color="green" class="mb-4 md:mb-0 w-1/2">{{ $create['label'] }}</x-button>
        </a>
    @endif
    
    <form method="get" class="w-full md:w-1/3 md:ml-auto flex items-center space-x-2">
        <div class="relative flex-grow">
            <x-text-input 
                name="search" 
                value="{{ request('search') }}" 
                placeholder="{{ __('global.search') }}" 
                class="w-full pl-10 pr-4 py-1 border rounded-md focus:ring focus:ring-blue-300"
            />
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
                class="absolute left-3 top-1/2 transform -translate-y-1/2 size-5 text-gray-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </div>

        @if(request()->has('search'))
            <a href="{{ url()->current() }}" class="text-right">
                <x-button color="red" type="button" class="px-4 sm:px-0 mb-0">
                    ✕
                </x-button>
            </a>
        @else
            <x-button type="submit" color="blue" class="w-1/4 sm:w-auto mb-0">
                {{ __('global.search') }}
            </x-button>
        @endif
    </form>
</div>
<div class="bg-white shadow-md rounded-lg" x-data="{ deleteId: null, deleteUrl: '' }">
    <div class="p-4">
        <div class="overflow-hidden">
            <div class="w-full overflow-x-auto">
                <table class="w-full min-w-[600px] table-fixed border-collapse">
                    <thead class="w-full">
                        <tr class="w-full">
                            @foreach($labels as $index => $label)
                                @php
                                    $key = $headers[$index] ?? null;
                                    $isSortable = $key && $key !== 'actions';
                                    $currentSort = request('sort', 'id');
                                    $currentOrder = request('order', 'desc');
                                    $newOrder = ($currentSort === $key && $currentOrder === 'asc') ? 'desc' : 'asc';
                                @endphp
                
                                <th class="p-4 border-b text-left {{ $isSortable ? 'cursor-pointer' : '' }}">
                                    @if ($isSortable && $key)
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => $key, 'order' => $newOrder]) }}" class="flex items-center space-x-1">
                                            <span>{{ $label }}</span>
                                            @if ($currentSort === $key)
                                                {!! $currentOrder === 'asc' ? '&uarr;' : '&darr;' !!}
                                            @endif
                                        </a>
                                    @else
                                        {{ $label }}
                                    @endif
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                
                    <tbody class="w-full">
                        @forelse($data as $row)
                            <tr class="hover:bg-gray-100 w-full">
                                @foreach($row as $key => $cell)
                                    <td class="p-4 border-b py-5 text-sm">
                                        @if ($key === 'actions')
                                            @foreach($cell as $action)
                                                @if($action['name'] === 'delete')
                                                    <x-button
                                                        color="red"
                                                        x-on:click.prevent="
                                                            deleteId = '{{ $row['id'] }}';
                                                            deleteUrl = '{{ $action['url'] }}';
                                                            $dispatch('open-modal', 'confirm-deletion');
                                                        "
                                                    >
                                                        {{ $action['label'] }}
                                                    </x-button>
                                                @else
                                                    <a href="{{ $action['url'] }}" target="_blank">
                                                        <x-button color="{{ $action['color'] }}">{{ $action['label'] }}</x-button>
                                                    </a>
                                                @endif
                                            @endforeach
                                        @else
                                            {!! $cell !!}
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @empty
                            <tr class="w-full">
                                <td colspan="{{ count($labels) }}" class="p-4 border-b text-center">
                                    <p class="text-sm">No records found</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>                              
            </div>
        </div>
        <div class="flex justify-end items-center mt-4">
            {!! $pagination !!}
        </div>
    </div>

    <x-modal name="confirm-deletion" focusable>
        <form method="post" x-bind:action="deleteUrl" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('global.are_you_sure_to_delete') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('global.this_action_cannot_be_undone') }}
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('global.cancel') }}
                </x-secondary-button>

                <x-danger-button type="submit" class="ms-3">
                    {{ __('global.delete') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</div>
