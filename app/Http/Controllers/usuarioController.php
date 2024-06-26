<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class usuarioController extends Controller
{
    public function iniciar(){
        return view('usuario.iniciarSesion');
    }

    public function login(Request $request){

        $credentials = [
            'nombre' => $request->input('nombre'),
            'password' => $request->input('contraseña'),  // Nota: La clave aquí debe ser 'password'
        ];

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            return redirect()->intended('/inicio');
        }

        return redirect()->back()->withErrors([
            'error' => 'Las credenciales proporcionadas no son válidas.',
        ]);
    }

    public function logout(Request $request){
        // Validar los datos
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
          return redirect(route('usuario.iniciar'));
    }
    public function register(Request $request){
        
    }
}
