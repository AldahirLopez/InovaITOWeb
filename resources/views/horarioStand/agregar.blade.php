@extends('livewire-layout')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Registro</h3>
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
<div style="background-color: #FFFFFF; border-radius: 30px; padding: 30px;">
    <h2 style="color: #2E2D2F; margin-bottom: 20px;">Formulario de Registro de horarios de stand</h2>
    <form action="{{ route('horariostand.store') }}" method="POST" id="registration-form">
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
            <label for="categoria">Stands</label>
            <select name="id_stand">
                @foreach ($stands as $stand )
                <option value="{{$stand->Id_stand}}">{{$stand->Lugar}}</option>
                @endforeach


            </select>
        </div>

        <div class="form-group input-field">

            <div class="input-field">
                <label style="color: #2E2D2F;">Fecha:</label>
                <input type="date" name="fecha" class="custom-input" required>
            </div>

        </div>

        <div class="row">
            <div class="col-6">
                <div class="input-field">
                    <label style="color: #2E2D2F;">Hora Inicio:</label>
                    <input type="time" name="hora1" class="custom-input" required>
                </div>
            </div>

            <div class="col-6">
                <div class="input-field">
                    <label style="color: #2E2D2F;">Hora Fin:</label>
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
        // Obtener los valores de fecha, hora de inicio y hora de fin
        var fechaInput = document.getElementsByName("fecha")[0];
        var horaInicio = document.getElementsByName("hora1")[0].value;
        var horaFin = document.getElementsByName("hora2")[0].value;

        // Obtener los componentes de fecha (año, mes y día)
        var fechaSeleccionada = new Date(fechaInput.value)+1;
        var añoSeleccionado = fechaSeleccionada.getFullYear();
        var mesSeleccionado = fechaSeleccionada.getMonth() + 1; // Los meses son base 0, por eso se suma 1
        var diaSeleccionado = fechaSeleccionada.getDate();

        // Obtener la fecha actual y la fecha límite superior
        var fechaActual = new Date();
        var limiteSuperiorFecha = new Date();
        limiteSuperiorFecha.setDate(limiteSuperiorFecha.getDate() + 3);

        var horaInicioValida = validarHora(horaInicio);
        var horaFinValida = validarHora(horaFin);

        var fechaValida = fechaSeleccionada >= fechaActual && fechaSeleccionada <= limiteSuperiorFecha ;
     

        // Realizar las validaciones y mostrar el mensaje de alerta si es necesario
        if (!horaInicioValida || !horaFinValida ) {
            event.preventDefault();
            alert("La hora de inicio debe estar entre las 8am y 8pm respectivamente"+limiteSuperiorFecha);
        }
        if( !fechaValida){
            event.preventDefault();
            alert("Seleccione una fecha actual");
        }
    });

    function validarHora(hora) {
        var parts = hora.split(":");
        var horaNumero = parseInt(parts[0]);
        var minutoNumero = parseInt(parts[1]);

        return (horaNumero >= 7 && horaNumero < 20) && (minutoNumero >= 0 && minutoNumero <= 59);
    }

    // Bloquear fechas anteriores a la fecha actual
    var fechaInput = document.getElementsByName("fecha")[0];
    var fechaActual = new Date();
    var yyyy = fechaActual.getFullYear();
    var mm = String(fechaActual.getMonth() + 1).padStart(2, '0');
    var dd = String(fechaActual.getDate()).padStart(2, '0');
    var fechaFormateada = yyyy + '-' + mm + '-' + dd;
    fechaInput.min = fechaFormateada;
</script>
@endsection