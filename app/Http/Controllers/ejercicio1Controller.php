<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ejercicio1Controller extends Controller
{
    public function index()
    {
        return view('Ejercicio 1.index');
    }

    public function edit()
    {
        return view('Ejercicio 1.edit');
    }
}
