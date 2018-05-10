<?php
/**
 * Este archivo carga los datos del formulario del arhivo "registroTutor.php" relacionados a la carga de tutor.
 * @author Herrefo Francisco y Piñero Luciana
 * @version 1.0
 */
include_once("../logica/Tutor.php");

$dniTutor=(int)$_POST['dni'];
$apeTutor=$_POST['apellido'];
$nomTutor=$_POST['nombre'];
$emailTutor=$_POST['email'];
$telTutor=$_POST['telefono'];

 $t = new Tutor();
 if(count($t->existeTutor($dniTutor))==0)
 {
 $t->guardarTutor($dniTutor, $apeTutor, $nomTutor, $emailTutor, $telTutor);
 echo ("<script> alert('El tutor fue guardado correctamente'); </script>");
}
 else{
 	echo ("<script> alert('El tutor ingresado ya existe'); </script>");
 }

 //header('Location:../presentacion/altaAlumnos.php');
 print("<script>window.location='../presentacion/altaAlumnos.php';</script>");
?>