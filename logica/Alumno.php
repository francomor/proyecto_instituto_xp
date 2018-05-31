<?php
require_once "../persistencia/conexionBD.php";
error_reporting(E_ALL ^ E_NOTICE);

/**
 * Clase Alumno
 * @author 
 * @version 1.0
 */
class Alumno {
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
    public function cantRegistros() {
        $con = ConexionBD::getConexion();
        $result = $con->cantidadRegistros("select dni from alumno");
        return $result;
    }

    public function obtenerAlumno($dni_alumno) {
        $con = ConexionBD::getConexion();
        $result = $con->recuperarAsociativo("select * from alumno where dni='" . $dni_alumno . "'");
        return $result;
    }


   

     public function guardarAlumno($apellido,$nombre, $dni, $fechaNacimiento,$direccion, $email, $lugarNacimiento, $dniTutor){
        $con = ConexionBD::getConexion();
        $result = $con->insertar("INSERT INTO `alumno`(`apellido`, `nombre`, `dni`, `fechaNacimiento`, `direccion`, `email`, `lugarNacimiento`, `tutor_dni`) VALUES ('".$apellido."','".$nombre."','".$dni."','".$fechaNacimiento."','".$direccion."','".$email."','".$lugarNacimiento."','".$dniTutor."')");

    }

    public function existeAlumno($dniAlu){
        $con = ConexionBD::getConexion();
        $result = $con->recuperarAsociativo("select dni from alumno where dni=".$dniAlu);
        return $result;
    }


     public function existeAlumnoNombre($apeAlu){
        $con = ConexionBD::getConexion();
        $result = $con->recuperarAsociativo("select apellido from alumno where apellido=".$apeAlu);
        return $result;
    }

    public function obtenerAlumnos(){
        $con = ConexionBD::getConexion();
        $result = $con->recuperarAsociativo("select apellido, nombre, dni from alumno order by apellido, nombre ASC");
        return $result;
    }

       public function eliminarAlumno($dni){
        $con = ConexionBD::getConexion();
        $result = $con->delete("delete from asistencia where alumnoxcurso_alumno_dni=".$dni);
        $result = $con->delete("delete from alumnoxcurso where alumno_dni=".$dni);
        $result = $con->delete("delete from alumno where dni=".$dni);
        return $result;
    }


    public function guardarAlumnoEditado($apellido,$nombre, $dni, $fechaNacimiento,$direccion, $email, $lugarNacimiento,$dniTutor,$cursosAlumno,$inasistencias ){
      $con = ConexionBD::getConexion();

      $result = $con->insertar("INSERT INTO `alumno`(`apellido`, `nombre`, `dni`, `fechaNacimiento`, `direccion`, `email`, `lugarNacimiento`, `tutor_dni`) VALUES ('".$apellido."','".$nombre."','".$dni."','".$fechaNacimiento."','".$direccion."','".$email."','".$lugarNacimiento."','".$dniTutor."')");
     
       for($i=0; $i<count($cursosAlumno); $i++){
      $result = $con->insertar("INSERT INTO `alumnoxcurso`(`alumno_dni`, `curso_idcurso`, `anio`) VALUES (".$dni.",".$cursosAlumno[$i]['curso_idcurso'].",".$cursosAlumno[$i]['anio'].")");
      }

        for($i=0; $i<count($inasistencias); $i++){
      $result = $con->insertar("INSERT INTO `asistencia`(`idasistencia`, `fecha`, `tipo`, `valor`, `alumnoxcurso_alumno_dni`, `alumnoxcurso_curso_idcurso`) VALUES (".$inasistencias[$i]['idasistencia'].",'".$inasistencias[$i]['fecha']."','".$inasistencias[$i]['tipo']."','".$inasistencias[$i]['valor']."',".$dni.",".$inasistencias[$i]['alumnoxcurso_curso_idcurso'].")");
      }
      return $result;  
    }

    public function cantidadAlumnosRelacionadosATutor($dniTutor){
      $con = ConexionBD::getConexion();
        $result = $con->recuperarAsociativo("select `dni` from alumno where tutor_dni=".$dniTutor);
        $result=count($result);
        return $result;  
    }
}

