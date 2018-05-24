<?php
include_once("../logica/Preceptor.php");



$clave=$_POST['password'];
$id=$_POST['idp'];

$p = new Preceptor();



$p->modificarContraseña($id,$clave);
	  

	echo ("<script>");
    echo ("alert ('Contraseña actualizada')");
    echo ("</script>");
    print("<script>window.location='../presentacion/mostrarPreceptores.php';</script>");

?>

 