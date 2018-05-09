<?php
require_once "GUIPreceptor.class.php";
if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {

	$gui_preceptor = new GUIPreceptor();
	$gui_preceptor->cargarContenido();
	$gui_preceptor->cargarFooter();
} 
else {
  header('location: ../presentacion/login.php');
}
