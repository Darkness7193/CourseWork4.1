<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;




class EverythingSeeder extends Seeder
{
    public function run(): void
    {
        Artisan::call('db:seed --class=DatabaseSeeder');
        Artisan::call('db:seed --class=PermissionsSeeder');
        Artisan::call('db:seed --class=RoleSeeder');
        Artisan::call('db:seed --class=UserSeeder');
    }
}
