<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEjercicio5sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ejercicio5s', function (Blueprint $table) {
            $table->id();
            $table->integer('idUsuario');
            $table->integer('numSimu');
            $table->integer('cantOperadores');
            $table->integer('costoMaqOciosa');
            $table->integer('salario');
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
        Schema::dropIfExists('ejercicio5s');
    }
}
