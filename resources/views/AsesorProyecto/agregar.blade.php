@extends('livewire-layout')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Asesor</h3>
    </div>
</section>

@if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}  
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}  
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('c_existente'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('c_existente') }}  
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

<style>
    .custom-input {
    background-color: #BEBEBE;
    border-radius: 10px;
    color: #2E2D2F;
    border: none;
    padding: 10px;
    width: 100%;
    }

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
    .input-field select {
        background-color: #BEBEBE;
        border-radius: 10px;
        color: #2E2D2F;
        border: none;
        padding: 10px;
        width: 100%;
    }

    .input-field input[type="text"]::placeholder,
    .input-field input[type="email"]::placeholder {
        color: #2E2D2F;
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

<div style="background-color: #FFFFFF; border-radius: 30px; padding: 30px;">
    <h2 style="color: #2E2D2F; margin-bottom: 20px;">Registro de Asesor</h2>
    <form action="{{ route('asesoresproyectos.store') }}" method="POST" id="registration-form" onsubmit="return validateForm()">
    @csrf
        <div class="form-group">
            <div class="input-field">
                <label for="institutos" style="color: #2E2D2F;">Tipo de Instituto o Centro de Investigación</label>
                <select id="institutos"></select>
            </div>
        </div>
        <div class="form-group">
            <div class="input-field">
                <label for="opciones" style="color: #2E2D2F;">Opciones adicionales</label>
                <select id="CentrosOpciones"></select>
            </div>
        </div>
        <div class="form-group">
            <div class="input-field">
                <label for="departamentos" style="color: #2E2D2F;">Opciones adicionales</label>
                <select name="CentroDepartamentos" id="CentroDepartamentos"></select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group input-field" style="flex-basis: calc(13% - 0px);">
                <label for="titulo">Titulo(Lic., M.C, Dr.)</label>
                <input type="text" id="titulo" name="titulo" placeholder="Ingrese título" required>
            </div>
            <div class="form-group input-field" style="flex-basis: calc(26% - 0px);">
                <label for="nombres">Nombre(s)</label>
                <input type="text" id="nombres" name="nombres" placeholder="Ingrese nombre(s)" required>
            </div>
            <div class="form-group input-field" style="flex-basis: calc(26% - 0px);">
                <label for="apellidoPaterno">Primer Apellido</label>
                <input type="text" id="apellidoPaterno" name="apellidoPaterno" placeholder="Ingrese primer apellido" required>
            </div>
            <div class="form-group input-field" style="flex-basis: calc(26% - 0px);">
                <label for="apellidoMaterno">Segundo Apellido</label>
                <input type="text" id="apellidoMaterno" name="apellidoMaterno" placeholder="Ingrese segundo apellido">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group input-field">
                <label for="correo">Correo Institucional</label>
                <input type="email" id="correo" name="correo" placeholder="Ingrese correo institucional" required>
                <span id="correo-error" class="error-message" style="display: none;">El correo no es un correo
                    institucional válido.</span>
            </div>
            <div class="form-group input-field">
                <label for="curp">CURP</label>
                <input type="text" id="curp" name="curp" placeholder="Ingrese CURP" required>
                <span id="curp-error" class="error-message" style="display: none;">El CURP no es válido.</span>
            </div>
            <div class="form-group input-field">
                <label for="numIne">Numero de INE</label>
                <input type="text" id="numIne" name="numIne" placeholder="Ingrese número de INE" required>
                <span id="numIne-error" class="error-message" style="display: none;">El número de INE no es
                    válido.</span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group input-field">
                <label for="rfc">RFC</label>
                <input type="text" id="rfc" name="rfc" placeholder="Ingrese RFC" required>
            </div>
            <div class="form-group input-field">
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono" placeholder="Ingrese número de teléfono" required>
                <span id="telefono-error" class="error-message" style="display: none;">El número de teléfono no es
                    válido.</span>
            </div>
            <div class="form-group input-field">
                <label style="color: #2E2D2F;">Tipo de Asesor:</label>
                <select name="nivel">
                    <option value="INTERNO">Interno</option>
                    <option value="EXTERNO">Externo</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group input-field">
                <label for="licenciatura">Licenciatura</label>
                <input type="text" id="licenciatura" name="licenciatura" placeholder="Ingrese licenciatura">
            </div>
            <div class="form-group input-field">
                <label for="maestria">Maestría</label>
                <input type="text" id="maestria" name="maestria" placeholder="Ingrese maestría">
            </div>
            <div class="form-group input-field">
                <label for="doctorado">Doctorado</label>
                <input type="text" id="doctorado" name="doctorado" placeholder="Ingrese doctorado">
            </div>


            <div class="input-field">
                    <label style="color: #2E2D2F;">Fecha de Nacimiento:</label>
                    <input type="date" name="fechaNacimiento" class="custom-input" required>
            </div>

            <div class="input-field">
                    <label style="color: #2E2D2F;">Género:</label>
                    <select name="genero">
                        <option value="GEN01">Masculino</option>
                        <option value="GEN02">Femenino</option>
                    </select>
                </div>


        </div>
        <button type="submit" class="submit-button">Registrar</button>
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