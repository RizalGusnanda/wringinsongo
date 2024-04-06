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
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_profile');
            $table->unsignedBigInteger('id_cart');
            $table->unsignedBigInteger('id_tours');
            $table->integer('total_amount');
            $table->string('merchant_ref');
            $table->string('reference');
            $table->enum('status', ['paid', 'unpaid']);
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->restrictOnDelete();
            $table->foreign('id_profile')->references('id')->on('profiles')->restrictOnDelete();
            $table->foreign('id_cart')->references('id')->on('carts')->restrictOnDelete();
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
