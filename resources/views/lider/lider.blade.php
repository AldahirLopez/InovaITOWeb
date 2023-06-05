@extends('livewire-layout')

@section('content')

<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Registro Lider de Proyecto</h3>
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
    <h2 style="color: #FFFFFF; margin-bottom: 20px;">Formulario de Registro de Lider</h2>
    <form id="registration-form" onsubmit="return validateForm()">
        <div class="form-row">
            <div class="form-group">
                <div class="input-field">
                    <label style="color: #FFFFFF;">Nombre:</label>
                    <input type="text" name="nombre" placeholder="Ingrese nombre" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label style="color: #FFFFFF;">Primer Apellido:</label>
                    <input type="text" name="apellidoP" placeholder="Ingrese primer apellido" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label style="color: #FFFFFF;">Segundo Apellido:</label>
                    <input type="text" name="apellidoM" placeholder="Ingrese segundo apellido">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <div class="input-field">
                    <label style="color: #FFFFFF;">Matrícula:</label>
                    <input type="text" name="matricula" pattern="[a-zA-Z0-9]+" placeholder="Ingrese matrícula" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label style="color: #FFFFFF;">Correo Institucional:</label>
                    <input type="email" name="correo" id="correo" placeholder="Ingrese correo institucional" required>
                    <span id="correo-error" class="error-message" style="display: none;">El correo no es un correo
                        institucional válido.</span>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label style="color: #FFFFFF;">Nivel:</label>
                    <select name="nivel">
                        <option value="LICENCIATURA">Licenciatura</option>
                        <option value="POSGRADO">Posgrado</option>
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
</script>
@endsection