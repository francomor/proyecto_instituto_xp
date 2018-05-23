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

    //La función recuperarDias tiene la particularidad de devolver de mas reciente a mas lejano.
    public function recuperarDias() {
        $con = ConexionBD::getConexion();                                                      
        $result = $con->recuperarAsociativo("select * from diashabiles order by `fecha` desc");
        return $result;
    }

    //La función recuperarOrdenado, resuelve lo mismo que la llamada anterior, solo que recupera en el orden inverso.
     public function recuperarOrdenado() {
        $con = ConexionBD::getConexion();
        $result = $con->recuperarAsociativo("select * from diashabiles order by `fecha` asc");
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

    public function eliminarDia($fecha){
        $con = ConexionBD::getConexion();
        $result = $con->delete("delete from `diashabiles` where `fecha`='". $fecha."'" );
        return $result;
    }
}

