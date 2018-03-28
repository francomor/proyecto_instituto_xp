<?php

include_once("../persistencia/conexionBD.php");
error_reporting(E_ALL ^ E_NOTICE);
class Asistencia{
	public function __construct() {
    }
    /* Carga la asistencia para un alumnoxcurso
    * @author Franco Morero y Nicolas Dechecchi
    * @version 1.0
    * @param tipo tiene que ser clase o edFisica (falta uno para indicar que asistio)
    * @param valor valor de la falta 0,1,1/2 (el 0 falta en la bd, para indicar que asistio)
    * @param dni_alumno dni del alumno
    * @param id_curso id del curso
    * @param justificada 0 o 1 si es justificada o no
    */
    public function cargar_asistencia($fecha,$tipo,$valor,$dni_alumno,$id_curso,$justificada){
        //date_default_timezone_set('UTC');
        //$fecha = date("Y") . "-" . date("m") . "-" . date("d");
        $con = ConexionBD::getConexion();
        $con->insertar("INSERT INTO `asistencia`(`idasistencia`, `fecha`, `tipo`, `valor`, `alumnoxcurso_alumno_dni`, `alumnoxcurso_curso_idcurso`, `justificada`) VALUES (default,'" . $fecha . "','" . $tipo . "','" . $valor . "','" . $dni_alumno . "','" . $id_curso. "','" . $justificada . "')");
    }

    /* Obtiene las inasistencias de un alumno
    * @author Gabriela Peralta y Nicolas Silvera
    * @version 1.0
    * @param dni_alumno del cual se desean obtener inasistencias
    * @return array asociativo donde cada columna esta representada por su nombre: fecha, tipo, valor
    */
    public function listar_inasistencia($dni_alumno){
        $con = ConexionBD::getConexion();
        $result = $con->recuperar_asociativo("select fecha,tipo,valor from asistencia where alumnoxcurso_alumno_dni='".$dni_alumno."' and justificada='0'");
        return $result;
    }
    
    /* Justifica las faltas injustificadas de un aulmno
    * @author Mauricio Vazquez
    * @version 1.0
    * @param dni_alumno del cual se desean justificar inasistencias
    */
    public function justificarFaltas($dni_alumno){
        $con = ConexionBD::getConexion();

        $con->update("UPDATE `asistencia` SET `justificada`='1' WHERE `alumnoxcurso_alumno_dni`='".$dni_alumno."' AND `justificada`='0'");

    }
}
?>