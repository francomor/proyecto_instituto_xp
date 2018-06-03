<?php
/**
 * Este archivo se ejecuta Luego del click del boton "nuevo tutor" en "altaAlumnos.php".
 * Su funcion es, a partir del click del boton, abrir un modal para la carga del formulario para un nuevo tutor.
 * al presionar el boton guardar nos movemos a "cargarTutor.php"
  * archivos relacionados: cargarTutor.php
 * @author Herrero Francisco Piñero Luciana
 * @version 1.0
 */
	?>
	<!-- Modal -->
	<div class="modal fade" id="modComoNuevoTutor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  data-backdrop="static" data-keyboard="false">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span
			></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar como nuevo Tutor</h4>
		  </div>
		  <div class="modal-body">
<!--<div id="resultados_ajax">-->
			<form class="form-horizontal" action="../logica/modificarTutor.php" method="post" id="guardar_cliente" name="guardar_cliente">

		
						  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">DNI</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="dniTutor" name="dniTutor" required autocomplete="off">
				</div>
			  </div>
			  <div id="resultados_ajax">
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
		  	<input type="text" id="dniAlumnoModif" name="dniAlumnoModif" hidden>
		  	<input type="text" id="dniViejo" name="dniViejo" hidden>
		  </div>
		  <input type="text" id="cursoAct" name="cursoAct" hidden>
		  	 <!--div ajax-->
		  </form>
	<!--</div>-->
		  </div>
		</div>
	  </div>
	</div>
	<?php
	//	}
	?>


<script>
$( document ).ready(function() {
	$( "#dniTutor" ).keyup(function() {
  var parametros = {
                    "dni" : $("#dniTutor").val(),
                    "dniTutorViejo" : $("#dniViejo").val(),
                    "dniAluModif" : $("#dniAlumnoModif").val(),
                  };
                  $.ajax({
                   data: parametros,
                   type: "post",
                   url: "../logica/ajaxNuevoTutor.php",
                   datatype: "html",

                   success: function(respuesta)
                   {   
                     $("[id='resultados_ajax']").html(respuesta);
                   }
                 });
                });
});


</script>

	