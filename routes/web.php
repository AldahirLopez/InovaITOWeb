<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\liderController;
use App\Http\Controllers\ParticipanteController;
use App\Http\Controllers\AsesorController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\CentrosController;

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
Route::resource('lider', LiderController::class);
Route::resource('participantes', ParticipanteController::class);
Route::resource('asesores', AsesorController::class);
Route::resource('proyectos', ProyectoController::class);
Route::get('/centroTecnologicos/{selectedValue}', [App\Http\Controllers\CentrosController::class, 'cargarTecnologicos'])->name('centroTecnologicos');
Route::get('/centroDepartamentos/{selectedValue}', [App\Http\Controllers\CentrosController::class, 'cargarDepartamentos'])->name('centroDepartamentos');
Route::get('/centros', [App\Http\Controllers\CentrosController::class, 'devolvercentros'])->name('centros');




    



