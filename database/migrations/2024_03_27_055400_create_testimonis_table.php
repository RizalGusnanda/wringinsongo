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
        Schema::create('testimonis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_users')->nullable();
            $table->unsignedBigInteger('id_tour')->nullable();
            $table->unsignedBigInteger('id_cart')->nullable();
            $table->text('reviews');
            $table->integer('rating');
            $table->timestamps();

            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_tour')->references('id')->on('tours')->onDelete('cascade');
            $table->foreign('id_cart')->references('id')->on('carts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('testimonis', function (Blueprint $table) {
            $table->dropForeign(['id_users']);
            $table->dropForeign(['id_tour']);
            $table->dropForeign(['id_cart']);
        });
        Schema::dropIfExists('testimonis');
    }
};
