<?php

use Illuminate\Support\Facades\Route;

//Agregamos los controladores 
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ObrasController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\SalidasController;
use App\Http\Controllers\EntradasController;

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
    return view('home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/lider', [App\Http\Controllers\liderController::class, 'index'])->name('lider');

Route::get('/participantes', [App\Http\Controllers\participanteController::class, 'index'])->name('participantes');
Route::get('/asesores', [App\Http\Controllers\AsesorController::class, 'index'])->name('asesores');
Route::get('/proyectos', [App\Http\Controllers\proyectoController::class, 'index'])->name('proyectos');

    



