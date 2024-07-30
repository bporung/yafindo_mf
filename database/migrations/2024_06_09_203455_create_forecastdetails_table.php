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
        Schema::create('forecastdetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('forecast_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('shipmentdetail_id')->default(1);
            $table->string('code');
            $table->double('target', 15, 8)->default(0);
            $table->double('stock', 15, 8)->default(0);
            $table->double('average_sell_out', 15, 8)->default(0);
            $table->double('average_sell_out_per_day', 15, 8)->default(0);
            $table->double('actual_current', 15, 8)->default(0);
            $table->double('est_left_current', 15, 8)->default(0);
            $table->double('est_sell_out_current', 15, 8)->default(0);
            $table->double('plan_sell_out_next_month', 15, 8)->default(0);
            $table->double('adj_left_current', 15, 8)->default(0);
            $table->double('adj_plan_sell_out_special', 15, 8)->default(0);
            $table->double('final_plan_sell_out_special', 15, 8)->default(0);
            $table->integer('lead_time')->default(0);
            $table->integer('buffer_time')->default(0);
            $table->double('safety_stock', 15, 8)->default(0);
            $table->double('cmo_sent', 15, 8)->default(0);
            $table->double('cmo_plan', 15, 8)->default(0);
            $table->double('cmo_left', 15, 8)->default(0);
            $table->double('adj_cmo_left', 15, 8)->default(0);
            $table->double('doi_current_month', 15, 8)->default(0);
            $table->double('doi_next_month', 15, 8)->default(0);
            $table->double('adj_cmo', 15, 8)->default(0);
            $table->double('cmo', 15, 8)->default(0);
            $table->double('volume', 15, 8);
            $table->double('weight', 15, 8);
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
        Schema::dropIfExists('forecastdetails');
    }
};
