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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->json('products')->nullable();
            // $table->unsignedBigInteger('product_id');
            // $table->foreign('product_id')->references('id')->on('products');
            $table->string('quantity');
            $table->string('city');
            $table->string('township');
            $table->string('address');
            $table->string('orderType');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('status')->nullable();
            $table->longText('remark')->nullable();
            $table->float('sub_total')->nullable();
            $table->integer('delivery_date')->nullable();
            $table->timestamps();
            $table->datetime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
