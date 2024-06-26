<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEjercicio4sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ejercicio4s', function (Blueprint $table) {
            $table->id();
            $table->integer('idUsuario');
            $table->integer('velocidad');
            $table->integer('distancia');
            $table->integer('tiempoCarga');
            $table->integer('tiempoDescarga');
            $table->integer('jornada');
            $table->integer('costoExedente');
            $table->integer('costoAnualCamion');
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
        Schema::dropIfExists('ejercicio4s');
    }
}
