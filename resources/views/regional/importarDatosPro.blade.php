@extends('livewire-layout')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Importar Datos</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
            <div style="background-color: #FFFFFF; border-radius: 30px; padding: 30px;">
                    <h2 style="color: #2E2D2F; margin-bottom: 20px;">Importar datos de los proyectos</h2>
                    
                    <div class="card-body">
                        <p>Selecciona un archivo Excel para importar datos:</p>
                        <form action="{{ route('importar.datos.pro') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group mb-3" >
                                <input type="file" class="form-control" name="excel_file" accept=".xlsx, .xls, .csv">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-upload"></i> Subir Archivo
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
