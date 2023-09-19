@extends('livewire-layout')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Importar Datos</h3>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="section-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body rounded-circle">
                        <h5 class="card-title">Importar proyectos</h5>
                        <h2 class="text-right"><i class="fa fa-sheet-plastic f-left fa-2x"></i><span></span></h2>
                        <p class="m-b-0 text-right"><a href="/importarDatPro" style="color: #6c757d;">Agregar</a></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body rounded-circle">
                        <h5 class="card-title">Importar Participantes</h5>
                        <h2 class="text-right"><i class="fa fa-people-group f-left fa-2x"></i><span></span></h2>
                        <p class="m-b-0 text-right"><a href="/importarDatPart" style="color: #6c757d;">Agregar</a></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body rounded-circle">
                        <h5 class="card-title">Importar Asesores</h5>
                        <h2 class="text-right"><i class="fa fa-people-group f-left fa-2x"></i><span></span></h2>
                        <p class="m-b-0 text-right"><a href="/importarDatAse" style="color: #6c757d;">Agregar</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
