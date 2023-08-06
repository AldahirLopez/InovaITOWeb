@extends('livewire-layout')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Proyectos Pendientes a aprobar </h3>
    </div>
</section>
<style>
    .table-header th {
        color: #FFFFFF !important;
    }

    .table td {
        color: #FFFFFF;
    }

    .table-custom {
        background-color: #4E4B4D;
        border-radius: 20px;
    }

    .switch-container {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 20px;
    }

    .switch-container input {
        display: none;
    }

    .slider {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        cursor: pointer;
        border-radius: 34px;
        background-color: #FF9500;
        transition: background-color 0.3s ease-in-out;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 2px;
        bottom: 2px;
        border-radius: 50%;
        background-color: #FFFFFF;
        transition: transform 0.3s ease-in-out;
    }

    .switch-container input:checked+.slider {
        background-color: #FFFFFF;
    }

    .switch-container input:checked+.slider:before {
        transform: translateX(20px);
        background-color: #FF9500;
    }

    .switch-container .slider:before {
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
    }
</style>

<div style="background-color: #2E2D2F; border-radius: 30px; padding: 30px;">
    <a href="/proyectosC" class="btn btn-primary" style="margin-bottom: 10px; background-color: #FA7A1E; border-radius: 20px; color: black;">Ver Proyectos Aprobados</a>

    <form method="POST" action="{{ route('proyectosC.store') }}">
        @csrf
        <table class="table table-custom">
            <thead style="background-color: #9D969B;">
                <tr class="table-header">
                    <th>ID DEL PROYECTO</th>
                    <th>NOMBRE DEL PROYECTO</th>
                    <th>CATEGORÍA</th>           
                    <th>ACCIONES</th>
                    <th>DESCARGAR</th>

            
                </tr>
            </thead>
            <tbody>
                <!-- Aquí iteramos sobre los datos de datosFichaTecnica para mostrar cada fila de la tabla -->
                @foreach ($ProyectosPendientes as $ProyectoPendiente)
                <tr>
                    <td>{{ $ProyectoPendiente->Folio }}</td>
                    <td>{{ $ProyectoPendiente->ficha->Nombre_corto }}</td>
                    <td>{{ $ProyectoPendiente->ficha->area->categoria->Nombre_categoria}}</td>

                    <td>
                   
                       
                        <label class="switch-container">
                            <input type="checkbox" name="estado_proyecto[]" value="{{$ProyectoPendiente->Folio}}">
            

                            <span class="slider"></span>
                        </label>
                 
                    </td>

                    <td>
                        <a class="btn btn-primary" href="{{route('proyectos.pdf', ['folio' => $ProyectoPendiente->Folio ])}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
  <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
  <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
</svg></a>
                    </td>


           
                </tr>
                @endforeach
                <!-- Fin del ciclo -->
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>

@endsection