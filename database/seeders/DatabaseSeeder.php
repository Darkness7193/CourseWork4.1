<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductMove;
use App\Models\Storage;
use Illuminate\Database\Seeder;




class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Product::factory(20)->create();
        Storage::factory(20)->create();
        ProductMove::factory(200)->create();
    }
}
