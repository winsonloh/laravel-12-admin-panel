<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'user_access',
            'user_view',
            'user_create',
            'user_edit',
            'user_delete',
            'permission_access',
            'permission_view',
            'permission_create',
            'permission_edit',
            'permission_delete',
            'role_access',
            'role_view',
            'role_create',
            'role_edit',
            'role_delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
