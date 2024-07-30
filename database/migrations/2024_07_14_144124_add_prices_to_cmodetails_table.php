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
        Schema::table('cmodetails', function (Blueprint $table) {
            $table->double('price_inc', 15, 8)->default(0);
            $table->double('price_exc', 15, 8)->default(0);
            $table->double('margin', 15, 8)->default(0);
            $table->double('margin_2', 15, 8)->default(0);
            $table->double('nominal', 15, 8)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cmodetails', function (Blueprint $table) {
            //
        });
    }
};
