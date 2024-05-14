<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->decimal('amount', 10, 2);
            $table->string('status');
            $table->string('payment_type');
            $table->json('raw_response_request')->nullable();
            $table->json('raw_response_response')->nullable();
            $table->unsignedBigInteger('cart_id')->nullable();
            $table->timestamps();
            $table->foreign('cart_id')->references('id')->on('carts')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};