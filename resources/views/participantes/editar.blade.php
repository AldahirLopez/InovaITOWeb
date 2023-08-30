@extends('livewire-layout')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Registro Participantes</h3>
    </div>
</section>




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
    display: none;
}
</style>
<div style="background-color: #FFFFFF; border-radius: 30px; padding: 30px;">
    <h2 style="color: #2E2D2F; margin-bottom: 20px;">Formulario de actuzalizacion de Participantes</h2>
    <form action="{{route('participantes.update',['participante'=> $personaparticipante->Matricula])}}" method="POST" id="registration-form" onsubmit="return validateForm()">
        @method('PUT')
        @csrf
        <div class="form-row">
            <div class="form-group">
                <div class="input-field">
                    <label style="color: #2E2D2F;">Nombre:</label>
                    <input type="text" name="nombre" placeholder="Ingrese nombre" value="{{$personaparticipante->persona->Nombre_persona}}" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label style="color: #2E2D2F;">Primer Apellido:</label>
                    <input type="text" name="apellidoP" placeholder="Ingrese primer apellido" value="{{$personaparticipante->persona->Apellido1}}" required >
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label style="color: #2E2D2F;">Segundo Apellido:</label>
                    <input type="text" name="apellidoM" placeholder="Ingrese segundo apellido" value="{{$personaparticipante->persona->Apellido2}}" required>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <div class="input-field">
                    <label style="color: #2E2D2F;">Matrícula:</label>
                    <input type="text" name="matricula" pattern="[a-zA-Z0-9]+" placeholder="Ingrese matrícula" value="{{$personaparticipante->Matricula}}" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label style="color: #2E2D2F;">Promedio:</label>
                    <input type="text" name="promedio" placeholder="Ingrese su promedio" value="{{$personaparticipante->Promedio}}" >
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label style="color: #2E2D2F;">CURP</label>
                    <input type="text" id="curp" name="curp" placeholder="Ingrese su CURP" value="{{$personaparticipante->persona->Curp}}" required>
                    <span id="curp-error" class="error-message" style="display: none;">El CURP no es válido.</span>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label style="color: #2E2D2F;">Numero de INE</label>
                    <input type="text" id="numIne" name="numIne" placeholder="Ingrese su número de INE" value="{{$personaparticipante->persona->Num_ine}}" required>
                    <span id="numIne-error" class="error-message" style="display: none;">El número de INE no es
                        válido.</span>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label style="color: #2E2D2F;">Correo Institucional:</label>
                    <input type="email" name="correo" id="correo" placeholder="Ingrese correo institucional" value="{{$personaparticipante->persona->Correo_electronico}}" required>
                    <span id="correo-error" class="error-message" style="display: none;">El correo no es un correo
                        institucional válido.</span>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label style="color: #2E2D2F;">Género:</label>
                    <select name="genero">
                        @if ($personaparticipante->Id_genero=="GEN02")
                            <option value="GEN01">Hombre</option>
                            <option value="GEN02" selected>Mujer</option>
                        @else
                            <option value="GEN01" selected>Hombre</option>
                            <option value="GEN02">Mujer</option>
                        @endif
                        
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label style="color: #2E2D2F;">Expectativa:</label>
                    <select name="expectativa" id="expectativa"></select>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label style="color: #2E2D2F;">Semestre:</label>
                    <select name="semestre">
                        @if ($personaparticipante->Id_semestre=="SEM02")
                            <option value="SEM01">8</option>
                            <option value="SEM02"selected>9</option>
                            <option value="SEM03">10</option>
                        @elseif ($personaparticipante->Id_semestre=="SEM01")
                            <option value="SEM01"selected>8</option>
                            <option value="SEM02">9</option>
                            <option value="SEM03">10</option>
                        @else
                            <option value="SEM01">8</option>
                            <option value="SEM02">9</option>
                            <option value="SEM03"selected>10</option>
                        @endif
                       
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label style="color: #2E2D2F;">Fecha de Nacimiento:</label>
                    <input type="date" name="fechaNacimiento" class="custom-input" value="{{$personaparticipante->Fecha_nacimiento}}" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label style="color: #2E2D2F;">Nivel:</label>
                    <select name="nivel">
                        <option value="NIV02">Licenciatura</option>
                        <option value="NIV01">Posgrado</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label style="color: #2E2D2F;">Carrera:</label>
                    <select name="carrera" id="carrera"></select>
                </div>
            </div>
        </div>
        <button class="submit-button" type="submit">Actualizar</button>
    </form>
</div>


<div>



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

var curpInput = document.getElementById("curp");
curpInput.addEventListener("input", function() {
    var curpError = document.getElementById("curp-error");
    var curpPattern = /^[A-Z]{4}\d{6}[H,M][A-Z]{5}\w\d$/;

    if (!curpPattern.test(curpInput.value)) {
        curpError.style.display = "block";
    } else {
        curpError.style.display = "none";
    }
});

var numIneInput = document.getElementById("numIne");
numIneInput.addEventListener("input", function() {
    var numIneError = document.getElementById("numIne-error");
    var numInePattern = /^\d{13}$/;

    if (!numInePattern.test(numIneInput.value)) {
        numIneError.style.display = "block";
    } else {
        numIneError.style.display = "none";
    }
});
</script>
<script src="{{ asset('js/participante.js') }}"></script>
@endsection