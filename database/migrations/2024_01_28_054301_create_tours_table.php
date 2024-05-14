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
            $table->string('profile_tour')->nullable();
            $table->string('name');
            $table->text('description');
            $table->text('history')->nullable();
            $table->string('maps');
            $table->string('fasilitas_km');
            $table->string('fasilitas_tm');
            $table->string('fasilitas_ti');
            $table->string('type');
            $table->string('harga_tiket')->nullable();
            $table->timestamps();
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
