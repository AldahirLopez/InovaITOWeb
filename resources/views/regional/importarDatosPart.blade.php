@extends('livewire-layout')

@section('content')
<style>
    /* Estilo para la pantalla de carga */
    .loading-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        padding-top: 250px;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        flex-direction: column;
        align-items: center;
    }

    /* Estilo para el spinner de carga */
    .loading-spinner {
        margin-bottom: 10px;
        /* Espacio entre la animación y el texto */
        border: 8px solid #f3f3f3;
        border-top: 8px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 2s linear infinite;
    }

    /* Estilo para el texto de carga */
    .loading-text {
        color: #ffffff;
        /* Color del texto */
        font-size: 16px;
        /* Tamaño de fuente */
    }



    @keyframes spin {
        0% {
            transform: translate(-50%, -50%) rotate(0deg);
        }

        100% {
            transform: translate(-50%, -50%) rotate(360deg);
        }
    }
</style>
<div id="loading-overlay" class="loading-overlay">
    <div class="loading-spinner"></div>
    <div class="loading-text">Sus datos se están importando, un segundo por favor</div>
</div>

<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Importar Datos</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
            <div style="background-color: #FFFFFF; border-radius: 30px; padding: 30px;">
                    <h2 style="color: #2E2D2F; margin-bottom: 20px;">Importar datos de los participantes</h2>
                    
                    <div class="card-body">
                        <p>Selecciona un archivo Excel para importar datos:</p>
                        <form action="{{ route('importar.datos.part') }}" method="POST" enctype="multipart/form-data">
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('form'); // Obtén todos los formularios en la página

        forms.forEach(form => {
            form.addEventListener('submit', function(event) {
                // Previene el envío del formulario para poder mostrar la pantalla de carga
                event.preventDefault();

                // Mostrar la pantalla de carga cuando se envía el formulario
                loadingOverlay.style.display = 'flex';

                // Luego, puedes enviar el formulario manualmente
                form.submit();
            });
        });

        const loadingOverlay = document.getElementById('loading-overlay');
    });
</script>
@endsection
