<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEjercicio1sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ejercicio1s', function (Blueprint $table) {
            $table->id();
            $table->integer('idUsuario');
            $table->integer('lambda');
            $table->integer('mediaEst1');
            $table->integer('minEst2');
            $table->integer('maxEst2');
            $table->integer('numClientes');
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
        Schema::dropIfExists('ejercicio1s');
    }
}
