<?php

namespace Database\Seeders;

use App\Models\ejercicio3;
use Illuminate\Database\Seeder;

class ejercicio3Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ej3_1 = new ejercicio3();
        $ej3_1->idUsuario = 1;
        $ej3_1->tasaLlegada = 12;
        $ej3_1->tasaServicio = 8;
        $ej3_1->cantCupos = 5;
        $ej3_1->tiemposimu = 72;
        $ej3_1->save();
        
        $ej3_2 = new ejercicio3();
        $ej3_2->idUsuario = 2;
        $ej3_2->tasaLlegada = 24;
        $ej3_2->tasaServicio = 10;
        $ej3_2->cantCupos = 4;
        $ej3_2->tiemposimu = 48;
        $ej3_2->save();

        $ej3_3 = new ejercicio3();
        $ej3_3->idUsuario = 3;
        $ej3_3->tasaLlegada = 12;
        $ej3_3->tasaServicio = 8;
        $ej3_3->cantCupos = 5;
        $ej3_3->tiemposimu = 72;
        $ej3_3->save();

        $ej3_4 = new ejercicio3();
        $ej3_4->idUsuario = 4;
        $ej3_4->tasaLlegada = 12;
        $ej3_4->tasaServicio = 8;
        $ej3_4->cantCupos = 5;
        $ej3_4->tiemposimu = 72;
        $ej3_4->save();
    }
}
