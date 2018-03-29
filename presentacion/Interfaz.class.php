<?php

/**
 * Clase que se encarga de crear una que sea comun para las distintas secciones
 * del sitio correspondientes a un preceptor, con el objetivo de mantener uniforme
 * el diseño del sitio web.
 * @author 
 * @version 1.0
 */
class Interfaz {

    /**
     * Constructor
     */
    public function __construct() {
    }

    /**
     * Cargar Header
     */
    public static function cargarHeader() {
        include "header.php";
    }

    /**
     * Cargar Menu
     */
    public static function cargarMenu() {
        include "menuPreceptor.php";
    }
}

?>