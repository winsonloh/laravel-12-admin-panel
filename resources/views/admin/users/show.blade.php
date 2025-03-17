<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('admin/user.show') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <table class="w-full table-fixed border-collapse">
                        <tbody class="break-all">
                            <tr class="bg-gray-100">
                                <td class="px-4 py-2">{{ __('admin/user.attributes.name') }}</td>
                                <td class="px-4 py-2">{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2">{{ __('admin/user.attributes.username') }}</td>
                                <td class="px-4 py-2">{{ $user->username }}</td>
                            </tr>
                            <tr class="bg-gray-100">
                                <td class="px-4 py-2">{{ __('admin/user.attributes.email') }}</td>
                                <td class="px-4 py-2">{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2">{{ __('admin/user.attributes.role') }}</td>
                                <td class="px-4 py-2">
                                    <span class="bg-indigo-100 text-indigo-700 text-sm px-2 py-1 mx-px mb-2 rounded-md inline-block break-all">
                                        {{ ucwords(str_replace('_', ' ', $user->roles->first()->name)) }}
                                    </span>
                                </td>
                            </tr>
                            <tr class="bg-gray-100">
                                <td class="px-4 py-2">{{ __('global.created_at') }}</td>
                                <td class="px-4 py-2">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2">{{ __('global.updated_at') }}</td>
                                <td class="px-4 py-2">{{ $user->updated_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>