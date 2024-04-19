<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;




function create_demo_users() {
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


function create_permissions() {
    Permission::create(['name' => 'access site']);
    Permission::create(['name' => 'access user page']);

    Permission::create(['name' => 'create user']);
    Permission::create(['name' => 'edit user']);
    Permission::create(['name' => 'delete user']);

    Permission::create(['name' => 'assign role unapproved user']);
    Permission::create(['name' => 'edit unapproved user']);
    Permission::create(['name' => 'remove role unapproved user']);

    Permission::create(['name' => 'assign role approved user']);
    Permission::create(['name' => 'edit approved user']);
    Permission::create(['name' => 'remove role approved user']);

    Permission::create(['name' => 'assign role admin']);
    Permission::create(['name' => 'edit admin']);
    Permission::create(['name' => 'remove role admin']);

    Permission::create(['name' => 'assign role super admin']);
    Permission::create(['name' => 'edit super admin']);
    Permission::create(['name' => 'remove role super admin']);
}


function create_roles() {
    $role0 = Role::create(['name' => 'unapproved user']);

    $role1 = Role::create(['name' => 'approved user']);
    $role1->syncPermissions(
        'access site'
    );

    $role2 = Role::create(['name' => 'admin']);
    $role2->syncPermissions(
        'access site',
        'access user page',

        'create user',
        'delete user',

        'assign role unapproved user',
        'edit unapproved user',
        'remove role unapproved user',

        'assign role approved user',
        'edit approved user',
        'remove role approved user',
    );

    $role3 = Role::create(['name' => 'super admin']);
}


class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        Artisan::call('cache:forget spatie.permission.cache');
        Artisan::call('cache:forget spatie.role.cache');
        Artisan::call('cache:clear');

        Artisan::call('migrate:fresh --seed');

        create_permissions();
        create_roles();
        create_demo_users();
    }
}
