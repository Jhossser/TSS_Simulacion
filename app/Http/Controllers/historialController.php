<?php

namespace App\Http\Controllers;

use App\Models\ejercicio1;
use App\Models\ejercicio2;
use App\Models\ejercicio3;
use App\Models\ejercicio4;
use App\Models\ejercicio5;
use App\Models\ejercicio6;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class historialController extends Controller
{
    public function index(){
        $idUser = Auth::id();
        $ej1 = ejercicio1::where('idUsuario', $idUser)->get();
        $ej2 = ejercicio2::where('idUsuario', $idUser)->get();
        $ej3 = ejercicio3::where('idUsuario', $idUser)->get();
        $ej4 = ejercicio4::where('idUsuario', $idUser)->get();
        $ej5 = ejercicio5::where('idUsuario', $idUser)->get();
        $ej6 = ejercicio6::where('idUsuario', $idUser)->get();

        return view('historial', compact('ej1','ej2','ej3','ej4','ej5','ej6'));
    }
}
