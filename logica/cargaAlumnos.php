<?php
/**
 * Este archivo guarda los datos del formulario del archivo "altaAlumnos.php" relacionados a la carga de alumnos.
 * @author Herrero Francisco Piñero Luciana
 * @version 1.0
 */

include_once("../logica/Alumno.php");
include_once("../logica/Tutor.php");

$apeAlu=$_POST['apeAlu'];
$nomAlu=$_POST['nomAlu'];
$dniAlu=$_POST['dniAlu'];
$fechaAlu=$_POST['fechaAlu'];
$emailAlu=$_POST['emailAlu'];
$lugarNacAlu=$_POST['lugarNacAlu'];
$direcAlu=$_POST['direcAlu'];

$dniTutor=$_POST['dniTutor'];
$apeTutor=$_POST['apeTutor'];
$nomTutor=$_POST['nomTutor'];
$telTutor=$_POST['telTutor'];
$emailTutor=$_POST['emailTutor'];

//var_dump($nomAlu);

 $a = new Alumno();
 $existeAlumno=$a->existeAlumno($dniAlu);
 if(count($existeAlumno)==0){
	$a->guardarAlumno($apeAlu, $nomAlu, $dniAlu, $fechaAlu, $direcAlu, $emailAlu, $lugarNacAlu, $dniTutor);
	header('Location:../presentacion/guardado.php');
//print("<script>window.location='../presentacion/altaAlumnos.php';</script>");
}
else{
 	echo ("<script> alert('El alumno ingresado ya existe'); </script>");
 	print("<script>window.location='../presentacion/altaAlumnos.php';</script>");
// header('Location:../presentacion/guardado.php');
 
}
