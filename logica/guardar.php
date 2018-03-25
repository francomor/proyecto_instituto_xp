<?php

//en este archivo, se guardan las inasistencias de todos los alumnos que se envien por el formulario tabla.php
//se guarda: si falto a clase y a ed fisica (solo los dias en que haya edfisica y clase) se computa 1 como valor total de la falta.
// si falto solo a clase o solo a ed fisica (solo los dias en que haya edfisica y clase) se computa 1/2 como valor total de la falta.
// si falto a clase el dia en que hay solo clase, se computa 1 como valor total de la falta.
//NO se computa en la base de datos los alumnos que estan presentes a las clases, solo los ausentes.
include_once("clases.php");
$fecha=$_REQUEST['fecha']; //se recupera la fecha
$curso = (int) $_REQUEST["curso_actual"]; //se recupera el id del curso.
$cant_filas = (int) $_REQUEST["cant_alumnos"]; // se recupera la cantidad de alumnos de ese curso.
$valor_parcial = $_REQUEST["valor_parcial_envio"]; // se recupera el valor parcial de la falta de ese dia.
for ($i = 0; $i < $cant_filas; $i++) {
    $dni = $_REQUEST[($i + 1)]; //obtengo el dni de los alumnos.
    $falta_clase = $_REQUEST[(String) ($i + 1) . 'clase_aus']; //obtengo si falto o no a clase.
    if ($valor_parcial != 1) { //si el dia en que se computa la asistencia hay ed fisica y clase...
        $a = new Asistencia();
        $falta_ed_f = $_REQUEST[(String) ($i + 1) . 'ed-f_aus']; //obtengo si falto o no a edfisica
        if ($falta_clase != NULL && $falta_ed_f != NULL) { //si falto a clase y edfisica...
            $valor_total = 1;
            $a->cargar_asistencia($fecha,"clase+edfisica", $valor_total, $dni, $curso, 0);
        } else if ($falta_clase != NULL) { //si falto a clase
            $valor_total = "1/2";
            $a->cargar_asistencia($fecha,"clase", $valor_total, $dni, $curso, 0);
        } else if ($falta_ed_f != NULL) { //si falto a ed fisica...
            $valor_total = "1/2";
            $a->cargar_asistencia($fecha,"edfisica", $valor_total, $dni, $curso, 0);
        }
    } else { //si el dia que se computa la asistencia hay solo clase...
        $a = new Asistencia();
        if ($falta_clase != NULL) { //si falto a clase...
            $valor_total = 1;
            $a->cargar_asistencia($fecha,"clase", $valor_total, $dni, $curso, 0);
    }
}
    echo ("<script>");
    echo ("alert ('guardado correctamente')");
    echo ("</script>");
    print("<script>window.location='../presentacion/cursos.php';</script>"); //una vez guardado, redireccionar a la pagina de seleccion de cursos.
}
?>