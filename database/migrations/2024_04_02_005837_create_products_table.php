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
            $table->string('product_name');
            $table->text('description');
            $table->decimal('price');
            $table->integer('stock_quantity');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table){
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }


    public function down()
    {
        Schema::table('products', function (Blueprint $table){
            $table->dropForeign(['category_id']);
        });

        Schema::dropIfExists('products');
    }
};
