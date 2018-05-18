<?php
require_once "../persistencia/conexionBD.php";
error_reporting(E_ALL ^ E_NOTICE);

/**
 * Clase Dias Habiles
 * @author Dechecchi Nicolás y Silvera Nicolás
 * @version 1.0
 */
class DiasHabiles {
    public function __construct() {
    }

    public function recuperarDias() {
        $con = ConexionBD::getConexion();
        $result = $con->recuperarAsociativo("select * from diashabiles order by `fecha` desc");
        return $result;
    }

    public function guardarFecha($fecha){
        $con = ConexionBD::getConexion();
        $result = $con->insertar("INSERT INTO `diashabiles`(`fecha`) VALUES ('" . $fecha . "')");
    }


    public function existeDia($fecha){
      $con = ConexionBD::getConexion();
       $result = $con->existe("select * from diashabiles where `fecha`='". $fecha."'" );
       return $result;
    }
}

