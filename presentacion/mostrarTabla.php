<?php
require_once "GUIPreceptor.class.php";

/**
 * Mostrar Tabla
 * @author 
 * @version 1.0
 */
$gui_preceptor = new GUIPreceptor();
$gui_preceptor->cargarTabla();
//$gui_preceptor->cargarContenido();
$gui_preceptor->cargarFooter();

?>