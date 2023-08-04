@extends('livewire-layout')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Participantes</h3>
    </div>
</section>



@if ($mensaje)
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $mensaje }}  
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
<div style="background-color: #2E2D2F; border-radius: 30px; padding: 30px;">
    <a href="/participantes" class="btn btn-primary" style="margin-bottom: 10px;">Registrar Participante</a>
    <form id="participantes-form" onsubmit="return validateForm()">
        @csrf
        <table class="table table-custom">
            <thead style="background-color: #9D969B;">
                <tr class="table-header">
                    <th>NOMBRE</th>
                    <th>MATRICULA</th>
                    <th>SEMESTRE</th>
                    <th>CARRERA</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datosPersonas as $datosPersona)
                <tr>
                    <td>{{ $datosPersona['nombre'] . ' ' . $datosPersona['apellido1'] . ' ' . $datosPersona['apellido2'] }}</td>
                    <td>{{ $datosPersona['matricula']}}</td>
                    <td>{{ $datosPersona['semestre']}}</td>
                    <td>{{ $datosPersona['carrera']}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>




@php    
          

use App\Models\Estudiante;
use App\Models\ProyectoParticipante;

        $usuario = session('usuario');
        $idpersona = $usuario->Id_persona;
        $persona = Estudiante::where('Id_persona', $idpersona)->first();
        $proyecto = ProyectoParticipante::where('Matricula', $persona->Matricula)->first();
        $folioproyecto = $proyecto->Folio;

        $registros_proyecto = ProyectoParticipante::where('Folio', $folioproyecto)->get();
        $GEN01 = 0;
        $GEN02 = 0;
        $carreras_diferentes = [];
        $mensajes = [];
        
        // Contar el número de registros y clasificar por género y carreras diferentes
        foreach ($registros_proyecto as $registro) {
            $estudiante = Estudiante::where('Matricula', $registro->Matricula)->first();
            if ($estudiante->Id_genero == "GEN01") {
                $GEN01++;
            } else {
                $GEN02++;
            }
        
            if (!in_array($estudiante->Id_carrera, $carreras_diferentes)) {
                $carreras_diferentes[] = $estudiante->Id_carrera;
            }
        }
        
        if (count($registros_proyecto) < 3 || count($registros_proyecto) > 5) {
            $mensajes[] = "El número de participantes no cumple con las condiciones requeridas.";
        } 
        elseif($GEN01 == 0 || $GEN02 == 0){
            $mensajes[] = "No hay al menos un participante de cada género.";

        }       
        elseif (count($carreras_diferentes) < 2) {
            $mensajes[] = "No hay al menos 2 carreras diferentes.";
        }



@endphp



@foreach ( $mensajes as  $mensaje )
    <p>{{ $mensaje}}</p>
@endforeach





</div>





@endsection