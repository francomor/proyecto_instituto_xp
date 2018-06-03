<?php
include_once("../logica/Tutor.php");
include_once("../logica/Alumno.php");
include_once("../logica/Asistencia.php");
include_once("../logica/AlumnoxCurso.php");

	$dniAlumno=(int)$_POST['dniAlumnoModif'];
	$dniTutor=(int)$_POST['dniTutor'];
	$dniViejo=(int)$_POST['dniViejo'];
	$apeTutor=$_POST['apellidoTutor'];
	$nomTutor=$_POST['nombreTutor'];
	$emailTutor=$_POST['emailTutor'];
	$telTutor=$_POST['telefonoTutor'];$_POST['telefonoTutor'];
	$curso=$_POST['curso'];	
	$cursoAct=$_POST['cursoAct'];	


$t = new Tutor();

if($_POST['guardarDatos']!= NULL){ //editar comun, es decir, si no edita el dni.
	
	$dniAlumno=(int)$_POST['dniAlumnoEdit'];
	$dniTutor=(int)$_POST['dniTutorEdit'];
	$apeTutor=$_POST['apellidoTutorEdit'];
	$nomTutor=$_POST['nombreTutorEdit'];
	$emailTutor=$_POST['emailTutorEdit'];
	$telTutor=$_POST['telefonoTutorEdit'];

	$t->editarTutor($apeTutor,$nomTutor,$telTutor,$emailTutor,$dniTutor);

	header('Location:../presentacion/mostrarAlumnos.php?sel='.$curso);
}	

if($_POST['guardarComoNuevo']!= NULL){ // si se edita el dni pero para asignar un tutor nuevo a un alumno.

	$a = new Alumno();
	$i = new Asistencia();
	$axc = new AlumnoxCurso();
	$alumno = $a->obtenerAlumno($dniAlumno);
	$inasistencias=$i->obtenerInasistenciasAlumno($dniAlumno);
	$cursosAlumno=$axc->obtenerAlumnoxCursoAlumno($dniAlumno);
	$a->eliminarAlumno($dniAlumno);	

$t->crearTutoryAsociarAlumno($apeTutor,$nomTutor,$telTutor,$emailTutor,$dniTutor,$dniViejo,$alumno,$cursosAlumno,$inasistencias);
		
	header('Location:../presentacion/mostrarAlumnos.php?sel='.$cursoAct);
}

if($_POST['vincular']!= NULL){
	$a = new Alumno();
	$i = new Asistencia();
	$axc = new AlumnoxCurso();
	$alumno = $a->obtenerAlumno($dniAlumno);
	$inasistencias=$i->obtenerInasistenciasAlumno($dniAlumno);
	$cursosAlumno=$axc->obtenerAlumnoxCursoAlumno($dniAlumno);
	$a->eliminarAlumno($dniAlumno);	

$t->crearTutoryAsociarAlumno($apeTutor,$nomTutor,$telTutor,$emailTutor,$dniTutor,$dniViejo,$alumno,$cursosAlumno,$inasistencias);
		
	header('Location:../presentacion/mostrarAlumnos.php?sel='.$cursoAct);
}
	