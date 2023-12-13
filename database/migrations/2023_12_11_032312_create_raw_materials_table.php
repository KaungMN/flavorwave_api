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
        Schema::create('raw_materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('supplier_id');
            $table->string('name1')->nullable();
            $table->string('price1')->nullable();
            $table->string('photo1')->nullable();
            $table->float('weight1')->nullable();
            $table->string('name2')->nullable();
            $table->string('price2')->nullable();
            $table->string('photo2')->nullable();
            $table->float('weight2')->nullable();
            $table->string('name3')->nullable();
            $table->string('price3')->nullable();
            $table->string('photo3')->nullable();
            $table->float('weight3')->nullable();
            $table->string('name4')->nullable();
            $table->string('price4')->nullable();
            $table->string('photo4')->nullable();
            $table->float('weight4')->nullable();
            $table->string('demand_date');
            $table->timestamps();
            $table->datetime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raw_materials');
    }
};
