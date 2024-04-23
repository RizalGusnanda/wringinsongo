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
            $table->unsignedBigInteger('id_tour')->nullable();
            $table->string('subimages')->nullable();
            $table->timestamps();

            $table->foreign('id_tour')->references('id')->on('tours')->onDelete('cascade');
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
