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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('code')->unique();
            $table->string('varian')->nullable();
            $table->integer('first_uom_id');
            $table->integer('secondary_uom_id');
            $table->integer('third_uom_id');
            $table->integer('fourth_uom_id');
            $table->integer('convert_first_to_fourth');
            $table->integer('convert_second_to_fourth');
            $table->integer('convert_third_to_fourth');
            $table->double('width', 15, 8);
            $table->double('height', 15, 8);
            $table->double('weight', 15, 8);
            $table->double('depth', 15, 8);
            $table->unsignedBigInteger('registered_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
