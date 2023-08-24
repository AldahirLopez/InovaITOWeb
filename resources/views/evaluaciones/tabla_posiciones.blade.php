@extends('livewire-layout')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Tabla de Posiciones</h3>
    </div>
</section>
<style>
    .table-header th {
        color: #FFFFFF !important;
    }

    .table td {
        color: #2E2D2F;
    }

    .table-custom {
        background-color: #BEBEBE;
        border-radius: 20px;
    }

    .switch-container {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 20px;
    }

    .switch-container input {
        display: none;
    }

    .input-field select {
        background-color: #BEBEBE;
        border-radius: 10px;
        color: #2E2D2F;
        border: none;
        padding: 10px;
        width: 100%;
    }

    .slider {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        cursor: pointer;
        border-radius: 34px;
        background-color: #FF9500;
        transition: background-color 0.3s ease-in-out;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 2px;
        bottom: 2px;
        border-radius: 50%;
        background-color: #FFFFFF;
        transition: transform 0.3s ease-in-out;
    }

    .switch-container input:checked+.slider {
        background-color: #FFFFFF;
    }

    .switch-container input:checked+.slider:before {
        transform: translateX(20px);
        background-color: #FF9500;
    }

    .switch-container .slider:before {
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
    }
    .input-field {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .input-field label {
        margin-right: 10px;
    }

    .input-field select {
        background-color: #BEBEBE;
        border-radius: 10px;
        color: #2E2D2F;
        border: none;
        padding: 6px; /* Ajusta el tamaño vertical del select */
        width: 180px; /* Ajusta el ancho del select */
        margin-right: 10px; /* Agrega un margen derecho para separar del botón */
    }

    .input-field button {
        background-color: #FF9500;
        border: none;
        border-radius: 10px;
        color: #FFFFFF;
        padding: 6px 10px; /* Ajusta el tamaño vertical y horizontal del botón */
        cursor: pointer;
    }
</style>
<div style="background-color: #FFFFFF; border-radius: 30px; padding: 30px;">
    <form id="posiciones-form" action="{{ route('filtrar-proyectos') }}" method="post" onsubmit="return validateForm()">
        @csrf
        <div class="input-field">
            <label for="categoria-select">Seleccionar Categoría:</label>
            <select id="categoria-select" name="categoria">
                <option value="all">Todas las Categorías</option>
                @foreach ($categorias as $categoria)
                <option value="{{$categoria->Id_categoria}}">{{$categoria->Nombre_categoria}}</option>
                @endforeach
            </select>
            <button type="submit">Filtrar</button>
        </div>
    </form>
    @csrf
    <table class="table table-custom">
        <thead style="background-color: #FF9500;">
            <tr class="table-header">
                <th>Posicion</th>
                <th>Nombre del proyecto</th>
                <th>Categoría</th>
                <th>Área</th>
                <th>Calificacion</th>

            </tr>

        </thead>
        @foreach ($proyectos as $proyecto)


        <tr>

            <td>{{$proyecto->posicion}}</td>
            <td>{{$proyecto->ficha->Nombre_proyecto}}</td>
            <td>{{$proyecto->ficha->area->categoria->Nombre_categoria}}</td>
            <td>{{$proyecto->ficha->area->Nombre_area}}</td>
            <td>{{$proyecto->Calificacion_global}}</td>



        </tr>
        @endforeach


        <tbody>
        </tbody>
    </table>
</div>
@endsection