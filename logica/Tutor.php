<?php
require_once "../persistencia/conexionBD.php";
error_reporting(E_ALL ^ E_NOTICE);

/**
 * Clase Curso
 * @author 
 * @version 1.0
 */
class Tutor {

	 public function cantRegistros() {
        $con = ConexionBD::getConexion();
        $result = $con->cantidadRegistros("select dni from tutor");
        return $result;
    }

    public function obtenerTutor($dni) {
        $con = ConexionBD::getConexion();
        $result = $con->recuperarAsociativo("select * from tutor where dni='" . $dni . "'");
        return $result;
    }

     public function existeTutor($dni) {
        $con = ConexionBD::getConexion();
        $result = $con->recuperarAsociativo("select dni, nombre, apellido from tutor where dni=".$dni);
        return $result;
    }

        public function guardarTutor($dni,$apellido, $nombre, $email, $telefono){
        $con = ConexionBD::getConexion();
        $result = $con->insertar("INSERT INTO `tutor`(`dni`, `apellido`, `nombre`, `telefono`, `email`) VALUES (".$dni.",'".$apellido."','".$nombre."','".$telefono."','".$email."')");

    }

    public function editarTutor($apellido,$nombre, $telefono, $email,$dni){
      $con = ConexionBD::getConexion();
      $result = $con->update("update tutor SET `apellido`='".$apellido."',`nombre`='".$nombre."',`telefono`='".$telefono."',`email`='".$email."' WHERE dni=".$dni);
      return $result;  
    }

    public function cambiarTutorAlumno($apellido,$nombre, $telefono, $email,$dni){
      $con = ConexionBD::getConexion();
      $result = $con->update("update tutor SET `apellido`='".$apellido."',`nombre`='".$nombre."',`telefono`='".$telefono."',`email`='".$email."' WHERE dni=".$dni);
      return $result;  
    }

    /**
 * La siguiente funcion recibe un tutor, lo crea y lo asocia a un alumno. Además, si el tutor anteriormente asignado al alumno,
 * no esta relacionado a ningun otro, se elimina.
 * @author 
 * @version 1.0
 */
   public function crearTutoryAsociarAlumno($apellido,$nombre, $telefono, $email,$dniTutor,$dniViejo,$alumno,$cursosAlumno,$inasistencias){
      $con = ConexionBD::getConexion();
      
      $tutores = $con->recuperarAsociativo("SELECT `dni` FROM `alumno` WHERE `tutor_dni`=".$dniTutor);
      if(count($tutores)==0){
      $result = $con->insertar("INSERT INTO `tutor` (`dni`, `apellido`, `nombre`, `telefono`, `email`) VALUES (".$dniTutor.",'".$apellido."','".$nombre."','".$telefono."','".$email."')");
      }      
      $result = $con->insertar("INSERT INTO `alumno`(`apellido`, `nombre`, `dni`, `fechaNacimiento`, `direccion`, `email`, `lugarNacimiento`, `tutor_dni`) VALUES ('".$alumno[0]['apellido']."','".$alumno[0]['nombre']."',".$alumno[0]['dni'].",'".$alumno[0]['fechaNacimiento']."','".$alumno[0]['direccion']."','".$alumno[0]['email']."','".$alumno[0]['lugarNacimiento']."',".$dniTutor.")");
     
       for($i=0; $i<count($cursosAlumno); $i++){
      $result = $con->insertar("INSERT INTO `alumnoxcurso`(`alumno_dni`, `curso_idcurso`, `anio`) VALUES (".$alumno[0]['dni'].",".$cursosAlumno[$i]['curso_idcurso'].",".$cursosAlumno[$i]['anio'].")");
      }

        for($i=0; $i<count($inasistencias); $i++){
      $result = $con->insertar("INSERT INTO `asistencia`(`idasistencia`, `fecha`, `tipo`, `valor`, `alumnoxcurso_alumno_dni`, `alumnoxcurso_curso_idcurso`) VALUES (".$inasistencias[$i]['idasistencia'].",'".$inasistencias[$i]['fecha']."','".$inasistencias[$i]['tipo']."','".$inasistencias[$i]['valor']."',".$alumno[0]['dni'].",".$inasistencias[$i]['alumnoxcurso_curso_idcurso'].")");
      }

      $tutores = $con->recuperarAsociativo("SELECT `dni` FROM `alumno` WHERE `tutor_dni`=".$dniViejo);
      if(count($tutores)==0){
         $con->delete("DELETE FROM `tutor` WHERE `dni`=".$dniViejo);
      }

      return $result;  
    }

    public function eliminarTutor($dni){
      $con = ConexionBD::getConexion();
      $result = $con->delete("DELETE FROM `tutor` WHERE dni=".$dni);
      return $result;  
    }

     /**
 * La siguiente funcion recibe un tutor, lo crea y lo asocia a un alumno. Además, si el tutor anteriormente asignado al alumno,
 * no esta relacionado a ningun otro, se elimina.
 * @author Nicolas Silvera, Nicolas Dechecchi. 
 * @version 1.1
 */

    public function cambiarFechaMail($fechaMail,$dni){
      $con = ConexionBD::getConexion();
      $result = $con->update("update tutor SET `fechaMail`='".$fechaMail."' WHERE dni=".$dni);
      return $result;  
    }



}

