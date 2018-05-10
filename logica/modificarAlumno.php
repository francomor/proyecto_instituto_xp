<?php
include_once("../logica/Alumno.php");
include_once("../logica/Asistencia.php");
include_once("../logica/AlumnoxCurso.php");



$dniAlumno=(int)$_POST['dniAlumno'];
$dniViejo=$_POST['dniViejo'];
$apeAlumno=$_POST['apeAlumno'];
$nomAlumno=$_POST['nomAlumno'];
$emailAlumno=$_POST['emailAlumno'];
$telAlumno=$_POST['telAlumno'];
$fechaAlumno=$_POST['fechaAlumno'];
$direcAlumno=$_POST['direcAlumno'];
$lugarNacAlumno=$_POST['lugarNacAlumno'];
$dniTutor=$_POST['dniTutor'];

$a = new Alumno();
$i = new Asistencia();
$axc = new AlumnoxCurso();

$inasistencias=$i->obtenerInasistenciasAlumno($dniViejo);
$cursosAlumno=$axc->obtenerAlumnoxCursoAlumno($dniViejo);


$alumno = $a->existeAlumno($dniAlumno);

if(strcmp($dniViejo, $dniAlumno) !== 0){

if(count($alumno)>0 ) { 
	header('Location:../logica/alertModificarAlumno.php?valor=error');
	 /*echo ("<script>");
    echo ("alert ('El DNI no puede ser modificado, ya que pertenece a otro alumno')");
    echo ("</script>");*/
    
}
else{

$a->eliminarAlumno($dniViejo);
$a->guardarAlumnoEditado($apeAlumno,$nomAlumno,$dniAlumno,$fechaAlumno,$direcAlumno,$emailAlumno,$lugarNacAlumno,$dniTutor,$cursosAlumno,$inasistencias);
	 header('Location:../logica/alertModificarAlumno.php?valor=guardado');
	/*echo ("<script>");
    echo ("alert ('ModificadoCorrectamente')");
    echo ("</script>");*/
}

}
else{
	$a->eliminarAlumno($dniViejo);
	$a->guardarAlumnoEditado($apeAlumno,$nomAlumno,$dniAlumno,$fechaAlumno,$direcAlumno,$emailAlumno,$lugarNacAlumno,$dniTutor,$cursosAlumno,$inasistencias);
	 header('Location:../logica/alertModificarAlumno.php?valor=guardado');
	/*echo ("<script>");
    echo ("alert ('ModificadoCorrectamente')");
    echo ("</script>");*/
}

//print("<script>window.location='../presentacion/mostrarAlumnos.php';</script>");

 