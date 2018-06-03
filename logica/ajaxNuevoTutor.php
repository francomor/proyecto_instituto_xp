<?php
include_once("Tutor.php");
$dniTutor=$_POST['dni'];
$t=new Tutor();
$existeTutor=$t->existeTutor($dniTutor);
if (count($existeTutor)>0){ //si el tutor existe:
	$tutor = $t->obtenerTutor($dniTutor);
?>


			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nombreTutor" name="nombreTutor" required value="<?php echo $tutor[0]['nombre'] ?>" readonly>
				</div>
			  </div>
			  <div class="form-group">
				<label for="telefono" class="col-sm-3 control-label">Apellido</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="apellidoTutor" name="apellidoTutor" value="<?php echo $tutor[0]['apellido'] ?>" readonly>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="email" class="col-sm-3 control-label">Email</label>
				<div class="col-sm-8">
					<input type="email" class="form-control" id="emailTutor" name="emailTutor" value="<?php echo $tutor[0]['email'] ?>" readonly>
				  
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="direccion" class="col-sm-3 control-label">Telefono</label>
				<div class="col-sm-8">
					<input class="form-control" id="telefonoTutor" name="telefonoTutor" value="<?php echo $tutor[0]['telefono'] ?>" readonly>
				  
				</div>
			  </div>


		  	<div class="panel panel-danger" align="center">
				<div class="panel-heading"> 
	 				<strong>El tutor ingresado ya existe!</strong> 
				</div>
			</div>

			
		  
		  <div class="modal-footer">

			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-danger"  name="vincular" id="vincular" value="true">Vincular</button>
		  </div>
		  	<input type="text" id="dniAlumnoModif" name="dniAlumnoModif" hidden value="<?php echo $_POST['dniAluModif'] ?>">
		  	<input type="text" id="dniViejo" name="dniViejo" hidden value="<?php echo $_POST['dniTutorViejo'] ?>">
		 


<?php
}else{
?>
			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nombreTutor" name="nombreTutor" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="telefono" class="col-sm-3 control-label">Apellido</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="apellidoTutor" name="apellidoTutor" >
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="email" class="col-sm-3 control-label">Email</label>
				<div class="col-sm-8">
					<input type="email" class="form-control" id="emailTutor" name="emailTutor" >
				  
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="direccion" class="col-sm-3 control-label">Telefono</label>
				<div class="col-sm-8">
					<input class="form-control" id="telefonoTutor" name="telefonoTutor">
				  
				</div>
			  </div>
			  
			   
			 
			
		  
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-danger"  name="guardarComoNuevo" id="guardarComoNuevo" value="true">Guardar datos</button>
		  </div>
		  	<input type="text" id="dniAlumnoModif" name="dniAlumnoModif" hidden value="<?php echo $_POST['dniAluModif'] ?>">
		  	<input type="text" id="dniViejo" name="dniViejo" hidden value="<?php echo $_POST['dniTutorViejo'] ?>">
<?php
}

