@extends('livewire-layout')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Horarios</h3>
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
<div style="background-color: #2E2D2F; border-radius: 30px; padding: 30px;">
   
        <a href="{{route('horario.create')}}" class="btn btn-primary" style="margin-bottom: 10px;">Registrar horario</a>
        <table class="table table-custom">
            <thead style="background-color: #9D969B;">
                <tr class="table-header">
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                @foreach($horarios as $horario)
                <tr>
                    <td>{{$horario->Id_horario}}</td>
                    <td>{{$horario->Fecha}}</td>
                    <td>{{$horario->Hora}}</td>
                    <td>
                       
                        <a href="{{ route('horario.edit', ['horario' => $horario->Id_horario]) }}" class="btn btn-success">Editar</a>

                        <button class="btn btn-danger">Eliminar</button>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    

</div>





@endsection