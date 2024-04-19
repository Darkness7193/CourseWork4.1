<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;




function create_demo_users() {
    $user = User::factory()->create([
        'name' => 'UserName',
        'password' => 1,
        'email' => 'UserEmail@gmail.com',
    ]);
    $user->assignRole('User');

    $user = User::factory()->create([
        'name' => 'sa',
        'password' => 1,
        'email' => 'SuperAdmin@gmail.com',
    ]);
    $user->assignRole('SuperAdmin');
}


class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        Artisan::call('cache:forget spatie.permission.cache');
        Artisan::call('cache:forget spatie.role.cache');
        Artisan::call('cache:clear');

        Permission::create(['name' => 'access user page']);
        Permission::create(['name' => 'approve user']);
        Permission::create(['name' => 'disapprove user']);
        Permission::create(['name' => 'delete user']);


        $role1 = Role::create(['name' => 'UnapprovedUser']);
        $role1 = Role::create(['name' => 'User']);
        $role1 = Role::create(['name' => 'Admin']);
        $role3 = Role::create(['name' => 'SuperAdmin']);

        /*
        $role2 = Role::create(['name' => 'Admin']);
        $role2->givePermissionTo('access site');
        $role2->givePermissionTo('access user page');
        $role2->givePermissionTo('approve user');
        $role2->givePermissionTo('disapprove user');
        $role2->givePermissionTo('delete user');
         */


        create_demo_users();
    }
}
