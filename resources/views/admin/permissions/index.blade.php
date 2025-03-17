<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('admin/permission.title_plural') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-table
                :create="auth()->user()->can('permission_create') ? ['url' => route('admin.permissions.create'), 'label' => __('admin/permission.create')] : null"
                :headers="['id', 'name']"
                :labels="['ID', __('admin/permission.attributes.name'), __('global.actions')]"
                :data="$permissions->map(function($permission, $key) {
                    return [
                        'id' => $permission->id,
                        'name' => $permission->name,
                        'actions' => array_filter([
                            auth()->user()->can('permission_edit') ? [
                                'name' => 'edit',
                                'url' => route('admin.permissions.edit', $permission->id),
                                'label' => __('global.edit'),
                                'color' => 'blue'
                            ] : null,
                            auth()->user()->can('permission_delete') ? [
                                'name' => 'delete',
                                'url' => route('admin.permissions.destroy', $permission->id),
                                'label' => __('global.delete'),
                            ] : null,
                        ]),
                    ];
                })"
                :pagination="$permissions->links()"
            />
        </div>
    </div>
</x-admin-layout>
