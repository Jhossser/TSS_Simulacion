<?php

use App\Http\Controllers\ejercicio1Controller;
use App\Http\Controllers\ejercicio2Controller;
use App\Http\Controllers\ejercicio3Controller;
use App\Http\Controllers\ejercicio4Controller;
use App\Http\Controllers\ejercicio5Controller;
use App\Http\Controllers\ejercicio6Controller;
use App\Http\Controllers\historialController;
use App\Http\Controllers\usuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',[usuarioController::class, 'iniciar'])->name('usuario.iniciar');
Route::post('/login',[usuarioController::class, 'login'])->name('usuario.login');
Route::post('/usuario/logout',[usuarioController::class, 'logout'])->name('usuario.logout');
Route::get('/usuario/registro',[usuarioController::class, 'registro'])->name('usuario.registro');
Route::post('/usuario/register',[usuarioController::class, 'register'])->name('usuario.register');



Route::middleware(['auth'])->group(function () {

    Route::get('/inicio', function () {
        return view('inicio');
    })->name('home');

    Route::get('/ejercicio1/index',[ejercicio1Controller::class, 'index'])->name('ej1.index');
    Route::get('/ejercicio1/edit', function () {
        return view('Ejercicio 1.edit');
    })->name('ej1.edit');
    Route::get('/ejercicio1/edit/{hist}',[ejercicio1Controller::class, 'hist'])->name('ej1.hist');
    
    Route::get('/ejercicio2/index',[ejercicio2Controller::class, 'index'])->name('ej2.index');
    Route::get('/ejercicio2/edit',[ejercicio2Controller::class, 'edit'])->name('ej2.edit');
    Route::get('/ejercicio2/edit/{hist}',[ejercicio2Controller::class, 'hist'])->name('ej2.hist');
    
    Route::get('/ejercicio3/index',[ejercicio3Controller::class, 'index'])->name('ej3.index');
    Route::get('/ejercicio3/edit',[ejercicio3Controller::class, 'edit'])->name('ej3.edit');
    Route::get('/ejercicio3/update',[ejercicio3Controller::class, 'update'])->name('ej3.update');
    Route::get('/ejercicio3/edit/{hist}',[ejercicio3Controller::class, 'hist'])->name('ej3.hist');
    
    Route::get('/ejercicio4/index',[ejercicio4Controller::class, 'index'])->name('ej4.index');
    Route::get('/ejercicio4/edit',[ejercicio4Controller::class, 'edit'])->name('ej4.edit');
    Route::get('/ejercicio4/edit/{hist}',[ejercicio4Controller::class, 'hist'])->name('ej4.hist');
    
    Route::get('/ejercicio5/index',[ejercicio5Controller::class, 'index'])->name('ej5.index');
    Route::get('/ejercicio5/edit',[ejercicio5Controller::class, 'edit'])->name('ej5.edit');
    Route::get('/ejercicio5/edit/{hist}',[ejercicio5Controller::class, 'hist'])->name('ej5.hist');
    
    Route::get('/ejercicio6/index',[ejercicio6Controller::class, 'index'])->name('ej6.index');
    Route::get('/ejercicio6/edit',[ejercicio6Controller::class, 'edit'])->name('ej6.edit');
    Route::get('/ejercicio6/update',[ejercicio6Controller::class, 'update'])->name('ej6.update');
    Route::get('/ejercicio6/edit/{hist}',[ejercicio6Controller::class, 'hist'])->name('ej6.hist');
    
    Route::get('/historial',[historialController::class, 'index'])->name('historial.index');
});


