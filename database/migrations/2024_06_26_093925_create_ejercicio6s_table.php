<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEjercicio6sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ejercicio6s', function (Blueprint $table) {
            $table->id();
            $table->integer('idUsuario');
            $table->integer('tasaLlegada');
            $table->integer('numEquipos');
            $table->integer('tminE1');
            $table->integer('tminE2');
            $table->integer('tminE3');
            $table->integer('tminE4');
            $table->integer('tmaxE1');
            $table->integer('tmaxE2');
            $table->integer('tmaxE3');
            $table->integer('tmaxE4');
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
        Schema::dropIfExists('ejercicio6s');
    }
}
