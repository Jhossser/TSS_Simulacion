<?php

namespace Database\Seeders;

use App\Models\equipo;
use Illuminate\Database\Seeder;

class equipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $equipo1 = new equipo();
        $equipo1->idEjercicio6 = 1;
        $equipo1->numEquipo = 1;
        $equipo1->min = 10;
        $equipo1->max = 15;
        $equipo1->save();

        $equipo2 = new equipo();
        $equipo2->idEjercicio6 = 1;
        $equipo2->numEquipo = 2;
        $equipo2->min = 20;
        $equipo2->max = 30;
        $equipo2->save();

        $equipo3 = new equipo();
        $equipo3->idEjercicio6 = 2;
        $equipo3->numEquipo = 1;
        $equipo3->min = 10;
        $equipo3->max = 15;
        $equipo3->save();

        $equipo4 = new equipo();
        $equipo4->idEjercicio6 = 2;
        $equipo4->numEquipo = 2;
        $equipo4->min = 20;
        $equipo4->max = 30;
        $equipo4->save();

        $equipo5 = new equipo();
        $equipo5->idEjercicio6 = 3;
        $equipo5->numEquipo = 1;
        $equipo5->min = 10;
        $equipo5->max = 15;
        $equipo5->save();

        $equipo6 = new equipo();
        $equipo6->idEjercicio6 = 3;
        $equipo6->numEquipo = 2;
        $equipo6->min = 20;
        $equipo6->max = 30;
        $equipo6->save();

        $equipo7 = new equipo();
        $equipo7->idEjercicio6 = 4;
        $equipo7->numEquipo = 1;
        $equipo7->min = 10;
        $equipo7->max = 15;
        $equipo7->save();

        $equipo8 = new equipo();
        $equipo8->idEjercicio6 = 4;
        $equipo8->numEquipo = 2;
        $equipo8->min = 20;
        $equipo8->max = 30;
        $equipo8->save();
    }
}
