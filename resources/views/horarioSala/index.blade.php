@extends('livewire-layout')

@php
use App\Models\Ficha_Tecnica;
use App\Models\sala; // Importa la clase al comienzo de la vista, antes de la sección de contenido
@endphp
@php
use App\Models\Proyecto;
use App\Models\Estudiante;
use App\Models\Persona;
use App\Models\Usuario;
use App\Models\ProyectoParticipante;

$ficha_tecnica_registrada=False;
$requerimientos_especiales_registrada=False;
$mostrar_participantes=False;
$memoria_tecnica_registrada=False;
$modelo_negocios_registrada=False;

$usuario = session('usuario');
$idpersona = $usuario->Id_persona;
$usuarioLogueado=Usuario::where('Id_persona',$idpersona)->first();
$persona = Estudiante::where('Id_persona', $idpersona)->first();
if($usuarioLogueado->Id_rol=="ROL02"){
$proyectoParticipante = ProyectoParticipante::where('Matricula', $persona->Matricula)->first();

if($proyectoParticipante!=null){
$folioproyecto = $proyectoParticipante->Folio;

$proyecto=Proyecto::where('Folio',$folioproyecto)->first();

if($proyecto->Id_fichaTecnica!=null){
$ficha_tecnica_registrada=True;

}

}
}

@endphp

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Horarios Stand</h3>
    </div>
</section>
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif


@if (session('update'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('update') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

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


<!-- Resto del código -->

<div style="background-color: #2E2D2F; border-radius: 30px; padding: 30px;">
    @if ($usuarioLogueado->rol->Id_rol=="ROL01" || $usuarioLogueado->rol->Id_rol=="ROL07")
    <a href="{{route('horariosala.create')}}" class="btn btn-primary" style="margin-bottom: 10px;">Registrar horario</a>
    @endif
    <table class="table table-custom">
        <thead style="background-color: #9D969B;">
            <tr class="table-header">
                <th>Lugar</th>
                <th>Sala</th>
                <th>Nombre Proyecto</th>
                <th>Fecha</th>
                <th>Hora </th>
                @if ($usuarioLogueado->rol->Id_rol=="ROL01" || $usuarioLogueado->rol->Id_rol=="ROL07" )
                <th>Acciones</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($salas as $sala)
            <tr>
                <td>
                    @php
                    $nomsala = sala::where('Id_sala', $sala->Id_sala)->first();
                    @endphp
                    @if ($nomsala)
                    {{$nomsala->Lugar}}
                    @else
                    Sala no encontrada
                    @endif
                </td>
                <td>
                    @php
                    $nomsala = sala::where('Id_sala', $sala->Id_sala)->first();
                    @endphp
                    @if ($nomsala)
                    {{$nomsala->Nombre_sala}}
                    @else
                    Sala no encontrada
                    @endif
                </td>
                <td>
                    @php
                    $fichaTecnica = Ficha_Tecnica::where('Id_fichaTecnica', $sala->Folio)->first();
                    @endphp
                    @if ($fichaTecnica)
                    {{$fichaTecnica->Nombre_corto}}
                    @else
                    Folio no encontrado
                    @endif
                </td>
                <td>{{$sala->Fecha}}</td>
                <td>{{$sala->Hora_inicio}} - {{$sala->Hora_final}}</td>
                @if ($usuarioLogueado->rol->Id_rol=="ROL01" || $usuarioLogueado->rol->Id_rol=="ROL07" )
                <td>
                    <a href="{{ route('horariosala.edit', ['horariosala' => $sala->Id_sala]) }}" class="btn btn-success">Editar</a>
                    <a href="{{ route('horariosala.destroy', ['horariosala' => $sala->Id_sala]) }}" class="btn btn-danger">Eliminar</a>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection