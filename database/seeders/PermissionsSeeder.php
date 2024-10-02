<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;




function clear_permissions_cash() {
    app()[PermissionRegistrar::class]->forgetCachedPermissions();
    Artisan::call('cache:forget spatie.permission.cache');
    Artisan::call('cache:forget spatie.role.cache');
    Artisan::call('cache:clear');

    Artisan::call('migrate:fresh --seed');
}


class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        clear_permissions_cash();

        Permission::create(['name' => 'access site']);
        Permission::create(['name' => 'access user page']);

        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);

        Permission::create(['name' => 'assign role unapproved user']);
        Permission::create(['name' => 'edit unapproved user']);
        Permission::create(['name' => 'remove role unapproved user']);
        Permission::create(['name' => 'delete unapproved user']);

        Permission::create(['name' => 'assign role approved user']);
        Permission::create(['name' => 'edit approved user']);
        Permission::create(['name' => 'remove role approved user']);
        Permission::create(['name' => 'delete approved user']);

        Permission::create(['name' => 'assign role admin']);
        Permission::create(['name' => 'edit admin']);
        Permission::create(['name' => 'remove role admin']);
        Permission::create(['name' => 'delete admin']);

        Permission::create(['name' => 'assign role super admin']);
        Permission::create(['name' => 'edit super admin']);
        Permission::create(['name' => 'remove role super admin']);
        Permission::create(['name' => 'delete super admin']);
    }
}
