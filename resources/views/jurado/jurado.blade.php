@extends('livewire-layout')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Registro Jurado</h3>
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
    .input-field input[type="email"],
    .input-field select {
        background-color: #4E4B4D;
        border-radius: 10px;
        color: #FFFFFF;
        border: none;
        padding: 10px;
        width: 100%;
    }

    .input-field input[type="text"]::placeholder,
    .input-field input[type="email"]::placeholder {
        color: #BEBEBE;
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
</style>

<div style="background-color: #2E2D2F; border-radius: 30px; padding: 30px;">
    <h2 style="color: #FFFFFF; margin-bottom: 20px;">Formulario de Registro de Jurado</h2>
    <form id="registration-form" onsubmit="return validateForm()">
    @csrf
        <div class="form-row">
            <div class="form-group input-field" style="flex-basis: calc(26% - 0px);">
                <label for="nombres">Nombre(s)</label>
                <input type="text" id="nombres" name="nombres" placeholder="Ingrese su nombre(s)" required>
            </div>
            <div class="form-group input-field" style="flex-basis: calc(26% - 0px);">
                <label for="apellidoPaterno">Primer Apellido</label>
                <input type="text" id="apellidoPaterno" name="apellidoPaterno" placeholder="Ingrese su primer apellido" required>
            </div>
            <div class="form-group input-field" style="flex-basis: calc(26% - 0px);">
                <label for="apellidoMaterno">Segundo Apellido</label>
                <input type="text" id="apellidoMaterno" name="apellidoMaterno" placeholder="Ingrese su segundo apellido">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group input-field">
                <label for="correo">Correo Institucional</label>
                <input type="email" id="correo" name="correo" placeholder="Ingrese su correo institucional" required>
                <span id="correo-error" class="error-message" style="display: none;">El correo no es un correo
                    institucional válido.</span>
            </div>
            <div class="form-group input-field">
                <label for="curp">CURP</label>
                <input type="text" id="curp" name="curp" placeholder="Ingrese su CURP" required>
                <span id="curp-error" class="error-message" style="display: none;">El CURP no es válido.</span>
            </div>
            <div class="form-group input-field">
                <label for="numIne">Numero de INE</label>
                <input type="text" id="numIne" name="numIne" placeholder="Ingrese su número de INE" required>
                <span id="numIne-error" class="error-message" style="display: none;">El número de INE no es
                    válido.</span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group input-field">
                <label for="rfc">RFC</label>
                <input type="text" id="rfc" name="rfc" placeholder="Ingrese su RFC" required>
                <span id="rfc-error" class="error-message" style="display: none;">El RFC no es válido.</span>
            </div>
            <div class="form-group input-field">
                <label for="telefono">Telefono</label>
                <input type="text" id="telefono" name="telefono" placeholder="Ingrese su número de teléfono" required>
                <span id="telefono-error" class="error-message" style="display: none;">El número de teléfono no es
                    válido.</span>
            </div>
        </div>
        <button type="submit" class="submit-button">Enviar</button>
    </form>
</div>
<script>
    function validateForm() {
        var valid = true;

        var correoInput = document.getElementById("correo");
        var correoError = document.getElementById("correo-error");
        var correoPattern = /^[\w-\.]+@(?:[a-zA-Z0-9][a-zA-Z0-9-]+\.)+(edu\.mx|TECNM\.MX|tecnm\.mx|EDU\.MX)$/;

        if (!correoPattern.test(correoInput.value)) {
            correoError.style.display = "block";
            valid = false;
        } else {
            correoError.style.display = "none";
        }

        var curpInput = document.getElementById("curp");
        var curpError = document.getElementById("curp-error");
        var curpPattern = /^[A-Z]{4}\d{6}[H,M][A-Z]{5}\w\d$/;

        if (!curpPattern.test(curpInput.value)) {
            curpError.style.display = "block";
            valid = false;
        } else {
            curpError.style.display = "none";
        }

        var numIneInput = document.getElementById("numIne");
        var numIneError = document.getElementById("numIne-error");
        var numInePattern = /^\d{13}$/;

        if (!numInePattern.test(numIneInput.value)) {
            numIneError.style.display = "block";
            valid = false;
        } else {
            numIneError.style.display = "none";
        }

        var rfcInput = document.getElementById("rfc");
        var rfcError = document.getElementById("rfc-error");
        var rfcPattern = /^[A-Z]{4}\d{6}\w\d$/;

        if (!rfcPattern.test(rfcInput.value)) {
            rfcError.style.display = "block";
            valid = false;
        } else {
            rfcError.style.display = "none";
        }

        var telefonoInput = document.getElementById("telefono");
        var telefonoError = document.getElementById("telefono-error");
        var telefonoPattern = /^\d{10}$/;

        if (!telefonoPattern.test(telefonoInput.value)) {
            telefonoError.style.display = "block";
            valid = false;
        } else {
            telefonoError.style.display = "none";
        }

        return valid;
    }

    var correoInput = document.getElementById("correo");
    correoInput.addEventListener("input", function() {
        var correoError = document.getElementById("correo-error");
        var correoPattern = /^[\w-\.]+@(?:[a-zA-Z0-9][a-zA-Z0-9-]+\.)+(edu\.mx|TECNM\.MX|tecnm\.mx|EDU\.MX)$/;

        if (!correoPattern.test(correoInput.value)) {
            correoError.style.display = "block";
        } else {
            correoError.style.display = "none";
        }
    });
</script>
<script src="{{ asset('js/models.js') }}"></script>

@endsection