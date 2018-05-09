<?php
require "FachadaInterfaz.class.php";

/**
 * Clase encargada de crear la interfaz principal correspondiente al preceptor,
 * con sus respectivas funcionalidades, haciendo llamadas a los metodos correspondientes
 * @author 
 * @version 1.0
 */
class GUIPreceptor {
    
    /**
     * Constructor
     */
    public function __construct() {
        $fachada = new FachadaInterfaz();
    }

    /**
     * Mostrar Cursos
     */
    public function mostrarCursos() {
        include "../presentacion/contenido.php";
    }

    /**
     * Cargar Contenido
     */
    public static function cargarContenido() {
        include "../presentacion/contenido.php";
    }

    /**
     * Registrar Asistencias
     */
    public static function registrarAsistencia() {
        include "../presentacion/cursos.php";
    }

    /**
     * Cargar Footer
     */
    public static function cargarFooter() {
        include "footer.php";
    }
}

