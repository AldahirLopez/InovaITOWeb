<!DOCTYPE html>
<html>

<head>
    <title>Constancia</title>
</head>

<body>
    <img src="{{ public_path('img/sep.png') }}" alt="" style="position: absolute; left: 0; top: 0; height: 60px;">
    <img src="{{ public_path('img/tecNM.png') }}" alt="Imagen 2"
        style="position: absolute; right: 0; top: 0;  height: 60px;">
    <br>
    <br>

    <div style="text-align: center; margin-top: 140px;">
        <h3>EL INSTITUTO TECNOLÓGICO NACIONAL DE MÉXICO </h3>
        <h3>A TRAVES DEL {{ strtoupper($instituto) }}</h3>
        <h3>OTORGAN EL PRESENTE</h3>
        <BR>
        <h2>RECONOCIMIENTO</h2>
        <h2>A {{strtoupper($nombre_participante)}}</h2>
        <h3>POR SU DESTACADA PARTICIPACIÓN COMO</h3>
        <h3>{{strtoupper($rol_participante)}} DEL PROYECTO {{ strtoupper($nombreProyecto) }}, </h3>
        <h3>EN LA CATEGORÍA {{strtoupper($categoria)}} </h3>
        <h3>EN EL EVENTO INNOVATEC 2023</h3>
        <h3>CELEBRADO DEL  -"AQUI PONER RANGO DE FECHA EVENTO"-</h3>
        <div style="display: flex;">
            <div>
                <h3 style="flex: 1; text-align: left;">Encargado: {{ strtoupper($coordinador) }}</h3> <h3 style="flex: 1; text-align: right;">Director: {{ $director }}</h3>     
        </div>
    </div>
</body>

</html>
