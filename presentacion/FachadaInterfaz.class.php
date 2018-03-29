<?php
require "Interfaz.class.php";

/**
 * Clase que implementa el patron Fachada,
 * con el objetivo de crear un objeto de la clase Interfaz
 * y hacer uso de sus respectivos metodos.
 * @author 
 * @version 1.0
 */
class FachadaInterfaz {

    /**
     * Constructor
     */
    public function __construct() {
        $fachadaGUI = new Interfaz();
        $fachadaGUI->cargarHeader();
        $fachadaGUI->cargarMenu();
    }
}

?>