@extends('livewire-layout')

@section('content')

<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Requerimientos Especiales</h3>
    </div>
</section>

<style>
    .info {
        display: flex;
        align-items: center;
        color: #2E2D2F;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .info-icon {
        font-size: 24px;
        margin-right: 10px;
        border-radius: 50%;
        background-color: orange;
        color: white;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .gray-box {
        border-radius: 15px;
        background-color: #2E2D2F;
        padding: 20px;
        width: 900px;
        margin: 0 auto;
    }

    .gray-box h4 {
        font-size: 15px;
        color: white;
        margin-bottom: 10px;
    }

    .gray-box .bullet-point {
        width: 10px;
        height: 10px;
        margin-top: 6px;
        margin-left: 20px;
        border-radius: 50%;
        background-color: white;
    }

    .gray-box .bullet-p {
        background-color: orange;
        width: 10px;
        height: 10px;
        margin-top: 6px;
    }

    .gray-box .description {
        font-size: 15px;
        color: white;
        margin-left: 20px;
    }

    .info-text {
        font-size: 14px;
        margin-left: 5px;
        color: #2E2D2F;
        display: flex;
        align-items: center;
        margin-top: -5px;
    }

    .table-container {
        max-width: 600px;
        margin-top: 20px;
        margin-left: auto;
        margin-right: auto;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 10px;
    }

    .table tr {
        background-color: orange;
        color: white;
        padding: 10px;
        border-bottom: 1px solid #2E2D2F;
    }

    .table td {
        padding: 10px;
        background-color: white;
        color: black;
        border-bottom: 1px solid #2E2D2F;
    }

    .table tbody tr:last-child td {
        border-bottom: none;
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

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="info">
                        <span class="info-icon">i</span>
                        <span>AVISO <br> Si el proyecto no necesita requerimientos especiales, haga clic directamente en
                            la opción: Finalizar requerimientos especiales</span>
                    </div>

                    <div class="gray-box">
                        <h4>Requerimientos</h4>

                        <div class="form-row">
                            <div class="bullet-p"></div>
                            <div class="description">Para la exposición en los stands, la sede proporcionará únicamente
                                los siguientes elementos:</div>
                        </div>

                        <div class="form-row">
                            <div class="bullet-point"></div>
                            <div class="description">Área de 2 x 1 metros (stand)</div>
                        </div>

                        <div class="form-row">
                            <div class="bullet-point"></div>
                            <div class="description">Una mesa</div>
                        </div>

                        <div class="form-row">
                            <div class="bullet-point"></div>
                            <div class="description">Dos sillas</div>
                        </div>

                        <div class="form-row">
                            <div class="bullet-point"></div>
                            <div class="description">Instalación eléctrica (2 contactos)</div>
                        </div>

                        <div class="form-row">
                            <div class="bullet-point"></div>
                            <div class="description">Nombre del instituto tecnológico en la parte superior del stand
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="bullet-point"></div>
                            <div class="description">Cartel del proyecto que incluye: nombre del instituto tecnológico,
                                categoría, nombre corto y nombre descriptivo<br> del proyecto.</div>
                        </div>
                    </div>
                    <br>
                    <div class="gray-box">
                        <h4>Requerimientos Especiales</h4>
                        <div class="form-row">
                            <div class="bullet-p"></div>
                            <div class="description">Los únicos requerimientos especiales que podrán proporcionar la
                                sede, cuando algún proyecto lo requiera, son los siguientes:</div>
                        </div>

                        <form method="post">
                            @csrf
                            <div class="table-container">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="color: white;">Requerimiento especial</th>
                                            <th style="color: white;">Descripcion</th>
                                            <th style="color: white;">Seleccionar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($requerimientos as $requerimiento)
                                        <tr>
                                            <td>{{ $requerimiento->Tipo }}</td>
                                            <td>{{ $requerimiento->Descripcion }}</td>
                                            <td><input type="checkbox" name="requerimiento{{ $requerimiento->Id_requerimientoEspecial }}"></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-row">
                                <div class="bullet-p"></div>
                                <div class="description">Nota: Esto aplica para proyectos cuyo prototipo presente exceso de dimensiones como maquinarias o vehículos, o para <br>cuyos proyectos que utilicen algún tipo de material peligroso o inflamable (gas, combustible).</div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="bullet-p"></div>
                                <div class="description">En el caso de los proyectos que para la operación del prototipo requieran de energía solar, únicamente se realizará de forma <br>externa la demostración para la evaluación, el resto del tiempo los prototipos deberán permanecer en el stand asignado.</div>
                            </div>

                    </div>

                </div>

            </div>
            <button type="submit" class="submit-button">Finalizar requerimientos especiales</button>
            </form>
        </div>
    </div>
</div>
@endsection