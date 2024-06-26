<?php

namespace App\Http\Controllers;

use App\Models\ejercicio2;
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
    public function hist(ejercicio2 $hist){
        return view('Ejercicio 2.edit', compact('hist'));
    }
}
