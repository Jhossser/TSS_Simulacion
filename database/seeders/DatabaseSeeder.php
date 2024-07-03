<?php

namespace Database\Seeders;

use App\Models\equipo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this -> call(userSeeder::class);
        $this -> call(ejercicio3Seeder::class);
        $this -> call(ejercicio6Seeder::class);
        $this -> call(equipoSeeder::class);
    }
}
