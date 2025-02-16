<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permissions umum yang bisa diterapkan ke berbagai objek
        Permission::firstOrCreate(['name' => 'create']);
        Permission::firstOrCreate(['name' => 'edit']);
        Permission::firstOrCreate(['name' => 'delete']);
        Permission::firstOrCreate(['name' => 'view']);

        // Membuat roles dengan guard_name 'web'
        $roleAdmin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $roleUser = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);

        // Memberikan permission ke role admin
        $roleAdmin->givePermissionTo(['create', 'edit', 'delete', 'view']);

        // Memberikan permission tertentu ke role user
        $roleUser->givePermissionTo('view');
    }
}
