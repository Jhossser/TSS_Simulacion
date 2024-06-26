<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEjercicio3sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ejercicio3s', function (Blueprint $table) {
            $table->id();
            $table->integer('idUsuario');
            $table->integer('tasaLlegada');
            $table->integer('tasaServicio');
            $table->integer('cantCupos');
            $table->integer('tiemposimu');
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
        Schema::dropIfExists('ejercicio3s');
    }
}
