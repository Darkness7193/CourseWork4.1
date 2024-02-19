<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('product_moves', function(Blueprint $table) {
            $table->renameColumn('operation_type', 'product_move_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_moves', function(Blueprint $table) {
            $table->renameColumn('product_move_type', 'operation_type');
        });
    }
};
