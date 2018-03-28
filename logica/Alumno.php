<?php

include_once("../persistencia/conexionBD.php");
error_reporting(E_ALL ^ E_NOTICE);
class Alumno {
	 public function __construct() {
	 }
    /* Obtiene el nombre con un dni
    * @author Gabriela Peralta y Nicolas Silvera
    * @version 1.0
    * @param dni_alumno del cual se desean obtener el nombre
    * @return array asociativo donde cada columna esta representada por su nombre: nombre, apellido
    */
    public function obtener_nombre($dni_alumno){
        $con = ConexionBD::getConexion();
        $result = $con->recuperar_asociativo("select nombre,apellido from alumno where dni='".$dni_alumno."'");
        return $result;
    }

}
?>