<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::firstOrCreate([
            'email' => 'super_admin@example.com',
        ], [
            'name' => 'Super Admin',
            'password' => bcrypt('password'),
        ]);

        $superAdmin->assignRole('super_admin');
    }
}
