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

class AlumnoxCurso{

    /* Obtiene los alumnos x curso
    * @author Franco Morero y Nicolas Dechecchi
    * @version 1.0
    * @param id_curso id del curso a recuperar los alumnos
    * @param anio año del curso que se quiere obtener (2018,2019,..)
    * @return array asociativo donde cada columna esta representada por su nombre: dni,nombre,apellido
    */
    public static function obtener_alumnoxCurso($id_curso,$anio){
        $con = ConexionBD::getConexion();
<<<<<<< HEAD
        $result = $con->recuperar_asociativo("select dni,nombre,apellido from alumnoxcurso,alumno where alumnoxcurso.curso_idcurso='" . $id_curso . "' and alumnoxcurso.anio='" . $anio . "' and alumnoxcurso.alumno_dni=alumno.dni order by alumno.apellido, alumno.nombre");
=======
        $result = $con->recuperar_asociativo("select dni,nombre,apellido from alumnoxcurso,alumno where alumnoxcurso.curso_idcurso='" . $id_curso . "' and alumnoxcurso.anio='" . $anio . "' and alumnoxcurso.alumno_dni=alumno.dni");
>>>>>>> 47442b3e4bbbd5b6dc5ed8508c5d3d2db53c4aca
        return $result;
    }
}

class Tutor{

}

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