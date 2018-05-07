<?php
require_once "../persistencia/conexionBD.php";
error_reporting(E_ALL ^ E_NOTICE);

/**
 * Clase ALumnoxCurso
 * @author 
 * @version 1.0
 */
class Asistencia {
    /**
     * Constructor
     */
    public function __construct() {
    }

    /**
     * Carga la asistencia para un alumnoxcurso
     * @author Franco Morero y Nicolas Dechecchi
     * @version 1.0
     * @param tipo tiene que ser clase o edFisica (falta uno para indicar que asistio)
     * @param valor valor de la falta 0,1,1/2 (el 0 falta en la bd, para indicar que asistio)
     * @param dni_alumno dni del alumno
     * @param id_curso id del curso
    
     */
    public function cargarAsistencia($fecha, $tipo, $valor, $dni_alumno, $id_curso) {
        //date_default_timezone_set('UTC');
        //$fecha = date("Y") . "-" . date("m") . "-" . date("d");
        $con = ConexionBD::getConexion();
        $con->insertar("INSERT INTO `asistencia`(`idasistencia`, `fecha`, `tipo`, `valor`, `alumnoxcurso_alumno_dni`, `alumnoxcurso_curso_idcurso`) VALUES (default,'" . $fecha . "','" . $tipo . "','" . $valor . "','" . $dni_alumno . "','" . $id_curso . "')");
    }

    /**
     * Obtiene las inasistencias de un alumno
     * @author Gabriela Peralta y Nicolas Silvera
     * @version 1.0
     * @param dni_alumno del cual se desean obtener inasistencias
     * @return array asociativo donde cada columna esta representada por su nombre: fecha, tipo, valor
     */
    public function listarInasistencia($fecha1, $fecha2, $dni_alumno) {
        $con = ConexionBD::getConexion();
        $result = $con->recuperarAsociativo("select fecha,tipo,valor from asistencia where alumnoxcurso_alumno_dni='" . $dni_alumno . "'  and fecha between '".$fecha1."' and '".$fecha2."' ORDER BY `asistencia`.`fecha` ASC");
        return $result;
    }

    /**
     * Obtiene las asistencias de un alumno
     * @author Natali Martinez y Francisco Herrero
     * @version 1.0
     * @param idcurso y fecha del cual se desean obtener asistencias
     * @return array asociativo donde cada columna esta representada por su nombre: apellido,nombre,DNI, tipo, valor de los alumnos de un curso que faltaron o no en una determinada fecha
     */
    public function inasistenciaxCurso($idcurso,$fecha,$anio) {
        $con = ConexionBD::getConexion();
        $result = $con->recuperarAsociativo("SELECT alumno.apellido,alumno.nombre, A.alumno_dni,N.tipo,N.valor  FROM ((SELECT * FROM alumnoxcurso WHERE alumnoxcurso.curso_idcurso = ".$idcurso." and alumnoxcurso.anio='".$anio."' ) AS A 
    	LEFT JOIN (SELECT * FROM asistencia WHERE asistencia.fecha = '".$fecha."')as N ON A.alumno_dni = N.alumnoxcurso_alumno_dni), alumno WHERE alumno.dni = A.alumno_dni ORDER BY alumno.apellido , alumno.nombre ASC");
        return $result;
    }

       /**
     * Borrar las inasistencias de un curso
     * @author Natali Martinez y Francisco Herrero
     * @version 1.0
     * @param idcurso y fecha del cual se desean borrar las inasistencias
     * @return 
     */
    public static function borrarInasistenciaxCurso($idcurso,$fecha){
        $con = ConexionBD::getConexion();
        $result = $con->delete("DELETE FROM `asistencia` WHERE `alumnoxcurso_curso_idcurso`=".$idcurso." and `fecha`='".$fecha."'");
        return $result;
    }
    

        /**
     * obtiene el numero de inasistencias de un curso en determinada fecha
     * @author Herrero Francisco
     * @version 1.0
     * @param idcurso, fecha
     */
    public function ObtenerCantidadInasistencias($idcurso,$fecha){
        $con = ConexionBD::getConexion();
        $result = $con->cantidadRegistros("SELECT `idasistencia` FROM `asistencia` WHERE `alumnoxcurso_curso_idcurso`=".$idcurso." and `fecha`='".$fecha."'");
        return $result;
        
    }

    public function inasistenciasConsecutivas($fecha1, $fecha2, $fecha3, $curso){
        $con = ConexionBD::getConexion();
        $result = $con->recuperarAsociativo("SELECT `alumnoxcurso_alumno_dni` FROM `asistencia` WHERE `fecha` = '".$fecha1."' and `alumnoxcurso_curso_idcurso` = '".$curso."' and `alumnoxcurso_alumno_dni` IN (SELECT `alumnoxcurso_alumno_dni` FROM `asistencia` WHERE `fecha` = '".$fecha2."'  and `alumnoxcurso_curso_idcurso` = '".$curso."' and `alumnoxcurso_alumno_dni` IN (SELECT `alumnoxcurso_alumno_dni` FROM `asistencia` WHERE `fecha` = '".$fecha3."' and `alumnoxcurso_curso_idcurso` = '".$curso."' ))");
        return $result;
    }   
}

?>