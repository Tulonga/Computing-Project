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
            $table->id();
            $table->date('order_date');
            $table->decimal('total');
            $table->unsignedBigInteger('customer_id');
            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table){
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table){
            $table->dropForeign(['customer_id']);
        });

        Schema::dropIfExists('orders');
    }
};
