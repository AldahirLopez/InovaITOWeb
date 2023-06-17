<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\liderController;
use App\Http\Controllers\ParticipanteController;
use App\Http\Controllers\AsesorController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\CentrosController;
use App\Http\Controllers\Ficha_tController;
use App\Http\Controllers\RequerimientosController;
use App\Http\Controllers\Memoria_tController;
use App\Http\Controllers\CategoriasController;


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
Route::resource('requerimientos', RequerimientosController::class);
Route::resource('ficha_t', Ficha_tController::class);
Route::resource('memoria_t', Memoria_tController::class);
Route::get('/centroTecnologicos/{selectedValue}', [App\Http\Controllers\CentrosController::class, 'cargarTecnologicos'])->name('centroTecnologicos');
Route::get('/centroDepartamentos/{selectedValue}', [App\Http\Controllers\CentrosController::class, 'cargarDepartamentos'])->name('centroDepartamentos');
Route::get('/centros', [App\Http\Controllers\CentrosController::class, 'devolvercentros'])->name('centros');
Route::get('/categorias', [App\Http\Controllers\CategoriasController::class, 'devolvercategorias'])->name('categorias');
Route::get('/areas/{selectedValue}', [App\Http\Controllers\CategoriasController::class, 'cargarAreas'])->name('areas');
Route::get('/naturalezaTecnica', [App\Http\Controllers\CategoriasController::class, 'cargarNaturaleza'])->name('naturalezaTecnica');

    



