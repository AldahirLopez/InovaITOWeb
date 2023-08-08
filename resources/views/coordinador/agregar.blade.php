@extends('livewire-layout')

@section('content')

<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Registro de Coordinador</h3>
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
    <h2 style="color: #2E2D2F; margin-bottom: 20px;">Formulario de Registro de Coordinador</h2>
    <form action="{{ route('coordinador.store') }}" method="POST" id="registration-form" onsubmit="return validateForm()">
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
                    <label style="color: #2E2D2F;">Telefono:</label>
                    <input type="text" name="telefono" pattern="[a-zA-Z0-9]+" placeholder="Ingrese su telefono" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label style="color: #2E2D2F;">Correo electronico:</label>
                    <input type="email" name="correo" " placeholder="Ingrese correo institucional" required>
                    
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label style="color: #2E2D2F;">No.Identificacion:</label>
                    <input type="text" name="identificacion" placeholder="Ingrese numero de identificacion" required>
                  
                </div>
            </div>

            <div class="form-group">
                <div class="input-field">
                    <label style="color: #2E2D2F;">CURP:</label>
                    <input type="text" name="curp"  placeholder="Ingrese su curp" required>
                
                </div>
            </div>

            <div class="form-group">
                <div class="input-field">
                    <label style="color: #2E2D2F;">ID_coordinador:</label>
                    <input type="text" name="id_coordinador"  placeholder="Ingrese el id del coordinador" required>
                
                </div>
            </div>

            <div class="form-group input-field">
                <label for="categoria">Tecnologico</label>
                <select name="Clave_tecnologico">
                    @foreach ($tecnologicos as $tecnologico )
                    <option value="{{$tecnologico->Clave_tecnologico}}">{{$tecnologico->Nombre_tecnologico}}</option>
                    @endforeach
                   

                </select>
            </div>
          
        </div>
        <button class="submit-button" type="submit">Registrar</button>
    </form>
</div>



@endsection