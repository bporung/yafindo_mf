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
        Schema::create('reportinventorydetails', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('reportinventory_id');
            $table->unsignedBigInteger('product_id');
            $table->string('customer_product_id');
            $table->string('uom');
            $table->double('qty');
            $table->integer('conversion_uom')->nullable();
            $table->double('conversion_qty')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportinventorydetails');
    }
};
