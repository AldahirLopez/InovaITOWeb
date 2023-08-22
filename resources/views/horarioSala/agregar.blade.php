@extends('livewire-layout')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Registro Horario</h3>
    </div>
</section>
<style>
    .custom-input {
        background-color: #4E4B4D;
        border-radius: 10px;
        color: #FFFFFF;
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
        display: none;
    }
</style>
<div style="background-color: #2E2D2F; border-radius: 30px; padding: 30px;">
    <h2 style="color: #FFFFFF; margin-bottom: 20px;">Formulario de Registro de horarios de sala</h2>
    <form action="{{ route('horariosala.store') }}" method="POST" id="registration-form">
        @csrf

        <div class="form-group input-field">
            <label for="categoria">Proyecto</label>
            <select name="id_proyecto">
                @foreach ($proyectos as $proyecto )
                <option value="{{$proyecto->Id_fichaTecnica}}">{{$proyecto->Nombre_corto}}</option>
                @endforeach
            </select>
        </div>


        <div class="form-group input-field">
            <label for="categoria">Salas</label>
            <select name="id_sala">
                @foreach ($salas as $sala )
                <option value="{{$sala->Id_sala}}">{{$sala->Nombre_sala}}</option>
                @endforeach


            </select>
        </div>

        <div class="form-group input-field">

            <div class="input-field">
                <label style="color: #FFFFFF;">Fecha:</label>
                <input type="date" name="fecha" class="custom-input" required>
            </div>

        </div>

        <div class="row">
            <div class="col-6">
                <div class="input-field">
                    <label style="color: #FFFFFF;">Hora Inicio:</label>
                    <input type="time" name="hora1" class="custom-input" required>
                </div>
            </div>

            <div class="col-6">
                <div class="input-field">
                    <label style="color: #FFFFFF;">Hora Fin:</label>
                    <input type="time" name="hora2" class="custom-input" required>
                </div>
            </div>
        </div>

        <button class="submit-button" type="submit">Registrar</button>
    </form>
</div>
<div>
</div>
<script>
    document.getElementById("registration-form").addEventListener("submit", function(event) {
        var horaInicio = document.getElementsByName("hora1")[0].value;
        var horaFin = document.getElementsByName("hora2")[0].value;
        var fechaSeleccionada = new Date(document.getElementsByName("fecha")[0].value);
        var fechaActual = new Date();
        var limiteSuperiorFecha = new Date();
        limiteSuperiorFecha.setDate(limiteSuperiorFecha.getDate() + 3);

        var horaInicioValida = validarHora(horaInicio);
        var horaFinValida = validarHora(horaFin);
        var fechaValida = fechaSeleccionada >= fechaActual && fechaSeleccionada <= limiteSuperiorFecha;

        if (!horaInicioValida || !horaFinValida || !fechaValida) {
            event.preventDefault(); // Evitar el envío del formulario si no pasa las validaciones
            alert("Seleccione una fecha actual, la hora de inicio debe estar entre las 8am y 8pm respectivamente");
        }
    });

    function validarHora(hora) {
        var parts = hora.split(":");
        var horaNumero = parseInt(parts[0]);
        var minutoNumero = parseInt(parts[1]);

        return (horaNumero >= 7 && horaNumero < 20) && (minutoNumero >= 0 && minutoNumero <= 59);
    }
</script>

@endsection