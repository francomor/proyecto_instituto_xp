<?php
require_once "../persistencia/conexionBD.php";
error_reporting(E_ALL ^ E_NOTICE);

/**
 * Clase Curso
 * @author 
 * @version 1.0
 */
class Curso {
    private $nombre;
    private $anio;

    /**
     * Constructor
     */
    public function __construct() {
    }

    /**
     * Obtiene los cursos
     * @author Franco Morero y Nicolas Dechecchi
     * @version 1.0
     * @return array asociativo donde cada columna esta representada por su nombre: idcurso,nombre,anio
     */
    public function obtenerCursos() {
        $con = ConexionBD::getConexion();
        $result = $con->recuperarAsociativo("select idcurso,nombre,anio from curso");
        return $result;
    }
    
    public function obtenerCursosxPreceptor($preceptor) {
        $con = ConexionBD::getConexion();
        $result = $con->recuperarAsociativo("select idcurso,nombre,anio from curso where `preceptor_id`= '" . $preceptor . "'");
        return $result;
    }

    /**
     * Obtiene la cantidad de registros
     * @author
     * @version 1.0
     * @return result
     */
    public function cantRegistros() {
        $con = ConexionBD::getConexion();
        $result = $con->cantidadRegistros("select nombre from curso");
        return $result;
    }
        public function cantRegistrosxPreceptor($preceptor) {
        $con = ConexionBD::getConexion();
        $result = $con->cantidadRegistros("select nombre from curso where `preceptor_id`= '" . $preceptor . "'");
        return $result;
    }

    /**
     * Obtiene el curso especificado
     * @author
     * @version 1.0
     * @return array asociativo donde cada columna esta representada por:
     */
    public function obtenerCurso($curso) {
        $con = ConexionBD::getConexion();
        $result = $con->recuperarAsociativo("select anio, nombre from curso where idcurso=" . $curso);
        return $result;
    }

}
?>