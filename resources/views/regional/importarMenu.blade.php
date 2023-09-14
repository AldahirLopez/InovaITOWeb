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
            <div class="col-lg-12">
                <div class="card align-items-stretch"> <!-- Agregamos la clase 'align-items-stretch' al contenedor de tarjetas -->
                    <div class="card-body rounded-circle"> <!-- Cambiamos la clase 'rounded' por 'rounded-circle' aquí -->
                        <div class="row">
                            <div class="col-md-6 col-xl-6">
                                <div class="card bg-c-gris order-card h-100"> <!-- Agregamos la clase 'h-100' para igualar el tamaño -->
                                    <div class="card-block">     
                                        <h5>Importar proyectos</h5>
                                        <h2 class="text-right"><i class="fa fa-sheet-plastic f-left fa-2x"></i><span></span></h2>
                                        <p class="m-b-0 text-right"><a href="/importarDatPro" class="text-white">Agregar</a></p>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-md-6 col-xl-6">
                                <div class="card bg-c-gris order-card h-100"> <!-- Agregamos la clase 'h-100' para igualar el tamaño -->
                                    <div class="card-block">          
                                        <h5>Importar Participantes</h5>
                                        <h2 class="text-right"><i class="fa fa-people-group f-left fa-2x"></i><span></span></h2>
                                        <p class="m-b-0 text-right"><a href="/importarDatPart" class="text-white">Agregar</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
