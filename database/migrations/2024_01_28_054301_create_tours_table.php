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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_subfacilities')->nullable();
            $table->unsignedBigInteger('id_type')->nullable();
            $table->unsignedBigInteger('id_testimonis')->nullable();
            $table->string('profile_tour')->nullable();
            $table->string('name');
            $table->string('description');
            $table->string('longitud');
            $table->string('latitud');
            $table->string('virtual_tour');
            $table->timestamps();

            $table->foreign('id_subfacilities')->references('id')->on('subfacilities')->restrictOnDelete();
            $table->foreign('id_type')->references('id')->on('types')->restrictOnDelete();
            $table->foreign('id_testimonis')->references('id')->on('testimonis')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tours');
    }
};
