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
        flex-basis: 100%;
    }

    .input-field {
        margin-bottom: 20px;
        border-radius: 10px;
    }

    .input-field label {
        color: #2E2D2F;
    }

    .input-field input[type="text"],
    .input-field select,
    .input-field textarea {
        background-color: #BEBEBE;
        border-radius: 10px;
        color: #2E2D2F;
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
        color: #FA7A1E;
        font-size: 12px;
        margin-top: 5px;
    }
</style>
<div style="background-color: #FFFFFF; border-radius: 30px; padding: 30px;">
    <h2 style="color: #2E2D2F; margin-bottom: 20px;">Formulario de Memoria Técnica</h2>
    <form id="memoria-tecnica-form" onsubmit="return validateForm()" action="{{route('memoria_t.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="form-row">
            <div class="form-group input-field">
                <label for="descripcion_problematica">Descripción Problemática:</label>
                <textarea name="descripcion_problematica" id="descripcion_problematica" rows="5" cols="50" oninput="countWords('descripcion_problematica', 300)"></textarea>
                <p id="wordCount-descripcion_problematica" class="counter">0 palabras de 300</p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group input-field">
                <label for="estado_arte">Estado del Arte:</label>
                <textarea name="estado_arte" id="estado_arte" rows="5" cols="50" oninput="countWords('estado_arte', 220)"></textarea>
                <p id="wordCount-estado_arte" class="counter">0 palabras de 220</p>
            </div>
            <div class="form-group input-field">
                <label for="descripcion_innovacion">Descripción de la Innovación:</label>
                <textarea name="descripcion_innovacion" id="descripcion_innovacion" rows="5" cols="50" oninput="countWords('descripcion_innovacion', 220)"></textarea>
                <p id="wordCount-descripcion_innovacion" class="counter">0 palabras de 220</p>
            </div>
            <div class="form-group input-field">
                <label for="propuesta_valor">Propuesta de Valor:</label>
                <textarea name="propuesta_valor" id="propuesta_valor" rows="5" cols="50" oninput="countWords('propuesta_valor', 220)"></textarea>
                <p id="wordCount-propuesta_valor" class="counter">0 palabras de 220</p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group input-field" style="flex-basis: 100%">
                <label for="mercado_potencial">Mercado Potencial:</label>
                <textarea name="mercado_potencial" id="mercado_potencial" rows="5" cols="50" oninput="countWords('mercado_potencial', 300)"></textarea>
                <p id="wordCount-mercado_potencial" class="counter">0 palabras de 300</p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group input-field">
                <label for="imagen_mercado_potencial">Imagen Mercado Potencial:</label>
                <input type="file" name="imagen_mercado_potencial" id="imagen_mercado_potencial">
            </div>
            <div class="form-group input-field" style="flex-basis: 100%">
                <label for="viabilidad_tecnica">Viabilidad Técnica:</label>
                <textarea name="viabilidad_tecnica" id="viabilidad_tecnica" rows="5" cols="50" oninput="countWords('viabilidad_tecnica', 300)"></textarea>
                <p id="wordCount-viabilidad_tecnica" class="counter">0 palabras de 300</p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group input-field">
                <label for="imagen_viabilidad_tecnica">Imagen Viabilidad Técnica:</label>
                <input type="file" name="imagen_viabilidad_tecnica" id="imagen_viabilidad_tecnica">
            </div>
            <div class="form-group input-field">
                <label for="viabilidad_financiera">Viabilidad Financiera:</label>
                <textarea name="viabilidad_financiera" id="viabilidad_financiera" rows="5" cols="50" oninput="countWords('viabilidad_financiera', 220)"></textarea>
                <p id="wordCount-viabilidad_financiera" class="counter">0 palabras de 220</p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group input-field">
                <label for="imagen_viabilidad_financiera">Imagen Viabilidad Financiera:</label>
                <input type="file" name="imagen_viabilidad_financiera" id="imagen_viabilidad_financiera">
            </div>
            <div class="form-group input-field">
                <label for="estrategia_propiedad_intelectual">Estrategia Propiedad Intelectual:</label>
                <textarea name="estrategia_propiedad_intelectual" id="estrategia_propiedad_intelectual" rows="5" cols="50" oninput="countWords('estrategia_propiedad_intelectual', 110)"></textarea>
                <p id="wordCount-estrategia_propiedad_intelectual" class="counter">0 palabras de 110</p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group input-field">
                <label for="imagen_propiedad_intelectual">Imagen Propiedad Intelectual:</label>
                <input type="file" id="imagen_propiedad_intelectual" name="imagen_propiedad_intelectual" multiple>
            </div>
            <div class="form-group input-field" style="flex-basis: 100%">
                <label for="interpretacion_resultados">Interpretación de Resultados:</label>
                <textarea name="interpretacion_resultados" id="interpretacion_resultados" rows="5" cols="50" oninput="countWords('interpretacion_resultados', 300)"></textarea>
                <p id="wordCount-interpretacion_resultados" class="counter">0 palabras de 300</p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group input-field">
                <label for="fuentes_consultadas">Fuentes Consultadas:</label>
                <textarea name="fuentes_consultadas" id="fuentes_consultadas" rows="5" cols="50" oninput="countWords('fuentes_consultadas', 110)"></textarea>
                <p id="wordCount-fuentes_consultadas" class="counter">0 palabras de 110</p>
            </div>
        </div>
        <input class="submit-button" type="submit" value="Guardar">
    </form>
</div>
<script>
function validateForm() {
    return true;
}

function countWords(inputId, maxWords) {
    var mx = maxWords;
    var text = document.getElementById(inputId).value;
    var wordCount = text.trim().split(/\s+/).length;
    var counter = document.getElementById('wordCount-' + inputId);
    counter.innerText = wordCount + (wordCount === 1 ? ' palabra de ' + mx : ' palabras de ' + mx);

    // Limitar a maxWords palabras
    if (wordCount > maxWords) {
        counter.style.color = 'red';
        document.getElementById(inputId).value = text.split(/\s+/).slice(0, maxWords).join(' ');
    } else {
        counter.style.color = '#FA7A1E';
    }
}
</script>
@endsection
