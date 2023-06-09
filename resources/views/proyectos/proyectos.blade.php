@extends('livewire-layout')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Registro Proyecto</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6 col-xl-6">
                                <div class="card bg-c-gris order-card">
                                    <div class="card-block">
                                        <h5>Ficha técnica</h5>
                                        <h2 class="text-right"><i class="fa fa-sheet-plastic f-left fa-2x"></i><span></span></h2>
                                        <p class="m-b-0 text-right"><a href="{{ route('ficha_t.index') }}" class="text-white">Agregar</a></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-6">
                                <div class="card bg-c-gris order-card">
                                    <div class="card-block">
                                        <h5>Requerimientos especiales</h5>
                                        <h2 class="text-right"><i class="fa fa-square-check f-left fa-2x"></i><span></span></h2>
                                        <p class="m-b-0 text-right"><a href="{{ route('requerimientos.index') }}" class="text-white">Agregar</a></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-6">
                                <div class="card bg-c-gris order-card">
                                    <div class="card-block">
                                        <h5>Memoria técnica</h5>
                                        <h2 class="text-right"><i class="fa fa-file-invoice f-left fa-2x"></i><span></span></h2>
                                        <p class="m-b-0 text-right"><a href="{{ route('memoria_t.index') }}" class="text-white">Agregar</a></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-6">
                                <div class="card bg-c-gris order-card">
                                    <div class="card-block">
                                        <h5>Modelo de negocios</h5>
                                        <h2 class="text-right"><i class="fa fa-file-invoice-dollar f-left fa-2x"></i><span></span></h2>
                                        <p class="m-b-0 text-right"><a href="#" class="text-white">Agregar</a></p>
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
