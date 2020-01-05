<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuercosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puercos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 100);
            $table->string('raza', 100)->nullable();
            $table->string('color', 50)->nullable();
            $table->date('fecha_nacimiento');
            $table->string('ubicacion')->nullable();
            $table->string('descripcion',256)->nullable();
            $table->boolean('estado')->default(1);
            $table->string('foto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('puercos');
    }
}
