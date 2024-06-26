<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ejercicio2Controller extends Controller
{
    public function index()
    {
        return view('Ejercicio 2.index');
    }

    public function edit()
    {
        return view('Ejercicio 2.edit');
    }
}
