<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('admin/user.title_plural') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-table
                :create="auth()->user()->can('user_create') ? ['url' => route('admin.users.create'), 'label' => __('admin/user.create')] : null"
                :headers="['id', 'name', 'username', 'role', 'status', 'created_at']"
                :labels="[
                    'ID',
                    __('admin/user.attributes.name'),
                    __('admin/user.attributes.username'),
                    __('admin/user.attributes.role'),
                    __('admin/user.attributes.status'),
                    __('global.created_at'),
                    __('global.actions')
                ]"
                :data="$users->map(function($user, $key) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'username' => $user->username,
                        'role' => @verbatim
                            $user->roles->map(function($role) {
                                return '<span class="bg-indigo-100 text-indigo-700 text-sm px-2 py-1 mx-px mb-2 rounded-md inline-block break-all">' . ucwords(str_replace('_', ' ', $role->name)) . '</span>';
                            })->implode(' ')
                        @endverbatim,
                        'status' => @verbatim
                            $user->status === 'active' ? '<span class="bg-green-100 text-green-700 text-sm px-2 py-1 mx-px mb-2 rounded-md inline-block break-all">' . __('admin/user.status.active') . '</span>' : '<span class="bg-red-100 text-red-700 text-sm px-2 py-1 mx-px mb-2 rounded-md inline-block break-all">' . __('admin/user.status.inactive') . '</span>'
                        @endverbatim,
                        'created_at' => $user->created_at->format('d/m/Y H:i'),
                        'actions' => array_filter([
                            auth()->user()->can('user_view') ? [
                                'name' => 'show',
                                'url' => route('admin.users.show', $user->id),
                                'label' => __('global.details'),
                                'color' => 'green'
                            ] : null,
                            auth()->user()->can('user_edit') ? [
                                'name' => 'edit',
                                'url' => route('admin.users.edit', $user->id),
                                'label' => __('global.edit'),
                                'color' => 'blue'
                            ] : null,
                            auth()->user()->can('user_delete') ? [
                                'name' => 'delete',
                                'url' => route('admin.users.destroy', $user->id),
                                'label' => __('global.delete'),
                            ] : null,
                        ]),
                    ];
                })"
                :pagination="$users->links()"
            />
        </div>
    </div>
</x-admin-layout>
