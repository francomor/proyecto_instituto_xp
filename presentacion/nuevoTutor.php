<div class="modal fade" id="nuevoTutor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span
			></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo Tutor</h4>
		  </div>
		  <div class="modal-body">

			<form class="form-horizontal" action="../logica/cargarTutor.php" method="post" id="guardar_cliente" name="guardar_cliente">

			<div id="resultados_ajax"></div>
						  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">DNI</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="dni" name="dni" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nombre" name="nombre" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="telefono" class="col-sm-3 control-label">Apellido</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="apellido" name="apellido" >
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="email" class="col-sm-3 control-label">Email</label>
				<div class="col-sm-8">
					<input type="email" class="form-control" id="email" name="email" >
				  
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="direccion" class="col-sm-3 control-label">Telefono</label>
				<div class="col-sm-8">
					<input class="form-control" id="telefono" name="telefono"></input>
				  
				</div>
			  </div>
			  
			   
			 
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-danger" id="guardar_datos">Guardar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	