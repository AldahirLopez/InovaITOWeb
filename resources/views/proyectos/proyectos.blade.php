@extends('livewire-layout')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Registro Proyecto</h3>
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
                <div class="card">
                    <div class="card-body rounded-circle"> <!-- Cambiamos la clase 'rounded' por 'rounded-circle' aquí -->
                        <div class="row">
                            @if ($ficha_tecnica_habilitada)
                            <div class="col-md-6 col-xl-6">
                            <div class="card {{ $ficha_tecnica_registrada ? ' bg-c-green' : 'bg-danger' }} order-card ">
                                    <div class="card-block ">
                                        <h5>Ficha técnica</h5>
                                        <h2 class="text-right"><i class="fa fa-sheet-plastic f-left fa-2x"></i><span></span></h2>
                                        <p class="m-b-0 text-right"><a href="{{ route('ficha_t.index') }}" class="text-white">Agregar</a></p>
                                    </div>
                                </div>
                            </div>
                            @endif
                           
                            @if ($requerimientos_especiales_habilitada)
                            <div class="col-md-6 col-xl-6">
                            <div class="card {{ $requerimientos_especiales_habilitada ? ' bg-c-green' : 'bg-danger' }} order-card ">
                                    <div class="card-block">
                                        <h5>Requerimientos especiales</h5>
                                        <h2 class="text-right"><i class="fa fa-square-check f-left fa-2x"></i><span></span></h2>
                                        <p class="m-b-0 text-right"><a href="{{ route('requerimientos.index') }}" class="text-white">Agregar</a></p>
                                    </div>
                                </div>
                            </div>
                            @endif
                           
                            @if ($memoria_tecnica_habilitada)
                                
                            <div class="col-md-6 col-xl-6">
                            <div class="card {{ $memoria_tecnica_registrada ? ' bg-c-green' : 'bg-danger' }} order-card">
                                    <div class="card-block">
                                        <h5>Memoria técnica</h5>
                                        <h2 class="text-right"><i class="fa fa-file-invoice f-left fa-2x"></i><span></span></h2>
                                            @if ($memoria_tecnica_registrada)
                                            <p class="m-b-0 text-right text-white">Registrado</p>
                                            @else
                                            <p class="m-b-0 text-right"><a href="{{ route('memoria_t.index') }}" class="text-white">Agregar</a></p>
                                            @endif


                                       
                                    </div>
                                </div>
                            </div>
                            @endif


                            @if ($modelo_negocios_habilitada)
                            <div class="col-md-6 col-xl-6">
                                <div class="card {{ $modelo_negocios_registrada ? ' bg-c-green' : 'bg-danger' }} order-card">
                                    <div class="card-block">
                                        <h5>Modelo de negocios</h5>
                                        <h2 class="text-right"><i class="fa fa-file-invoice-dollar f-left fa-2x"></i><span></span></h2>
                                        @if ($modelo_negocios_registrada)
                                        <p class="m-b-0 text-right text-white">Registrado</p>
                                        @else
                                        <p class="m-b-0 text-right"><a href="{{ route('modelo.index') }} " class="text-white">Agregar</a></p>
                                        @endif

                                        
                                    </div>
                                </div>
                            </div>
                            @endif
                          

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
