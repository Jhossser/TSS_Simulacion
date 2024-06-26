<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario = new User();
        $usuario->nombre = 'Jhosemar'; 
        $usuario->password = Hash::make(12345678);
        $usuario->save();

        $usuario2 = new User();
        $usuario2->nombre = 'Giselle'; 
        $usuario2->password = Hash::make(12345678);
        $usuario2->save(); 

        $usuario3 = new User();
        $usuario3->nombre = 'Leonardo'; 
        $usuario3->password = Hash::make(12345678);
        $usuario3->save(); 

        $usuario4 = new User();
        $usuario4->nombre = 'Camila'; 
        $usuario4->password = Hash::make(12345678);
        $usuario4->save(); 
    }
}
