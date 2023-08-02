@extends('livewire-layout')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Participantes</h3>
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
</div>


@endsection