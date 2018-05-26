<?php
/**
 * En este archivo,  
 * @version 1.0
  * @author Martinez Natali 
 * 
 */


include_once("../logica/AlumnoxCurso.php");

 
$alumxCurso = new AlumnoxCurso(); 
$curso = (int) $_POST['cursoActual']+2; //se recupera el id del curso.
$anio=(int)$_POST['anio']+1; 
$cantidadFilas=$_POST['cantAlumnos'];

 for ($i = 0; $i < $cantidadFilas; $i++) {
   
   $dni = $_POST[($i + 1)]; //obtengo el dni de los alumnos.
   if ($_POST[($i + 1) . "pasa"]== "pasa"){
   AlumnoxCurso::cargarAlumnoxCurso($dni,$curso,$anio);}
 }
    echo "<script>window.location='../presentacion/home.php';</script>";

?>