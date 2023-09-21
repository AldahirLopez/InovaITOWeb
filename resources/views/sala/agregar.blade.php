@extends('livewire-layout')

@section('content')

<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Sala</h3>
    </div>
 
</section>

<style>
    .form-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .form-group {
        flex-basis: calc(50% - 10px); /* Cambiamos el ancho a 50% para dos por fila */
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
    <h2 style="color: #2E2D2F; margin-bottom: 20px;">Registrar Sala</h2>
    <form action="{{ route('sala.store') }}" method="POST">
        @csrf
        <div class="form-row">
            <div class="form-group input-field">
                <label for="nombreDescriptivo">Nombre de la Sala</label>
                <input type="text" name="nombre" placeholder="Ingrese el nombre de la sala" maxlength="100" required>
            </div>
            <div class="form-group input-field">
                <label for="lugar">Lugar</label>
                <input type="text" name="lugar" placeholder="Ingrese el lugar" maxlength="100" required>
            </div>
            <!-- 

            <div class="form-group input-field">
                <label for="jurado1">Jurado 1</label>
                <select name="jurado1" required>
                    <option value="">Seleccione un jurado</option>
                    @foreach ($jurados as $jurado )
                    <option value="{{$jurado->Id_jurado	}}">{{$jurado->persona->Nombre_persona}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group input-field">
                <label for="jurado2">Jurado 2</label>
                <select name="jurado2" required>
                    <option value="">Seleccione un jurado</option>
                    @foreach ($jurados as $jurado )
                    <option value="{{$jurado->Id_jurado	}}">{{$jurado->persona->Nombre_persona}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group input-field">
                <label for="jurado3">Jurado 3</label>
                <select name="jurado3" required>
                    <option value="">Seleccione un jurado</option>
                    @foreach ($jurados as $jurado )
                    <option value="{{$jurado->Id_jurado	}}">{{$jurado->persona->Nombre_persona}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group input-field">
                <label for="moderador">Moderador</label>
                <select name="moderador" required>
                    <option value="">Seleccione un moderador</option>
                    @foreach ($moderadores as $moderador )

                    @endforeach
                </select>
            </div>
            -->
        </div>
        <button type="submit" class="submit-button">Registrar</button>
    </form>
</div>

<script src="{{ asset('js/areas.js') }}"></script>
@endsection
