@extends('livewire-layout')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Coordinadores registrado</h3>
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

@if (session('duplicado'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('duplicado') }}
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
        color: #2E2D2F;
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
    .disable {
        pointer-events: none;
        text-decoration:none;
        
}
</style>

<div style="background-color: #FFFFFF; border-radius: 30px; padding: 30px;">

<a href="/coordinador/create" class="btn btn-primary" style="margin-bottom: 10px;" >Registrar coordinador</a>


<table class="table table-custom">
    <thead style="background-color: #FF9500;">
        <tr class="table-header">
            <th>ID_COORDINADOR</th>
            <th>Nombre</th>
            <th>Tecnologico</th>

        </tr>
    </thead>
    <tbody>
        @foreach($coordinadores as $coordinador)
     
        <tr>
            <td>{{ $coordinador->Id_coordinador}}</td>
            <td>{{ $coordinador->persona->Nombre_persona}}</td>
            <td>{{ $coordinador->tecnologico->Nombre_tecnologico}}</td>

        </tr>

 

        <!-- Fin del Modal -->

        @endforeach
    </tbody>
</table>


</div>





@endsection