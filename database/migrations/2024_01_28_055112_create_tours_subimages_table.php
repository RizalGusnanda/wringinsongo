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
        Schema::create('tours_subimages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tours')->nullable();
            $table->unsignedBigInteger('id_subimage')->nullable();
            $table->timestamps();

            $table->foreign('id_tours')->references('id')->on('tours')->restrictOnDelete();
            $table->foreign('id_subimage')->references('id')->on('subimages')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tours_subimages');
    }
};
