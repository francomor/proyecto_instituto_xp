<?php
require_once "../persistencia/conexionBD.php";
error_reporting(E_ALL ^ E_NOTICE);

/**
 * Clase Alumno
 * @author 
 * @version 1.0
 */
class Preceptor{
    /**
     * Constructor
     */
    public function __construct() {
    }

    /**
     * Obtiene el nombre con un dni
     * @author Gabriela Peralta y Nicolas Silvera
     * @version 1.0
     * @param dni_alumno del cual se desean obtener el nombre
     * @return array asociativo donde cada columna esta representada por su nombre: nombre, apellido
     */
    public function obtenerNombre($dni_alumno) {
        $con = ConexionBD::getConexion();
        $result = $con->recuperarAsociativo("select nombre,apellido from alumno where dni='" . $dni_alumno . "'");
        return $result;
    }

    public function obtenerPreceptor() {
        $con = ConexionBD::getConexion();
        $result = $con->recuperarAsociativo("select nombre,apellido,id_usuario from preceptor");
        return $result;
    }

    public function obtenerPreceptorXid($id) {
        $con = ConexionBD::getConexion();
        $result = $con->recuperarAsociativo("select nombre,apellido,id_usuario  from preceptor where id_usuario='" . $id . "'");
        return $result;
    }


    public function cantRegistros() {
        $con = ConexionBD::getConexion();
        $result = $con->cantidadRegistros("select id_usuario from preceptor");
        return $result;
    }

     public function modificarContraseña($id,$clave) {
        $con = ConexionBD::getConexion();
        $result = $con->update("update user set clave='" . $clave . "' where usuario='" . $id . "'");
        return $result;
    }

}

?>