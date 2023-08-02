@extends('livewire-layout')

@section('content')

<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Registro Líder de Proyecto</h3>
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
    <h2 style="color: #2E2D2F; margin-bottom: 20px;">Formulario de Registro de Líder</h2>
    <form action="{{ route('lider.store') }}" method="POST" id="registration-form" onsubmit="return validateForm()">
    @csrf
        <div class="form-row">
            <div class="form-group">
                <div class="input-field">
                    <label style="color: #2E2D2F;">Nombre:</label>
                    <input type="text" name="nombre" placeholder="Ingrese nombre" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label style="color: #2E2D2F;">Primer Apellido:</label>
                    <input type="text" name="apellidoP" placeholder="Ingrese primer apellido" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label style="color: #2E2D2F;">Segundo Apellido:</label>
                    <input type="text" name="apellidoM" placeholder="Ingrese segundo apellido">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <div class="input-field">
                    <label style="color: #2E2D2F;">Matrícula:</label>
                    <input type="text" name="matricula" pattern="[a-zA-Z0-9]+" placeholder="Ingrese matrícula" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label style="color: #2E2D2F;">Correo Institucional:</label>
                    <input type="email" name="correo" id="correo" placeholder="Ingrese correo institucional" required>
                    <span id="correo-error" class="error-message" style="display: none;">El correo no es un correo institucional válido.</span>
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
        </div>
        <button class="submit-button" type="submit">Registrar</button>
    </form>
</div>

<script>
    function validateForm() {
        var correoInput = document.getElementById("correo");
        var correoError = document.getElementById("correo-error");

        var correoPattern = /^[\w-\.]+@(?:[a-zA-Z0-9][a-zA-Z0-9-]+\.)+(edu\.mx|TECNM\.MX|tecnm\.mx|EDU\.MX)$/;

        if (!correoPattern.test(correoInput.value)) {
            correoError.style.display = "block";
            return false;
        } else {
            correoError.style.display = "none";
        }

        return true;
    }
       /* var nombres = document.getElementsByName("nombre")[0].value;
    var apellidoPaterno = document.getElementsByName("apellidoP")[0].value;
    var apellidoMaterno = document.getElementsByName("apellidoM")[0].value;
    var correo = document.getElementsByName("correo")[0].value;

    var idPersona = generateIdPersona(nombres, apellidoPaterno, apellidoMaterno, correo);
    var contrasena = generateContrasena();

    // Mostrar los datos del líder registrado en la terminal
    //CHECAR ESTA PARTE SI ESTA BIEN:
    console.log("Datos del líder registrado:");
    console.log("ID Persona: " + idPersona);
    console.log("Nombre completo: " + nombres + " " + apellidoPaterno + " " + apellidoMaterno);
    console.log("Correo electrónico: " + correo);
    console.log("Contraseña: " + contrasena);
*/
    var correoInput = document.getElementById("correo");
    correoInput.addEventListener("input", function () {
        var correoError = document.getElementById("correo-error");
        var correoPattern = /^[\w-\.]+@(?:[a-zA-Z0-9][a-zA-Z0-9-]+\.)+(edu\.mx|TECNM\.MX|tecnm\.mx|EDU\.MX)$/;

        if (!correoPattern.test(correoInput.value)) {
            correoError.style.display = "block";
        } else {
            correoError.style.display = "none";
        }
    });


function generateIdPersona(nombres, apellidoPaterno, apellidoMaterno, correo) {
    var datosUsuario = nombres + apellidoPaterno + apellidoMaterno + correo;
    var idGenerada = sha1(datosUsuario).substring(0, 10);
    return idGenerada.toLowerCase();
}

function generateContrasena() {
    var caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$*-_+\\|./?';
    var contrasena = Array.from({ length: 8 }, function() {
        return caracteres.charAt(Math.floor(Math.random() * caracteres.length));
    }).join('');
    return contrasena;
}
</script>

@endsection