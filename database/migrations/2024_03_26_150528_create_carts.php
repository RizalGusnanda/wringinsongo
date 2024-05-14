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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ticket');
            $table->unsignedBigInteger('id_tour');
            $table->string('order_id')->nullable();
            $table->string('total_price');
            $table->enum('status', ['pending', 'success'])->default('pending');
            $table->enum('status_confirm', ['pending', 'success'])->default('pending');
            $table->timestamps();

            $table->foreign('id_ticket')->references('id')->on('tickets')->restrictOnDelete();
            $table->foreign('id_tour')->references('id')->on('tours')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
};