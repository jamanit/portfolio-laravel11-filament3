<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name'            => 'Admin',
            'email'           => 'admin@gmail.com',
            'password'        => bcrypt('password'),
            'profile_picture' => null,
            'phone_number'    => null,
            'bio'             => null,
        ]);
        $admin->assignRole('admin');

        $user = User::factory()->create([
            'name'            => 'User',
            'email'           => 'user@gmail.com',
            'password'        => bcrypt('password'),
            'profile_picture' => null,
            'phone_number'    => null,
            'bio'             => null,
        ]);
        $user->assignRole('user');
    }
}
