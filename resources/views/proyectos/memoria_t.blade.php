@extends('livewire-layout')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Memoria Técnica</h3>
    </div>
</section>

<style>
    .form-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .form-group {
        flex-basis: calc(33.33% - 10px);
    }

    .input-field {
        margin-bottom: 20px;
        border-radius: 10px;
    }

    .input-field label {
        color: #FFFFFF;
    }

    .input-field input[type="text"],
    .input-field select,
    .input-field textarea {
        background-color: #4E4B4D;
        border-radius: 10px;
        color: #FFFFFF;
        border: none;
        padding: 10px;
        width: 100%;
    }

    .input-field input[type="text"]::placeholder,
    .input-field textarea::placeholder {
        color: #BEBEBE;
    }

    .input-field textarea {
        resize: none;
    }

    .submit-button {
        width: 100%;
        height: 50px;
        background-color: #FA7A1E;
        color: #FFFFFF;
        font-size: 25px;
        border: none;
        border-radius: 15px;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
    }

    .submit-button:active {
        transform: scale(0.95);
    }

    .error-message {
        color: red;
    }

    .counter {
        color: #BEBEBE;
        font-size: 12px;
        margin-top: 5px;
    }
</style>

<div style="background-color: #2E2D2F; border-radius: 30px; padding: 30px;">
    <h2 style="color: #FFFFFF; margin-bottom: 20px;">Formulario de Memoria Técnica</h2>
    <form id="memoria-tecnica-form" action="guardar_memoria_tecnica.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        <div class="form-row">
    
            <div class="form-group input-field">
                <label for="descripcion_problematica">Descripción Problemática:</label>
                <textarea name="descripcion_problematica" rows="5" cols="50"></textarea>
            </div>
            <div class="form-group input-field">
                <label for="estado_arte">Estado del Arte:</label>
                <input type="text" name="estado_arte">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group input-field">
                <label for="descripcion_innovacion">Descripción de la Innovación:</label>
                <input type="text" name="descripcion_innovacion">
            </div>
            <div class="form-group input-field">
                <label for="propuesta_valor">Propuesta de Valor:</label>
                <input type="text" name="propuesta_valor">
            </div>
            <div class="form-group input-field">
                <label for="mercado_potencial">Mercado Potencial:</label>
                <textarea name="mercado_potencial" rows="5" cols="50"></textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group input-field">
                <label for="imagen_mercado_potencial">Imagen Mercado Potencial:</label>
                <input type="file" name="imagen_mercado_potencial">
            </div>
            <div class="form-group input-field">
                <label for="viabilidad_tecnica">Viabilidad Técnica:</label>
                <textarea name="viabilidad_tecnica" rows="5" cols="50"></textarea>
            </div>
            <div class="form-group input-field">
                <label for="imagen_viabilidad_tecnica">Imagen Viabilidad Técnica:</label>
                <input type="file" name="imagen_viabilidad_tecnica">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group input-field">
                <label for="viabilidad_financiera">Viabilidad Financiera:</label>
                <input type="text" name="viabilidad_financiera">
            </div>
            <div class="form-group input-field">
                <label for="imagen_viabilidad_financiera">Imagen Viabilidad Financiera:</label>
                <input type="file" name="imagen_viabilidad_financiera">
            </div>
            <div class="form-group input-field">
                <label for="estrategia_propiedad_intelectual">Estrategia Propiedad Intelectual:</label>
                <input type="text" name="estrategia_propiedad_intelectual">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group input-field">
                <label for="imagen_propiedad_intelectual">Imagen Propiedad Intelectual:</label>
                <input type="file" name="imagen_propiedad_intelectual">
            </div>
            <div class="form-group input-field">
                <label for="interpretacion_resultados">Interpretación de Resultados:</label>
                <textarea name="interpretacion_resultados" rows="5" cols="50"></textarea>
            </div>
            <div class="form-group input-field">
                <label for="fuentes_consultadas">Fuentes Consultadas:</label>
                <input type="text" name="fuentes_consultadas">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group input-field">
                <label for="archivo_adjunto">Archivo Adjunto:</label>
                <input type="file" name="archivo_adjunto">
            </div>
            <div class="form-group input-field">
                <label for="fecha">Fecha:</label>
                <input type="text" name="fecha">
            </div>
            <div class="form-group input-field">
                <label for="responsable">Responsable:</label>
                <input type="text" name="responsable">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group input-field">
                <label for="estado">Estado:</label>
                <input type="text" name="estado">
            </div>
            <div class="form-group input-field">
                <label for="observaciones">Observaciones:</label>
                <textarea name="observaciones" rows="5" cols="50"></textarea>
            </div>
        </div>
        <input class="submit-button" type="submit" value="Guardar">
    </form>
</div>

<script>
    function validateForm() {
        // Aquí puedes agregar tu lógica de validación si es necesario
        return true;
    }
</script>
@endsection
