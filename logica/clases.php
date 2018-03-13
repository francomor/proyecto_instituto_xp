<?php

include_once("../persistencia/conexionBD.php");
error_reporting(E_ALL ^ E_NOTICE);

class Alumno {

}

class AlumnoxCurso{

    /* Obtiene los alumnos x curso
    * @author Franco Morero y Nicolas Dechecchi
    * @version 1.0
    * @param id_curso id del curso a recuperar los alumnos
    * @param anio año del curso que se quiere obtener (2018,2019,..)
    * @return array asociativo donde cada columna esta representada por su nombre: dni,nombre,apellido
    */
    public function obtener_alumnoxCurso($id_curso,$anio){
        $con = ConexionBD::getConexion();
        $result = $con->recuperar_asociativo("select dni,nombre,apellido from alumnoxcurso,alumno where alumnoxcurso.curso_idcurso='" . $id_curso . "' and alumnoxcurso.anio='" . $anio . "' and alumnoxcurso.alumno_dni=alumno.dni");
        return $result;
    }
}

class Tutor{

}

class Asistencia{
    /* Carga la asistencia para un alumnoxcurso
    * @author Franco Morero y Nicolas Dechecchi
    * @version 1.0
    * @param tipo tiene que ser clase o edFisica (falta uno para indicar que asistio)
    * @param valor valor de la falta 0,1,1/2 (el 0 falta en la bd, para indicar que asistio)
    * @param dni_alumno dni del alumno
    * @param id_curso id del curso
    * @param justificada 0 o 1 si es justificada o no
    */
    public function cargar_asistencia($tipo,$valor,$dni_alumno,$id_curso,$justificada){
        date_default_timezone_set('UTC');
        $fecha = date("Y") . "-" . date("m") . "-" . date("d");
        $con = ConexionBD::getConexion();
        $con->insertar("INSERT INTO `asistencia`(`idasistencia`, `fecha`, `tipo`, `valor`, `alumnoxcurso_alumno_dni`, `alumnoxcurso_curso_idcurso`, `justificada`) VALUES (default,'" . $fecha . "','" . $tipo . "','" . $valor . "','" . $dni_alumno . "','" . $id_curso. "','" . $justificada . "')");
    }
}

class Curso{

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

}
?>