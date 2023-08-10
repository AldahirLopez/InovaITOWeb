@extends('layouts.auth_app')
@section('title')
Admin Login
@endsection
@section('content')
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<style>
    body {
        background: #2E2D2F;
        /* Definimos un degradado que va desde blanco (#FFFFFF) en la parte superior hasta negro (#000000) en la parte inferior */
        background: linear-gradient(to bottom, #F26E22, #2E2D2F);
        margin: 0;
        /* Aseguramos que no haya márgenes en el cuerpo de la página */
    }

    .card.card-primary {
        border-top: 6px solid #2E2D2F;
        border-bottom: 6px solid #F26E22;

    }

    .left-card {
        border-top-left-radius: 25px;
        border-bottom-left-radius: 25px;

    }

    .right-card {
        border-top-right-radius: 25px;
        border-bottom-right-radius: 25px;
    }

    .row.no-gutters {
        display: flex;
    }

    .row.no-gutters [class^="col-"] {
        display: flex;
        flex-direction: column;
        align-items: stretch;
    }

    /* Añadimos estilos para que ambas cards tengan el mismo alto */
    .left-card .card-body,
    .right-card .card-body {
        display: flex;
        flex: 1;
        align-items: center;
        justify-content: center;
        min-height: 450px;
        /* Ajusta aquí la altura deseada */
    }

    /* Estilos para la imagen */
    .right-card img {
        max-width: 100%;
        max-height: 100%;
        /* Ajustamos la propiedad object-fit para que la imagen se ajuste sin desbordarse */
        object-fit: contain;
    }

    .card .card-header h4 {
        font-size: 16px;
        line-height: 28px;
        color: black;
        padding-right: 10px;
        margin-bottom: 0;
    }

    /* Estilos para los inputs redondeados */
    .form-control {
        border-radius: 25px;
    }

    /* Estilos para resaltar los bordes de los inputs */
    .form-control:focus {
        border-color: #F26E22;
        box-shadow: 0 0 0 2px rgba(242, 110, 34, 0.2);
    }

    .btn-primary,
    .btn-primary.disabled {
        box-shadow: 0 2px 6px #acb5f6;
        background-color: #F26E22;
        border-color: #F26E22;
    }

    .btn-primary:active,
    .btn-primary:hover,
    .btn-primary.disabled:active,
    .btn-primary.disabled:hover {
        background-color: #F26E22 !important;
    }
</style>
<div class="row no-gutters">
    <div class="col-md-6">
        <div class="card card-primary left-card" style="background-color: #F2F2F2; height: 520px;">
            <div class="card-header d-flex flex-column align-items-center">
                <img src="img/logo_innovaITO.png" alt="Logo INNOVAITO" style="max-width: 100%; height: auto;">
                <h4>ACCESO</h4>
            </div>
            <br>
            <br>

            <div class="card-body">
                <form action="{{ route('login') }}" method="POST" id="registration-form">
                    @csrf
                    @if ($errors->any())
                    <div class="alert alert-danger p-0">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input aria-describedby="emailHelpBlock" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Ingresa Email" tabindex="1" value="{{ (Cookie::get('email') !== null) ? Cookie::get('email') : old('email') }}" autofocus required>
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Contraseña</label>
                        <input aria-describedby="passwordHelpBlock" id="password" type="password" value="{{ (Cookie::get('password') !== null) ? Cookie::get('password') : null }}" placeholder="Ingresa Contraseña" class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}" name="password" tabindex="2" required>
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4" style="background-color: #2E2D2F;">
                            INGRESAR
                        </button>
                        <br>

                        <a href="{{ route('recuperar.index') }}" class="btn btn-primary">Recuperar Contraseña</a>
                        <br>
                        <br>
                        <a href="{{ route('lid.index') }}" class="btn btn-primary">Registrar Lider</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <!-- Aquí se muestra la imagen en grande y se alinea a la derecha -->
        <div class="card card-primary right-card" style="background-color: #D9D9D9; height: 520px;">
            <div class="card-body text-right">
                <!-- Agregamos la clase "text-right" para alinear la imagen a la derecha -->
                <img src="img/logo_ito.png" alt="Logo ITO">
            </div>
        </div>
    </div>
</div>
@endsection