<?php
require_once "../logica/Asistencia.php";
require_once "../logica/DiasHabiles.php";
/**
 * En este archivo, se guardan las inasistencias de todos los alumnos que se
 * envien por el formulario tabla.php
 * Se guarda:
 * Si falto a clase y a ed fisica (solo los dias en que haya edfisica y clase)
 * se computa 1 como valor total de la falta.
 * Si falto solo a clase o solo a ed fisica (solo los dias en que haya edfisica y clase)
 * se computa 0.5 como valor total de la falta.
 * Si falto a clase el dia en que hay solo clase, se computa 1 como valor total de la falta.
 * NO se computa en la base de datos los alumnos que estan presentes a las clases, solo los ausentes.
 * @author Corrionero Federico y Herrero Francisco
 * @version 1.0
 */

/**
 * En este archivo, Además se guardan las modificaciones de las inasistencias.
 * @author Martinez Natali y Herrero Francisco
 * @version 1.0
 */
/**
 * En este archivo, Además se guardan los dias habiles.
 * @author Dechecchi Nicolás, Silvera Nicolas.
 * @version 1.1
 */

$fecha = $_POST['fecha']; //se recupera la fecha del formulario
$diaHabil=new DiasHabiles();            //se guarda la fecha como dia habil
 
if(!$diaHabil->existeDia($fecha)) {       //compruaba que no se haya cargado previamente.
    $diaHabil->guardarFecha($fecha);
}

$curso = (int) $_POST["cursoActual"]; //se recupera el id del curso.
Asistencia::borrarInasistenciaxCurso($curso, $fecha); //antes de guardar se borra todas las asistencias de ese curso en la fecha dada.
$cantAlumnos = (int) $_POST["cantAlumnos"]; // se recupera la cantidad de alumnos de ese curso.
$valorParcial = $_POST["valorParcialEnvio"]; // se recupera el valor parcial de la falta de ese dia

for ($i = 0; $i < $cantAlumnos; $i++) {
    $a = new Asistencia();
    $dni = $_POST[($i + 1)]; //obtengo el dni de los alumnos.
    $falta_clase = $_POST[(String) ($i + 1) . 'claseAusente']; //obtengo si falto o no a clase.
    $falta_ed_f = $_POST[(String) ($i + 1) . 'edFAusente']; //obtengo si falto o no a Educacion fisica.
    $llegada_tarde= $_POST[(String) ($i + 1) . 'claseTarde']; //obtengo si llego tarde.


    if($falta_clase=="clase" && $falta_ed_f==null && $llegada_tarde==null){
        $a->cargarAsistencia($fecha, "clase", 1, $dni, $curso, 0);
    }
    if($falta_clase==null && $falta_ed_f=="edfisica" && $llegada_tarde==null){
        $a->cargarAsistencia($fecha, "edFisica", "0.5", $dni, $curso, 0);
    }
    if($falta_clase==null && $falta_ed_f==null && $llegada_tarde=="tarde"){
        $a->cargarAsistencia($fecha, "tarde", "0.5", $dni, $curso, 0);
    }
    if($falta_clase=="clase" && $falta_ed_f=="edfisica" && $llegada_tarde==null){
        $a->cargarAsistencia($fecha, "clase+edFisica", 1, $dni, $curso, 0);
    }
    if($falta_clase==null && $falta_ed_f=="edfisica" && $llegada_tarde=="tarde"){
        $a->cargarAsistencia($fecha, "tarde+edFisica", 1, $dni, $curso, 0);
    }





    /*if ($valorParcial != 1) { //si el dia en que se computa la asistencia hay ed fisica y clase...
        $falta_ed_f = $_POST[(String) ($i + 1) . 'edFAusente']; //obtengo si falto o no a edfisica
        if ($falta_clase != null && $falta_ed_f != null) { //si falto a clase y edfisica...
            $valorTotal = 1;
            $a->cargarAsistencia($fecha, "clase+edfisica", $valorTotal, $dni, $curso, 0);
        } else if ($falta_clase != null) { //si falto a clase
            $valorTotal = "0.5";
            $a->cargarAsistencia($fecha, "clase", $valorTotal, $dni, $curso, 0);
        } else if ($falta_ed_f != null) { //si falto a ed fisica...
            $valorTotal = "0.5";
            $a->cargarAsistencia($fecha, "edfisica", $valorTotal, $dni, $curso, 0);
        }
    } else { //si el dia que se computa la asistencia hay solo clase...
        if ($falta_clase != null) { //si falto a clase...
            $valorTotal = 1;
            $a->cargarAsistencia($fecha, "clase", $valorTotal, $dni, $curso, 0);
        }
    }*/

    echo ("<script>");
    echo ("alert ('guardado correctamente')");
    echo ("</script>");
    //una vez guardado, habria que verificar inasistencias consecutivas
    print("<script>window.location='../logica/inasistenciasConsecutivas.php?fecha=".$fecha."&curso=".$curso."';</script>");
     }
     

?>