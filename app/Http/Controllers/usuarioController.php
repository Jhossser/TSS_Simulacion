<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class usuarioController extends Controller
{
    public function iniciar(){
        return view('usuario.iniciarSesion');
    }

    public function login(Request $request){

        $credentials = $request->only('nombre', 'password');

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
    public function registro(){
        return view('usuario.registrar');
    }
    public function register(Request $request){
        $this->validate($request, [
            'nombre' => 'required|string|max:200|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = new User();
        $user->nombre = $request->nombre;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('usuario.iniciar');
    }
}
