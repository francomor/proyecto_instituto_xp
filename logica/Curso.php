<?php

include_once("../persistencia/conexionBD.php");
error_reporting(E_ALL ^ E_NOTICE);
class Curso{
	 private $nombre;
    private $anio;

    public function __construct() {
    }

    /* Obtiene los cursos
    * @author Franco Morero y Nicolas Dechecchi
    * @version 1.0
    * @return array asociativo donde cada columna esta representada por su nombre: idcurso,nombre,anio
    */
    public function obtener_cursos() {
        $con = ConexionBD::getConexion();
        $result = $con->recuperar_asociativo("select idcurso,nombre,anio from curso");
        return $result;
    }

    public function cant_registros() {
        $con = ConexionBD::getConexion();
        $result = $con->cantidad_registros("select nombre from curso");
        return $result;
    }

	public function obtener_curso($curso) {
        $con = ConexionBD::getConexion();
        $result = $con->recuperar_asociativo("select anio, nombre from curso where idcurso=".$curso);
        return $result;
    }

}
?>