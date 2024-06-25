<?php

use App\Http\Controllers\ejercicio3Controller;
use App\Http\Controllers\ejercicio4Controller;
use App\Http\Controllers\ejercicio5Controller;
use App\Http\Controllers\ejercicio6Controller;
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

Route::get('/', function () {
    return view('inicio');
})->name('home');

Route::get('/ejercicio3/index',[ejercicio3Controller::class, 'index'])->name('ej3.index');
Route::get('/ejercicio3/edit',[ejercicio3Controller::class, 'edit'])->name('ej3.edit');
Route::get('/ejercicio3/update',[ejercicio3Controller::class, 'update'])->name('ej3.update');


Route::get('/ejercicio4/index',[ejercicio4Controller::class, 'index'])->name('ej4.index');
Route::get('/ejercicio4/edit',[ejercicio4Controller::class, 'edit'])->name('ej4.edit');
Route::get('/ejercicio4/update',[ejercicio4Controller::class, 'update'])->name('ej4.update');

Route::get('/ejercicio5/index',[ejercicio5Controller::class, 'index'])->name('ej5.index');
Route::get('/ejercicio5/edit',[ejercicio5Controller::class, 'edit'])->name('ej5.edit');
Route::get('/ejercicio5/update',[ejercicio5Controller::class, 'update'])->name('ej5.update');

Route::get('/ejercicio6/index',[ejercicio6Controller::class, 'index'])->name('ej6.index');
Route::get('/ejercicio6/edit',[ejercicio6Controller::class, 'edit'])->name('ej6.edit');
Route::get('/ejercicio6/update',[ejercicio6Controller::class, 'update'])->name('ej6.update');

Route::get('/ejercicio2/index', function () {
    return view('Ejercicio 2.index');
})->name('home');



