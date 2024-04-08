<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('storages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 100);
            $table->string('address', 100);
            $table->string('phone_number', 100);
            $table->string('email', 100);
            $table->string('comment', 1000);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('storages');
    }
};
