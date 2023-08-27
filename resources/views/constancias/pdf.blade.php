<!DOCTYPE html>
<html>

<head>
    <title>Constancia</title>
    <meta charset="UTF-8"> 
</head>

<body>
    <img src="{{ public_path('img/sep.png') }}" alt="" style="position: absolute; left: 0; top: 10; height: 60px;">
    <img src="{{ public_path('img/tecNM.png') }}" alt="Imagen 2"
        style="position: absolute; right: 0; top: 10;  height: 60px;">
    <br>
    <br>

    <div style="text-align: center; margin-top: 140px;">
        <br>
        <h3>EL TECNOLÓGICO NACIONAL DE MÉXICO A TRAVES DEL {{ mb_strtoupper($instituto) }} OTORGAN EL PRESENTE</h3>
        <br>
        <h2>RECONOCIMIENTO</h2>
        <h2>A</h2>
        <h2>{{mb_strtoupper($nombre_participante)}} {{mb_strtoupper($apellido1)}} {{mb_strtoupper($apellido2)}}</h2>
        <br>
        <h3>POR SU DESTACADA PARTICIPACIÓN EN EL PROYECTO {{ mb_strtoupper($nombreProyecto) }}, EN LA CATEGORÍA {{mb_strtoupper($categoria)}} </h3>
        <br>
        @php
            function formatFecha($fecha) {
                $dateParts = explode('-', $fecha);
                $day = (int)$dateParts[2];
                $month = (int)$dateParts[1];
                $year = (int)$dateParts[0];
                $meses = array("ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE");

                return sprintf('%02d DE %s DE %04d', $day, $meses[$month - 1], $year);
            }

            $meses = array("ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE");

            $formatted_fecha_inicio = formatFecha($fecha_inicio);
            $formatted_fecha_fin = formatFecha($fecha_fin);

            $fecha_inicio_parts = explode('-', $fecha_inicio);
            $fecha_fin_parts = explode('-', $fecha_fin);

            $inicio_day = (int)$fecha_inicio_parts[2];
            $inicio_month = (int)$fecha_inicio_parts[1];
            $inicio_year = (int)$fecha_inicio_parts[0];

            $fin_day = (int)$fecha_fin_parts[2];
            $fin_month = (int)$fecha_fin_parts[1];
            $fin_year = (int)$fecha_fin_parts[0];

            if ($inicio_month === $fin_month && $inicio_year === $fin_year) {
                $formatted_fecha = "DEL $inicio_day AL $fin_day DE " . strtoupper($meses[$inicio_month - 1]) . " DE $inicio_year";
            } else {
                $formatted_fecha = "DEL $inicio_day DE " . strtoupper($meses[$inicio_month - 1]) . " AL $fin_day DE " . strtoupper($meses[$fin_month - 1]) . " DE $fin_year";
            }
        @endphp
        <h3>EN EL EVENTO INNOVATEC 2023</h3>
        <h3>CELEBRADO {{ $formatted_fecha }}</h3>
        
    </div>
    <div style="display: flex; justify-content: space-between; margin-top: 40px;">
        <div style="text-align: center; position: absolute; left: 0; top: 600; width: 50%;">
            <h3>{{ mb_strtoupper($coordinador) }}</h3>
            <h3>{{ mb_strtoupper($cargo) }}</h3>
        </div>
        <div style="text-align: center; position: absolute; right: 0; top: 600; width: 50%;">
            <h3>{{ mb_strtoupper($director) }}</h3>
            <h3>DIRECTOR DEL {{ mb_strtoupper($instituto) }}</h3>
        </div>
    </div>
</body>

</html>
