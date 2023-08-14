<!DOCTYPE html>
<html>
<head>
    <title>Constancia</title>
</head>
<body>
    <img src="{{ public_path('img/sep.png') }}" alt="Imagen 1" style="position: absolute; left: 0; top: 0; width: 100px; height: 100px;">
    <img src="{{ public_path('img/tecNM.png') }}" alt="Imagen 2" style="position: absolute; right: 0; top: 0; width: 100px; height: 100px;">

    <div style="text-align: center; margin-top: 120px;">
        <h2>Generación de Constancias</h2>
        <p>{{ $content }}</p>
    </div>
</body>
</html>