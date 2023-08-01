@extends('layouts.auth_app')
@section('title')
    Admin Login
@endsection
@section('content')
    <div class="row no-gutters">
        <div class="col-md-6">
            <div class="card card-primary" style="background-color: #F2F2F2;">
                <div class="card-header"><h4>Login</h4></div>

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
                            <input aria-describedby="emailHelpBlock" id="email" type="email"
                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                placeholder="Enter Email" tabindex="1"
                                value="{{ (Cookie::get('email') !== null) ? Cookie::get('email') : old('email') }}"
                                autofocus required>
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        </div>

                        <div class="form-group">
                            <input aria-describedby="passwordHelpBlock" id="password" type="password"
                                value="{{ (Cookie::get('password') !== null) ? Cookie::get('password') : null }}"
                                placeholder="Enter Password"
                                class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}" name="password"
                                tabindex="2" required>
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <!-- Aquí se muestra la imagen en grande y se alinea a la derecha -->
            <div class="card" style="background-color: #D9D9D9;">
                <div class="card-body text-right"> <!-- Agregamos la clase "text-right" para alinear la imagen a la derecha -->
                    <img src="img/logo_ito.png" alt="Logo ITO" style="max-width: 100%; height: auto;">
                </div>
            </div>
        </div>
    </div>
@endsection
