<?php
require_once "../persistencia/conexionBD.php";
error_reporting(E_ALL ^ E_NOTICE);

/**
 * Clase Curso
 * @author 
 * @version 1.0
 */
class Tutor {

	 public function cantRegistros() {
        $con = ConexionBD::getConexion();
        $result = $con->cantidadRegistros("select dni from tutor");
        return $result;
    }

}

?>