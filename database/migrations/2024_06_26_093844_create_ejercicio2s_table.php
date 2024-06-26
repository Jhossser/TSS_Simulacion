<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEjercicio2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ejercicio2s', function (Blueprint $table) {
            $table->id();
            $table->integer('idUsuario');
            $table->integer('numCajeros');
            $table->integer('clientePorHora');
            $table->integer('maxTiempoCajero');
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
        Schema::dropIfExists('ejercicio2s');
    }
}
