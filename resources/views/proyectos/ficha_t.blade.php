@extends('livewire-layout')

@section('content')

<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Ficha Técnica</h3>
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
        color: #2E2D2F;
    }

    .input-field input[type="text"],
    .input-field input[type="email"],
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
    .input-field input[type="email"]::placeholder,
    .input-field textarea::placeholder {
        color: #2E2D2F;
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
<div style="background-color: #FFFFFF; border-radius: 30px; padding: 30px;">
    <h2 style="color: #2E2D2F; margin-bottom: 20px;">Formulario de Ficha Técnica</h2>
    <form action="{{ route('ficha_t.store') }}" method="POST"  id="ficha-tecnica-form" onsubmit="return validateForm()">
    @csrf
        <div class="form-row">
            <div class="form-group input-field">
                <label for="categoria">Categoría</label>
                <select name="categoria" id="categoria"></select>
            </div>
            <div class="form-group input-field">
                <label for="nombreCorto">Nombre Corto</label>
                <input type="text" id="nombreCorto" name="nombreCorto" placeholder="Ingrese el nombre corto" maxlength="30" required>
                <div id="nombreCorto-counter" class="counter"></div>
            </div>
            <div class="form-group input-field">
                <label for="nombreDescriptivo">Nombre Descriptivo</label>
                <input type="text" id="nombreDescriptivo" name="nombreDescriptivo" placeholder="Ingrese el nombre descriptivo" maxlength="100" required>
                <div id="nombreDescriptivo-counter" class="counter"></div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group input-field">
                <label for="areaAplicacion">Área de Aplicación</label>
                <select name="areaAplicacion" id="areaAplicacion"></select>
            </div>
            <div class="form-group input-field">
                <label for="naturalezaTecnica">Naturaleza Técnica</label>
                <select name="naturalezaTecnica" id="naturalezaTecnica"></select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group input-field">
                <label for="objetivoProyecto">Objetivo del Proyecto</label>
                <textarea id="objetivoProyecto" name="objetivoProyecto" placeholder="Ingrese el objetivo del proyecto" maxlength="500" required></textarea>
                <div id="objetivoProyecto-counter" class="counter"></div>
            </div>

            <div class="form-group input-field">
                <label for="descripcionGeneral">Descripción general de la problemática</label>
                <textarea id="descripcionGeneral" name="descripcionGeneral" placeholder="Ingrese la descripción general" maxlength="600" required></textarea>
                <div id="descripcionGeneral-counter" class="counter"></div>
            </div>
    
            <div class="form-group input-field">
                <label for="resultadosProyecto">Resultados que se pretenden alcanzar</label>
                <textarea id="resultadosProyecto" name="resultadosProyecto" placeholder="Ingrese los resultados esperados" maxlength="600" required></textarea>
                <div id="resultadosProyecto-counter" class="counter"></div>
            </div>
        </div>
        <button type="submit" class="submit-button">Registrar</button>
    </form>
</div>

<script>
    var nombreCortoInput = document.getElementById("nombreCorto");
    var nombreDescriptivoInput = document.getElementById("nombreDescriptivo");
    var objetivoProyectoInput = document.getElementById("objetivoProyecto");
    var descripcionGeneralInput = document.getElementById("descripcionGeneral");
    var resultadosProyectoInput = document.getElementById("resultadosProyecto");
    var nombreCortoCounter = document.getElementById("nombreCorto-counter");
    var nombreDescriptivoCounter = document.getElementById("nombreDescriptivo-counter");
    var objetivoProyectoCounter = document.getElementById("objetivoProyecto-counter");
    var descripcionGeneralCounter = document.getElementById("descripcionGeneral-counter");
    var resultadosProyectoCounter = document.getElementById("resultadosProyecto-counter");

    nombreCortoInput.addEventListener("input", function() {
        var remainingChars = 30 - nombreCortoInput.value.length;
        nombreCortoCounter.textContent = "Caracteres: " + nombreCortoInput.value.length + " / " + remainingChars + " restantes";
    });

    nombreDescriptivoInput.addEventListener("input", function() {
        var remainingChars = 100 - nombreDescriptivoInput.value.length;
        nombreDescriptivoCounter.textContent = "Caracteres: " + nombreDescriptivoInput.value.length + " / " + remainingChars + " restantes";
    });

    objetivoProyectoInput.addEventListener("input", function() {
        var remainingChars = 500 - objetivoProyectoInput.value.length;
        objetivoProyectoCounter.textContent = "Caracteres: " + objetivoProyectoInput.value.length + " / " + remainingChars + " restantes";
    });

    descripcionGeneralInput.addEventListener("input", function() {
        var remainingChars = 600 - descripcionGeneralInput.value.length;
        descripcionGeneralCounter.textContent = "Caracteres: " + descripcionGeneralInput.value.length + " / " + remainingChars + " restantes";
    });

    resultadosProyectoInput.addEventListener("input", function() {
        var remainingChars = 600 - resultadosProyectoInput.value.length;
        resultadosProyectoCounter.textContent = "Caracteres: " + resultadosProyectoInput.value.length + " / " + remainingChars + " restantes";
    });
</script>
<script src="{{ asset('js/areas.js') }}"></script>
@endsection
