<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crias', function (Blueprint $table) {
            $table->bigInteger('id_cria')->unsigned();
            $table->foreign('id_cria')->references('id')->on('puercos')->onDelete('cascade');
            $table->bigInteger('id_gallo')->unsigned();
            $table->foreign('id_gallo')->references('id_gallo')->on('gallos')->onDelete('cascade');
            $table->bigInteger('id_gallina')->unsigned();
            $table->foreign('id_gallina')->references('id_gallina')->on('gallinas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crias');
    }
}
