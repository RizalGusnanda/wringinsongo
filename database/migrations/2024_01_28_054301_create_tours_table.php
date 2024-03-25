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
            $table->unsignedBigInteger('id_testimonis')->nullable();
            $table->string('profile_tour')->nullable();
            $table->string('name');
            $table->text('description');
            $table->string('longitud')->nullable();
            $table->string('latitud')->nullable();
            $table->text('history')->nullable();
            $table->string('maps');
            $table->string('fasilitas_km');
            $table->string('fasilitas_tm');
            $table->string('fasilitas_ti');
            $table->string('type');
            $table->string('harga_tiket')->nullable();
            $table->string('virtual_tour')->nullable();
            $table->timestamps();

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
