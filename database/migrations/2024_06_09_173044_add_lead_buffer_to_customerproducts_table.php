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
            $table->integer('lead_time')->default(4);
            $table->integer('buffer_time')->default(6);
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
