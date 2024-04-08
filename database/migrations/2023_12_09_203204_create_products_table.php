<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 100);
            $table->string('manufactor', 100);
            $table->float('purchase_price', 10, 2);
            $table->float('selling_price', 10, 2);
            $table->string('comment', 1000);
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
