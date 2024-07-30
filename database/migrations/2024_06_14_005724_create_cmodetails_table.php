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
        Schema::create('cmodetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cmo_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('customerproduct_id');
            $table->unsignedBigInteger('shipmentdetail_id')->default(1);
            $table->string('code');
            $table->double('volume', 15, 8);
            $table->double('weight', 15, 8);
            $table->double('qty', 15, 8);
            $table->integer('uom_id');
            $table->double('total_volume', 15, 8);
            $table->double('total_weight', 15, 8);
            $table->json('additional_info')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cmodetails');
    }
};
