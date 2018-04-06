<?php

/**
 * Clase que se encarga de crear una que sea comun para las distintas secciones
 * del sitio correspondientes a un preceptor, con el objetivo de mantener uniforme
 * el diseño del sitio web.
 * Se carga el menú dependiendo del tipo de usuario que inició sesión.
 * @author Navarro Karen y Piñero Luciana
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
        if(!isset($_SESSION)){
            session_start();
        }

        if($_SESSION["tipo"]=="preceptor"){
            include "menuPreceptor.php";
        }
        else if($_SESSION["tipo"]=="rector"){
            include "menuRector.php";
        }
        else if($_SESSION["tipo"]=="tutor") {
            include "menuTutor.php";
        }
        
    }
}

?>