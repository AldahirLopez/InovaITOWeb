<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <img src="{{ public_path('img/sep.png') }}" alt="" style="position: absolute; left: 0; top: 0; height: 60px;">
    <img src="{{ public_path('img/logo_innovaITO.png') }}" alt="" style="position: absolute; left:45%; top: 0; height: 60px;">
    <img src="{{ public_path('img/tecNM.png') }}" alt="Imagen 2" style="position: absolute; right: 0; top: 0;  height: 60px;">
    <br>
    <br>
    <br>
    <br>
   <h2>Folio del proyecto:{{$proyecto->Folio}}</h2>
   <h2>Nombre del proyecto:{{$proyecto->ficha->Nombre_corto}}</h2>
   <h2>Objetivo:{{$proyecto->ficha->Objetivo}}</h2>
   <p>Descripcion general:{{$proyecto->ficha->Descripcion_general}}</p>
   <p>Prospecto resultados:{{$proyecto->ficha->Prospecto_resultados}}</p>
   <p>Area:{{$proyecto->ficha->area->Nombre_area}}</p>
   <p>Categoria:{{$proyecto->ficha->area->categoria->Nombre_categoria}}</p>

    <p>Memoria tecnica</p>
    @if ($proyecto->memoria!=null)
        
        <p>Descripcion_problematica{{$proyecto->memoria->Descripcion_problematica}}</p>
        <p>Estado_arte{{$proyecto->memoria->Estado_arte}}</p>
        <p>Descripcion_innovacion{{$proyecto->memoria->Descripcion_innovacion}}</p>
        <p>Propuesta_valor{{$proyecto->memoria->Propuesta_valor}}</p>
        <p>Mercado_potencial{{$proyecto->memoria->Mercado_potencial}}</p>
        <p>Viabilidad_tecnica{{$proyecto->memoria->Viabilidad_tecnica}}</p>
        <p>Viabilidad_financiera{{$proyecto->memoria->Viabilidad_financiera}}</p>
        <p>Estrategia_propiedadIntelectual{{$proyecto->memoria->Estrategia_propiedadIntelectual}}</p>
        <p>Interpretacion_resultados{{$proyecto->memoria->Interpretacion_resultados}}</p>
        <p>Fuentes_consultadas{{$proyecto->memoria->Fuentes_consultadas}}</p>



    @endif





    
</body>
</html>