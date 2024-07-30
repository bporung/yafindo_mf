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
        Schema::create('customerproducts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('product_id');
            $table->string('code')->nullable();
            $table->double('target', 15, 8)->default(0);
            $table->double('stock', 15, 8)->default(0);
            $table->string('isActive',1)->default('1');
            $table->timestamps();

            
            // Adding the unique constraint
            $table->unique(['customer_id', 'code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customerproducts');
    }
};
