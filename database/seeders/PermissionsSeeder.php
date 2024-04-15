<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;




function create_demo_users() {
    $user = User::factory()->create([
        'name' => 'UserName',
        'password' => 1,
        'email' => 'UserEmail@example.com',
    ]);
    $user->assignRole('User');

    $user = User::factory()->create([
        'name' => 'AdminName',
        'password' => 1,
        'email' => 'AdminEmail@example.com',
    ]);
    $user->assignRole('Admin');

    $user = User::factory()->create([
        'name' => 'SuperAdminName',
        'password' => 1,
        'email' => 'SuperAdminName@example.com',
    ]);
    $user->assignRole('SuperAdmin');
}


class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'access user page']);
        Permission::create(['name' => 'approve user']);
        Permission::create(['name' => 'disapprove user']);
        Permission::create(['name' => 'delete user']);


        $role1 = Role::create(['name' => 'User']);

        /*
        $role2 = Role::create(['name' => 'Admin']);
        $role2->givePermissionTo('access site');
        $role2->givePermissionTo('access user page');
        $role2->givePermissionTo('approve user');
        $role2->givePermissionTo('disapprove user');
        $role2->givePermissionTo('delete user');
         */

        $role3 = Role::create(['name' => 'SuperAdmin']);


        create_demo_users();
    }
}
