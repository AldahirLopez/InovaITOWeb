@extends('livewire-layout')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Proyectos Aprobados</h3>
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
    background-color: #BEBEBE;
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

.switch-container input:checked + .slider {
    background-color: #FFFFFF;
}

.switch-container input:checked + .slider:before {
    transform: translateX(20px);
    background-color: #FF9500;
}

.switch-container .slider:before {
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
}

</style>
<div style="background-color: #FFFFFF; border-radius: 30px; padding: 30px;">
<a href="/proyectosCP" class="btn btn-primary" style="margin-bottom: 10px; background-color: #FA7A1E; border-radius: 20px; color: black;">Ver Proyectos Pendientes</a>
  <form id="aprobados-form" onsubmit="return validateForm()">
        @csrf
        <table class="table table-custom">
            <thead style="background-color: #FF9500;">
                <tr class="table-header">
                    <th>Nombre del proyecto</th>
                    <th>Responsable</th>
                    <th>Observaciones</th>
                    <th>Estado</th>

                </tr>
            </thead>
            <tbody>
                <!-- Aquí puedes iterar sobre tus datos para mostrar cada fila de la tabla -->
                    

                

                    @foreach ($proyectosAprobados as $proyectoAprobado)
                        <tr>
                            <td>{{$proyectoAprobado->proyecto->ficha->Nombre_corto}}</td>
                            @if ($proyectoAprobado->Id_coordinador)

                            <td>Coordinador:{{$proyectoAprobado->Id_coordinador}}</td>
                            @endif

                            <td>
                                {{$proyectoAprobado->Observaciones}}
                            </td>

                            <td>
                                @if ($proyectoAprobado->Estado==2)
                                    Aprobado
                                 @endif
                            </td>
                        </tr>
                    @endforeach
                    
               
               
                <!-- Agrega más filas según tus datos -->
            </tbody>
        </table>
    </form>
</div>
@endsection
