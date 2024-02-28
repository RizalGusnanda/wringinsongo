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
            $table->unsignedBigInteger('id_tickets')->nullable();
            $table->unsignedBigInteger('id_tours')->nullable();
            $table->integer('total_ticket');
            $table->integer('total_price');
            $table->string('merchant_ref');
            $table->string('reference');
            $table->enum('status', ['paid','unpaid'])->default('unpaid');
            $table->timestamps();

            $table->foreign('id_tickets')->references('id')->on('tickets')->restrictOnDelete();
            $table->foreign('id_tours')->references('id')->on('tours')->restrictOnDelete();
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
