<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\liderController;
use App\Http\Controllers\LiderMenuController;
use App\Http\Controllers\ParticipanteController;
use App\Http\Controllers\AsesorController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\CentrosController;
use App\Http\Controllers\Ficha_tController;
use App\Http\Controllers\RequerimientosController;
use App\Http\Controllers\Memoria_tController;
use App\Http\Controllers\JuradoController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProyectosPController;
use App\Http\Controllers\ProyectosAController;
use App\Http\Controllers\Tabla_partController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\T_PosicionesController;
use App\Http\Controllers\proyectosCordController;
use App\Http\Controllers\proyectosCordPendienteController;
use App\Http\Controllers\RContrasenaController;
use App\Http\Controllers\salaController;
use App\Http\Controllers\standController;
use App\Http\Controllers\ConstanciaController;
use App\Http\Controllers\ModeloController;


use App\Http\Controllers\horarioController;
use App\Http\Controllers\coordinadorController;

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
    return view('login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('lider', LiderController::class);
Route::resource('usuario', UsuarioController::class);
Route::resource('participantes', ParticipanteController::class);
Route::resource('tabla_part', Tabla_partController::class);
Route::resource('asesores', AsesorController::class);
Route::resource('proyectos', ProyectoController::class);
Route::resource('proyectosP', ProyectosPController::class);
Route::resource('proyectosA', ProyectosAController::class);
Route::resource('requerimientos', RequerimientosController::class);
Route::resource('ficha_t', Ficha_tController::class);
Route::resource('memoria_t', Memoria_tController::class);
Route::resource('jurado', JuradoController::class);
Route::resource('horario', horarioController::class);
Route::resource('t_pos', T_PosicionesController::class);
Route::resource('proyectosC', proyectosCordController::class);
Route::resource('proyectosCP', proyectosCordPendienteController::class);
Route::resource('constancia', ConstanciaController::class);
Route::resource('modelo', ModeloController::class);
Route::post('recuperar-contrasena', [RContrasenaController::class, 'RecuperarContrasena'])->name('recuperar.recuperar');
Route::get('recuperar-contrasena', [RContrasenaController::class, 'index'])->name('recuperar.index');
Route::get('lid', [LiderMenuController::class, 'index'])->name('lid.index');
Route::get('/generate-pdf', [ConstanciaController::class, 'generatePDF'])->name('generate.pdf');


//Parte de la sala y el stand
Route::resource('sala', salaController::class);
Route::resource('stand', standController::class);
//Parte del coordinador

Route::resource('coordinador',coordinadorController::class);

Route::post('/login', [App\Http\Controllers\UsuarioController::class, 'login'])->name('login');
Route::get('/logout', [App\Http\Controllers\UsuarioController::class, 'logout'])->name('logout');
Route::get('/centroTecnologicos/{selectedValue}', [App\Http\Controllers\CentrosController::class, 'cargarTecnologicos'])->name('centroTecnologicos');
Route::get('/centroDepartamentos/{selectedValue}', [App\Http\Controllers\CentrosController::class, 'cargarDepartamentos'])->name('centroDepartamentos');
Route::get('/centros', [App\Http\Controllers\CentrosController::class, 'devolvercentros'])->name('centros');
Route::get('/espectativa', [App\Http\Controllers\ParticipanteController::class, 'devolverEspectativa'])->name('espectativa');
Route::get('/carrera', [App\Http\Controllers\ParticipanteController::class, 'devolverCarrera'])->name('carrera');
Route::get('/categorias', [App\Http\Controllers\CategoriasController::class, 'devolvercategorias'])->name('categorias');
Route::get('/areas/{selectedValue}', [App\Http\Controllers\CategoriasController::class, 'cargarAreas'])->name('areas');
Route::get('/naturalezaTecnica', [App\Http\Controllers\CategoriasController::class, 'cargarNaturaleza'])->name('naturalezaTecnica');
Route::get('/validar-correo', 'App\Http\Controllers\ValidarCorreoController@checkEmail')->name('validar.correo');
Route::get('recuperar', [RContrasenaController::class, 'index'])->name('recuperar.index');
Route::post('recuperar', [RContrasenaController::class, 'RecuperarContrasena'])->name('recuperar.recuperar');
Route::post('/filtrar-proyectos', [T_PosicionesController::class,'filtrar'])->name('filtrar-proyectos');


    //parte del pdf
    Route::get('proyecto/{folio}/pdf', [App\Http\Controllers\ProyectosPController::class,'pdf'])->name('proyectos.pdf');




