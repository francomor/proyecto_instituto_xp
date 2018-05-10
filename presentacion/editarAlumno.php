
<?php
include_once("../logica/Alumno.php");
include_once("../logica/Tutor.php");

include("../presentacion/editarTutor.php");

/**
 * Cursos
 * @author 
 * @version 1.0
 */

$dni = (int)$_POST['dni'];
$a = new Alumno();
$t = new Tutor();
$alumno = $a -> obtenerAlumno($dni);
$tutor = $t -> obtenerTutor($alumno[0]['tutor_dni']);
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha = $alumno[0]['fechaNacimiento'];	
?> 
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4><i class="fa fa-pencil fa-fw"></i> <?php echo $alumno[0]['apellido'].', '. $alumno[0]['nombre'] ?> </h4>
		</div>
		<div class="panel-body">
			<form class="form-horizontal" role="form" id="editarAlumno" action="../logica/modificarAlumno.php" method="post">  
				 <div class="box-header">
           			 <h3 class="box-title">Datos del Alumno</h3>

           			 <div class="col-md-12">
						<div class="pull-right">
						 
						<button type="button" class="btn btn-danger"  id="botonEditarTutor">
						 <span class="fa fa-user-plus"></span> Datos del tutor
						</button>
						 
					</div>	
					</div>
         		 </div>


         		 
				<div class="form-group row">
				  <label for="dniTutor" class="col-md-1 control-label">DNI</label>
				  <div class="col-md-3">
				 
					  <input type="text" class="form-control input-sm" id="dniAlumno" name="dniAlumno" placeholder="" required value="<?php echo $alumno[0]['dni']?>">
				  
				  </div>
				  <label for="apeTutor" class="col-md-1 control-label">Apellidos</label>
							<div class="col-md-2">
								<input type="text" class="form-control input-sm" id="apeAlumno" name="apeAlumno" placeholder="apellidos" value="<?php echo $alumno[0]['apellido']?>">
							</div>
					<label for="" class="col-md-1 control-label">Nombre</label>
							<div class="col-md-3">
								<input type="text" class="form-control input-sm" name="nomAlumno" placeholder="nomAlumno" value="<?php echo $alumno[0]['nombre']?>">
							</div>

					 
				</div>	 

				<div class="box-header">
					<hr/>
           			 
         		 </div>


				 <div class="form-group row">
				  <label for="nombre_tutor" class="col-md-1 control-label">Fecha de nacimiento</label>
				  <div class="col-md-3">
					  <input type="date" class="form-control input-sm" id="fechaAlumno" name="fechaAlumno" placeholder="" required value="<?php echo date('Y-m-d', strtotime($fecha)) ?>">
					  <input id="#" type='hidden'>	
				  </div>
				  <label for="tel1" class="col-md-1 control-label">Direccion</label>
							<div class="col-md-2">
								<input type="text" class="form-control input-sm" id="direcAlumno" name="direcAlumno" placeholder=""  value="<?php echo $alumno[0]['direccion']?>">
							</div>
					<label for="mail" class="col-md-1 control-label">Email</label>
							<div class="col-md-3">
								<input type="email" class="form-control input-sm" id="emailAlumno" name="emailAlumno" placeholder="" value="<?php echo $alumno[0]['email']?>" >
							</div>
							</div>
					 <div class="form-group row">

								<label  class="col-md-1 control-label">Lugar de nacimiento</label>
							<div class="col-md-3">
								<input type="text" class="form-control input-sm" id="lugarNacAlumno" name="lugarNacAlumno" placeholder=""  value="<?php echo $alumno[0]['lugarNacimiento']?>">
							</div>
					</div>

					<hr/>
					<!--<div class="form-row">-->
            		  	<div class="col-lg-offset-0 col-lg-10">
    
                		<button type="submit" class="btn btn-danger" name="boton_guardar" value="Guardar">Guardar</button>
             		</div>
             		<input hidden type="text" id="dniTutor" name="dniTutor" value="<?php echo $alumno[0]['tutor_dni'] ?>">
             		<input hidden type="text" id="dniViejo" name="dniViejo" value="<?php echo $alumno[0]['dni'] ?>">



			</form>	
			
		<div id="resultados" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->			
		</div>
	</div>		
		  <div class="row-fluid">
			<div class="col-md-12">
			
	

			
			</div>	
		 </div>
</div>
	<!--agregar estas librerias despues, es para los alert -->


<script src="../recursos/jquery-ajax.min.js">
//script para traer la libreria de Jquery
</script>

<!--agregar estas librerias despues -->

<script>
	$( document ).ready(function() {


  // Asociar un evento al botón que muestra la ventana modal
   $("[id='botonEditarTutor']").click(function() {

   	var dniAlumno = <?php echo $alumno[0]['dni']; ?>	
   	var dniTutor = <?php echo $alumno[0]['tutor_dni']; ?>	
   	var nomTutor = '<?php echo $tutor[0]["nombre"]; ?>'
   	var apeTutor = '<?php echo $tutor[0]["apellido"]; ?>'
   	var emailTutor = '<?php echo $tutor[0]["email"]; ?>'
   	var telTutor = '<?php echo $tutor[0]["telefono"]; ?>'
   	
    jQuery.noConflict(); 

    $('#dniAlumnoEdit').val(dniAlumno);
    $('#dniTutorEdit').val(dniTutor);
    $('#dniViejo').val(dniTutor);
    $('#apellidoTutorEdit').val(apeTutor);
    $('#nombreTutorEdit').val(nomTutor);
    $('#emailTutorEdit').val(emailTutor);
    $('#telefonoTutorEdit').val(telTutor);
    $('#tutor').html('<i class="fa fa-pencil fa-fw"></i></i>'.concat(apeTutor.concat(', ').concat(nomTutor)));
   	$('#editarTutor').modal();
  }); 
});

</script>