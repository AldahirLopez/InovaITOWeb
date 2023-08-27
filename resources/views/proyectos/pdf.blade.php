<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .header {
            text-align: center; /* Cambio a "center" para centrar el texto */
            margin-bottom: 20px;
        }
        .header img {
            height: 60px;
            margin: 0 auto; /* Centrar horizontalmente las imágenes */
            display: block; /* Agregar esta línea para alinear correctamente las imágenes */
        }
        .content {
            text-align: center;
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('img/sep.png') }}" alt="">
        <img src="{{ public_path('img/tecNM.png') }}" alt="">
        <img src="{{ public_path('img/logo_innovaITO.png') }}" alt="">
        
    </div>

    <div class="content">
        <h2>Detalles del Proyecto</h2>
    </div>

    <table class="table">
        <tr>
            <th>Folio del proyecto</th>
            <td>{{$proyecto->Folio}}</td>
        </tr>
        <tr>
            <th>Nombre del proyecto</th>
            <td>{{$proyecto->ficha->Nombre_corto}}</td>
        </tr>
        <tr>
            <th>Objetivo</th>
            <td>{{$proyecto->ficha->Objetivo}}</td>
        </tr>
        <tr>
            <th>Descripción general</th>
            <td>{{$proyecto->ficha->Descripcion_general}}</td>
        </tr>
        <tr>
            <th>Prospecto resultados</th>
            <td>{{$proyecto->ficha->Prospecto_resultados}}</td>
        </tr>
        <tr>
            <th>Área</th>
            <td>{{$proyecto->ficha->area->Nombre_area}}</td>
        </tr>
        <tr>
            <th>Categoría</th>
            <td>{{$proyecto->ficha->area->categoria->Nombre_categoria}}</td>
        </tr>

        </table>

        
        @if ($proyecto->memoria!=null)
        <div class="content">
        <h2>Memoria técnica</h2>
        </div>
        <table class="table">
        <tr>
            <th>Descripción problemática</th>
            <td>{{$proyecto->memoria->Descripcion_problematica}}</td>
        </tr>
        <tr>
            <th>Estado del arte</th>
            <td>{{$proyecto->memoria->Estado_arte}}</td>
        </tr>
        <tr>
            <th>Descripción de la innovación</th>
            <td>{{$proyecto->memoria->Descripcion_innovacion}}</td>
        </tr>
        <tr>
            <th>Propuesta de valor</th>
            <td>{{$proyecto->memoria->Propuesta_valor}}</td>
        </tr>
        <tr>
            <th>Mercado potencial</th>
            <td>{{$proyecto->memoria->Mercado_potencial}}</td>
        </tr>
        <tr>
            <th>Viabilidad técnica</th>
            <td>{{$proyecto->memoria->Viabilidad_tecnica}}</td>
        </tr>
        <tr>
            <th>Viabilidad financiera</th>
            <td>{{$proyecto->memoria->Viabilidad_financiera}}</td>
        </tr>
        <tr>
            <th>Estrategia propiedad intelectual</th>
            <td>{{$proyecto->memoria->Estrategia_propiedadIntelectual}}</td>
        </tr>
        <tr>
            <th>Interpretación de resultados</th>
            <td>{{$proyecto->memoria->Interpretacion_resultados}}</td>
        </tr>
        <tr>
            <th>Fuentes consultadas</th>
            <td>{{$proyecto->memoria->Fuentes_consultadas}}</td>
        </tr>
    @endif

</table>
</body>
</html>