<?php
?>

<div class="modal fade" id="modSoloDni" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span
			>
			</button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar como nuevo Tutor</h4>
		  </div>
		  <div class="modal-body">

			<form class="form-horizontal" action="../logica/modificarTutor.php" method="post" id="guardar_cliente" name="guardar_cliente">

			<div id="resultados_ajax"></div>
				<div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">DNI</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="dniTutorModif" name="dniTutorModif" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nomTutorModif" name="nomTutorModif" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="telefono" class="col-sm-3 control-label">Apellido</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="apeTutorModif" name="apeTutorModif" >
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="email" class="col-sm-3 control-label">Email</label>
				<div class="col-sm-8">
					<input type="email" class="form-control" id="emailTutorModif" name="emailTutorModif">
				  
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="direccion" class="col-sm-3 control-label">Telefono</label>
				<div class="col-sm-8">
					<input class="form-control" id="telTutorModif" name="telTutorModif">
				</div>
			  </div>
			 			 			 		
		 

		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-danger" name="guardarModSoloDni" id="guardarModSoloDni" value="true">Guardar datos</button>
		  </div>
		  	<input type="text" id="dniAlumnoModif" name="dniAlumnoModif" hidden>
		  </form>
		   </div>
		</div>
	  </div>
	</div>