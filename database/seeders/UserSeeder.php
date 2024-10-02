<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;




class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'unapproved_user',
            'password' => 1,
            'email' => '0@gmail.com',
        ]);
        $user->assignRole('unapproved user');

        $user = User::factory()->create([
            'name' => 'approved_user',
            'password' => 1,
            'email' => '1@gmail.com',
        ]);
        $user->assignRole('approved user');

        $user = User::factory()->create([
            'name' => 'admin',
            'password' => 1,
            'email' => '2@gmail.com',
        ]);
        $user->assignRole('admin');

        $user = User::factory()->create([
            'name' => 'super_admin',
            'password' => 1,
            'email' => '3@gmail.com',
        ]);
        $user->assignRole('super admin');
    }
}
