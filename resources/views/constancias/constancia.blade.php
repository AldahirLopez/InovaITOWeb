@extends('livewire-layout')

@section('content')


<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Generación de Constancias</h3>
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
    <h2 style="color: #2E2D2F; margin-bottom: 20px;">Generación de Constancias</h2>
    <form action="{{ route('generar.pdf') }}" method="POST" id="constancias-form">
        @csrf
         <!-- Input desplegable para seleccionar instituto tecnológico -->
         <div class="input-field">
    <label for="instituto">Seleccionar Instituto</label>
    <select id="instituto" name="instituto">
        @foreach ($institutos as $instituto)
        <option value="{{ $instituto->Clave_tecnologico}}">{{ $instituto->Nombre_tecnologico }}</option>
        @endforeach
    </select>
</div>

<!-- Agregar inputs para coordinador y director -->
<div class="input-field">
    <label for="coordinador">Nombre del Coordinador</label>
    <input type="text" id="coordinador" name="coordinador">
</div>

<div class="input-field">
    <label for="director">Nombre del Director</label>
    <input type="text" id="director" name="director">
</div>

        <!-- Input desplegable para seleccionar proyecto -->
        <div class="input-field">
            <label for="proyecto">Seleccionar Proyecto</label>
            <select id="proyecto" name="proyecto">
                @foreach ($proyectos as $proyecto)
                <option value="{{ $proyecto->Folio }}">{{ $proyecto->ficha->Nombre_corto }}</option>
                @endforeach
            </select>
        </div>

        <!-- Input desplegable para seleccionar participante (inicialmente deshabilitado) 
        <div class="input-field" id="participanteDiv" style="display: none;">
            <label for="participante">Seleccionar Participante</label>
            <select id="participante" name="participante">
                 Opciones de participantes relacionados con el proyecto seleccionado 
            </select>
        </div>-->

        <button class="btn btn-primary" href="{{ route('generar.pdf') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download"
                viewBox="0 0 16 16">
                <path
                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                <path
                    d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
            </svg>
        </button>
    </form>
</div>

<script>
// Manejo del evento de cambio en el input de proyecto
const proyectoInput = document.getElementById('proyecto');
const participanteDiv = document.getElementById('participanteDiv');
const participanteInput = document.getElementById('participante');

proyectoInput.addEventListener('change', function() {
    // Aquí puedes agregar lógica para cargar las opciones de participantes
    // relacionados con el proyecto seleccionado y habilitar el input de participante.

    // Por ejemplo, si solo quieres mostrar el input de participante después
    // de seleccionar un proyecto, puedes usar el siguiente código:

    if (proyectoInput.value !== '') {
        participanteDiv.style.display = 'block';
    } else {
        participanteDiv.style.display = 'none';
    }
});
</script>

@endsection