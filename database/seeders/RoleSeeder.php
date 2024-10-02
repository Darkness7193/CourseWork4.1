<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;




class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $unapproved_user = Role::create(['name' => 'unapproved user']);

        $approved_user = Role::create(['name' => 'approved user']);
        $approved_user->syncPermissions(
            'access site'
        );

        $admin = Role::create(['name' => 'admin']);
        $admin->syncPermissions(
            'access site',
            'access user page',

            'create user',
            'delete user',

            'assign role unapproved user',
            'edit unapproved user',
            'remove role unapproved user',
            'delete unapproved user',

            'assign role approved user',
            'edit approved user',
            'remove role approved user',
            'delete approved user',
        );

        $super_admin = Role::create(['name' => 'super admin']);
    }
}
