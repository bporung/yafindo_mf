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
        Schema::table('customerproducts', function (Blueprint $table) {
            $table->double('margin', 15, 8)->default(0);
            $table->double('margin_2', 15, 8)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customerproducts', function (Blueprint $table) {
            //
        });
    }
};
