<?php

namespace App\Providers;

use App\Models\proyectoAsesor;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use App\Models\Proyecto;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


        $proyectos_pendientes_coordinador = Proyecto::where('Estado_acreditacion', 1)->get();
    
        $numero_proyectos_pendientes_coordinador = $proyectos_pendientes_coordinador->count();
 



        $proyectos_pendientes_asesor = proyectoAsesor::all();
    
        $numero_proyectos_pendientes_asesor = $proyectos_pendientes_asesor->count();

        
        view()->share('numero_proyectos_pendientes_coordinador', $numero_proyectos_pendientes_coordinador);
        view()->share('numero_proyectos_pendientes_asesor', $numero_proyectos_pendientes_asesor);

        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
    }
}
