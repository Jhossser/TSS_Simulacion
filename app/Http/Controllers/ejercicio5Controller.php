<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ejercicio5Controller extends Controller
{
    public function index(Request $request)
    {
        $ran = $this->aleatorio();
        
        return view('Ejercicio 5.index');
    }

    private function aleatorio(){
        return mt_rand() / mt_getrandmax();
    }

    public function update(Request $request)
    {

    }
}
