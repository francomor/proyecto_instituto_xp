<?php

require "../logica/AlumnoxCurso.php";
require_once "../logica/Curso.php" ;
require_once "../logica/Alumno.php" ;               
 


 
$dniAlumno=$_POST['dni'];

 

$alumno=new Alumno();
$existeAlumno=$alumno->existeAlumno($dniAlumno);

$alu = $alumno-> obtenerAlumno($dniAlumno);

if (count($existeAlumno)>0){ //si el tutor existe:
	 
	$nombre= $alu[0]['apellido'].','.$alu[0]['nombre'];

?>


<div class="form-group row">
          
          <label for="anio" class="col-md-1 control-label">Alumno</label>
            <div class="col-md-2">
              <input type="text" value=" <?php echo $nombre ?> " class="form-control input-sm" id="" name="" readonly>
            </div>
          
            
			  
                <input type="submit" class="btn btn-danger" value="Asignar Alumno" id="guardar"> <!-- Envio de formulario !-->
              		 

 </div>

<?php

}
else {

}
?>

 

 

 


 

