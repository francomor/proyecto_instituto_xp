 
<?php
/**
 * Este archivo asigna un alumno a un curso si no existe asignado ya.
 * @author   Piñero Luciana 
 * @version 1.0
 */

include_once("../logica/Alumno.php");
include_once("../logica/AlumnoxCurso.php");

 
$dniAlu=$_POST['dniAlumno'];
$curso=$_POST['curso'];
$anio=$_POST['anio']; 
 

$c = new AlumnoxCurso(); 
$existeAlumno= $c->obtenerAlumnoxCursoAlumno($dniAlu);

 
 if(count($existeAlumno)>0){
 	echo ("<script> alert('El alumno ingresado ya fue asignado !'); </script>");
	print("<script>window.location='../presentacion/asignarAlumnos.php';</script>");

// header('Location:../presentacion/guardado.php');
}
else{
 	$c-> cargarAlumnoxCurso($dniAlu,$curso,$anio); 
	header('Location:../presentacion/guardadoAlumnoAlCurso.php');
}

?>