<?php
function dateToSpanish($fecha) {
    $meses = [
        1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril',
        5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto',
        9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre'
    ];

    $fechaObj = new DateTime($fecha);
    $dia = $fechaObj->format('j'); // sin ceros a la izquierda
    $mes = (int)$fechaObj->format('n'); // número de mes
    $anio = $fechaObj->format('Y');

    return "$dia de {$meses[$mes]} del $anio";
}

