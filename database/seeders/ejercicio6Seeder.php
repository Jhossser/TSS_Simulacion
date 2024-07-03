<?php

namespace Database\Seeders;

use App\Models\ejercicio6;
use Illuminate\Database\Seeder;

class ejercicio6Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ej6_1 = new ejercicio6();
        $ej6_1->idUsuario = 1;
        $ej6_1->tasaLlegada = 8;
        $ej6_1->numEquipos = 2;
        $ej6_1->save();

        $ej6_2 = new ejercicio6();
        $ej6_2->idUsuario = 2;
        $ej6_2->tasaLlegada = 8;
        $ej6_2->numEquipos = 2;
        $ej6_2->save();

        $ej6_3 = new ejercicio6();
        $ej6_3->idUsuario = 3;
        $ej6_3->tasaLlegada = 8;
        $ej6_3->numEquipos = 2;
        $ej6_3->save();

        $ej6_4 = new ejercicio6();
        $ej6_4->idUsuario = 4;
        $ej6_4->tasaLlegada = 8;
        $ej6_4->numEquipos = 2;
        $ej6_4->save();
    }
}
