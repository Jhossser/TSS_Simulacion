<?php

use App\Http\Controllers\ejercicio3Controller;
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


