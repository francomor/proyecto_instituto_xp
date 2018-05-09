<?php
require_once "GUIPreceptor.class.php";

if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {

    /**
     * Mostrar Tabla
     * @author 
     * @version 1.0
     */
    $gui_preceptor = new GUIPreceptor();
    $gui_preceptor->cargarTabla();
    //$gui_preceptor->cargarContenido();
    $gui_preceptor->cargarFooter();

} 
else {
  header('location: ../presentacion/login.php');
}