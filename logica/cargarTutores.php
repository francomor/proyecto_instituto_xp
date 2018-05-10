<?php
/**
 * Este archivo se devuelve al arhivo "altaAlumnos.php" como respuesta a una peticion de Ajax.
 * Su funcion es, a partir de un evento (onkeyup) de agregar un dni, verificar si existe. en caso afirmativo habilitar un panel
 * para agregar un alumno. en caso negativo mostrar un cartel. 
 * @author Herrero Francisco Piñero Luciana
 * @version 1.0
 */
include_once("Tutor.php");
$dniTutor=$_POST['dni'];
$t=new Tutor();
$existeTutor=$t->existeTutor($dniTutor);
if (count($existeTutor)>0){ //si el tutor existe:
?>
<!-- Habilitar panel de carga de alumno -->
 <label  class="col-md-1 control-label">Apellidos</label>
	<div class="col-md-2">
		<input type="text" value="<?php echo $existeTutor[0]['apellido']?>" class="form-control input-sm" id="apeTutor" readonly>
	</div>
	<label  class="col-md-1 control-label">Nombre</label>
			<div class="col-md-3">
				<input type="text" value="<?php echo $existeTutor[0]['nombre']?>" class="form-control input-sm" id="nomTutor" readonly>
			</div>
				<br>
				<div class="box-header">
					<hr/>
           			 <h3 class="box-title">Datos del alumno</h3>
         		 </div>

				<div class="form-group row">
				  <label for="nombre_tutor" class="col-md-1 control-label">DNI</label>
				  <div class="col-md-3">
					  <input type="text" class="form-control input-sm" name="dniAlu" placeholder="" required>

					  
				  </div>
				  <label for="tel1" class="col-md-1 control-label">Apellidos</label>
							<div class="col-md-2">
								<input type="text" class="form-control input-sm" name="apeAlu" placeholder=""  >
							</div>
					<label for="mail" class="col-md-1 control-label">Nombre</label>
							<div class="col-md-3">
								<input type="text" class="form-control input-sm" name="nomAlu" placeholder=""  >
							</div>
				 </div>

				 <div class="form-group row">
				  <label for="nombre_tutor" class="col-md-1 control-label">Fecha de nacimiento</label>
				  <div class="col-md-3">
					  <input type="date" class="form-control input-sm" name="fechaAlu" placeholder="Buscar Tutor" required>
					  <input id="#" type='hidden'>	
				  </div>
				  <label for="tel1" class="col-md-1 control-label">Direccion</label>
							<div class="col-md-2">
								<input type="text" class="form-control input-sm" name="direcAlu" placeholder=""  >
							</div>
					<label for="mail" class="col-md-1 control-label">Email</label>
							<div class="col-md-3">
								<input type="email" class="form-control input-sm" name="emailAlu" placeholder=""  >
							</div>
							</div>
					 <div class="form-group row">

								<label  class="col-md-1 control-label">Lugar de nacimiento</label>
							<div class="col-md-3">
								<input type="text" class="form-control input-sm" name="lugarNacAlu" placeholder=""  >
							</div>
					</div>
					 
			

				  	<div class="form-row">
            		  	<div class="col-lg-offset-0 col-lg-10">
    
                		<button type="submit" class="btn btn-danger" >Guardar</button>
             		</div>


	 
<?php
} else { // si no existe el tutor
?>		
<!-- Mensaje  -->
<div class="col-md-2">

	<div class="alert alert-danger" role="alert">
 	 No existe Tutor!
	</div>
</div>
<?php
} 
?>	