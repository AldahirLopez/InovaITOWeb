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
    <h2 style="color: #FFFFFF; margin-bottom: 20px;">Formulario de Registro de horarios</h2>
    <form action="{{route('horariosala.update',['horariosala'=> $horario->Id_sala])}}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-6">
                <div class="input-field">
                    <label style="color: #FFFFFF;">Fecha:</label>
                    <input type="date" name="fecha" class="custom-input" required value="{{$horario->Fecha}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="input-field">
                    <label style="color: #FFFFFF;">Hora inicio:</label>
                    <input type="time" name="horainicio" class="custom-input" required value="{{$horario->Hora_inicio}}">
                </div>
            </div>

            <div class="col-6">
                <div class="input-field">
                    <label style="color: #FFFFFF;">Hora final:</label>
                    <input type="time" name="horafin" class="custom-input" required value="{{$horario->Hora_final	}}">
                </div>
            </div>
        </div>

        <button class="submit-button" type="submit">Editar</button>
    </form>
</div>


<div>



</div>


<script src="{{ asset('js/participante.js') }}"></script>
@endsection