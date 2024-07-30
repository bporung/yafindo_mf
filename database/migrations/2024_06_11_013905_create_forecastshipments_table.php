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
        Schema::create('forecastshipments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('forecast_id');
            $table->unsignedBigInteger('shipmentdetail_id');
            $table->double('total_volume', 15, 8)->default(0);
            $table->double('total_weight', 15, 8)->default(0);
            $table->double('shipment_volume_quota', 15, 8)->default(0);
            $table->double('shipment_weight_quota', 15, 8)->default(0);
            $table->double('shipment_volume', 15, 8)->default(0);
            $table->double('shipment_weight', 15, 8)->default(0);
            $table->integer('shipment_type')->default(1);
            $table->double('shipment_quota_percentage', 15, 8)->default(1);
            $table->double('shipment_quota_requirement', 15, 8)->default(95);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forecastshipments');
    }
};
