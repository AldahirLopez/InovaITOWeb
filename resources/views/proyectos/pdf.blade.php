<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <h2>Nombre del proyecto:{{$proyecto->ficha->Nombre_corto}}</h2>
   <h2>Objetivo:{{$proyecto->ficha->Objetivo}}</h2>
   <p>Descripcion general:{{$proyecto->ficha->Descripcion_general}}</p>
   <p>Prospecto resultados:{{$proyecto->ficha->Prospecto_resultados}}</p>
   <p>Area:{{$proyecto->ficha->area->Nombre_area}}</p>
   <p>Categoria:{{$proyecto->ficha->area->categoria->Nombre_categoria}}</p>
    
</body>
</html>