<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;




function create_demo_users() {
    User::factory()->create([
        'name' => 'Guest',
        'password' => 1,
        'email' => 'GuestEmail@example.com',
    ]);

    $user = User::factory()->create([
        'name' => 'ApprovedUserName',
        'password' => 1,
        'email' => 'ApprovedUserEmail@example.com',
    ]);
    $user->assignRole('ApprovedUser');

    $user = User::factory()->create([
        'name' => 'AdminName',
        'password' => 1,
        'email' => 'AdminEmail@example.com',
    ]);
    $user->assignRole('Admin');
}


class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'access site']);
        Permission::create(['name' => 'access user page']);
        Permission::create(['name' => 'approve user']);
        Permission::create(['name' => 'disapprove user']);
        Permission::create(['name' => 'delete user']);


        $role1 = Role::create(['name' => 'ApprovedUser']);
        $role1->givePermissionTo('access site');

        $role2 = Role::create(['name' => 'Admin']);
        $role2->givePermissionTo('access site');
        $role2->givePermissionTo('access user page');
        $role2->givePermissionTo('approve user');
        $role2->givePermissionTo('disapprove user');
        $role2->givePermissionTo('delete user');


        create_demo_users();
    }
}
