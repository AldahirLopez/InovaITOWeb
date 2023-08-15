@extends('livewire-layout')

@section('content')

<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Modelo de negocios</h3>
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
</style>
<div style="background-color: #FFFFFF; border-radius: 30px; padding: 30px;">
    <h2 style="color: #2E2D2F; margin-bottom: 20px;">Formulario de Modelo de Negocios</h2>
    <form action="{{ route('modelo.store')}}" method="POST" id="modelo-negocios-form">
        @csrf
        <div class="form-group">
            <div class="input-field">
                <label for="archivo">Subir Link Del Archivo</label>
                <input type="text" id="archivo" name="archivo">
            </div>
        </div>
</div>
<br>
<input class="submit-button" type="submit" value="Guardar">
</form>
</div>
@endsection