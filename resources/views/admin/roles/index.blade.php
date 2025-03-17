<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('admin/role.title_plural') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-table
                :create="auth()->user()->can('role_create') ? ['url' => route('admin.roles.create'), 'label' => __('admin/role.create')] : null"
                :headers="['id', 'name']"
                :labels="['ID', __('admin/role.attributes.name'), __('admin/role.attributes.permissions'), __('global.actions')]"
                :data="$roles->map(function($role, $key) {
                    return [
                        'id' => $role->id,
                        'name' => $role->name,
                        'permissions' => @verbatim
                            $role->permissions->map(function($permission) {
                                return '<span class="bg-indigo-100 text-indigo-700 text-sm px-2 py-1 mx-px mb-2 rounded-md inline-block break-all">' . $permission->name . '</span>';
                            })->implode(' ')
                        @endverbatim,
                        'actions' => array_filter([
                            auth()->user()->can('role_edit') ? [
                                'name' => 'edit',
                                'url' => route('admin.roles.edit', $role->id),
                                'label' => __('global.edit'),
                                'color' => 'blue'
                            ] : null,
                            auth()->user()->can('role_delete') ? [
                                'name' => 'delete',
                                'url' => route('admin.roles.destroy', $role->id),
                                'label' => __('global.delete'),
                            ] : null,
                        ]),
                    ];
                })"
                :pagination="$roles->links()"
            />
        </div>
    </div>
</x-admin-layout>
