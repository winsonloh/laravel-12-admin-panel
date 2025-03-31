<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('admin/user.show') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-table-details
                :labels="[
                    __('admin/user.attributes.name'),
                    __('admin/user.attributes.username'),
                    __('admin/user.attributes.email'),
                    __('admin/user.attributes.role'),
                    __('admin/user.attributes.status'),
                    __('global.created_at'),
                    __('global.updated_at')
                ]"
                :data="[
                    'name' => $user->name,
                    'username' => $user->username,
                    'email' => $user->email,
                    'role' => @verbatim
                        $user->roles->map(function($role) {
                            return '<span class="bg-indigo-100 text-indigo-700 text-sm px-2 py-1 mx-px mb-2 rounded-md inline-block break-all">' . ucwords(str_replace('_', ' ', $role->name)) . '</span>';
                        })->implode(' ')
                    @endverbatim,
                    'status' => @verbatim
                        $user->status === 'active' ? '<span class="bg-green-100 text-green-700 text-sm px-2 py-1 mx-px mb-2 rounded-md inline-block break-all">' . __('admin/user.status.active') . '</span>' : '<span class="bg-red-100 text-red-700 text-sm px-2 py-1 mx-px mb-2 rounded-md inline-block break-all">' . __('admin/user.status.inactive') . '</span>'
                    @endverbatim,
                    'created_at' => $user->created_at->format('d/m/Y H:i'),
                    'updated_at' => $user->updated_at->format('d/m/Y H:i')
                ]"
            />
        </div>
    </div>
</x-admin-layout>