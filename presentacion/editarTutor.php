<?php
/**
* Este archivo se ejecuta por la llamada ajax del archivo "mostrarAlumno.php" mediante el boton editar.
* devuelve un formulario con los datos del alumno seleccionado, un boton de guardar y uno de mostrar datos del tutor.
 * @author Herrero Francisco Piñero Luciana
 * @version 1.0
 */
include_once("../presentacion/editarTutor.php");
include_once("../presentacion/nuevoTutor.php");
include_once("../presentacion/editarTutorModifDni.php");
include("../presentacion/modalConfirm.php");
?>

<body>
		  <div id="editar">
 <div class="modal fade" id="editarTutor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  data-backdrop="static" data-keyboard="false">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span
			></button>
			<h4 class="modal-title" id=""><div id="tutor"><i class="fa fa-pencil fa-fw"></i> Agregar nuevo Tutor </div></h4>
		  </div>
		  <div class="modal-body">

			<form class="form-horizontal" action="../logica/modificarTutor.php" method="post" id="" name="">
			<div id="nuevoTut">
			  <div class="form-group">
				<label for="dni" class="col-sm-3 control-label">DNI:</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="dniTutorEdit" name="dniTutorEdit" required readonly>
				</div>
			  </div>

			  <div class="form-group">
				<label for="apellido" class="col-sm-3 control-label">Apellido</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="apellidoTutorEdit" name="apellidoTutorEdit" required>
				</div>
			  </div>

			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nombreTutorEdit" name="nombreTutorEdit" >
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="email" class="col-sm-3 control-label">Email</label>
				<div class="col-sm-8">
					<input type="email" class="form-control" id="emailTutorEdit" name="emailTutorEdit" >
				  
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="direccion" class="col-sm-3 control-label">Telefono</label>
				<div class="col-sm-8">
					<input class="form-control" id="telefonoTutorEdit" name="telefonoTutorEdit">
			    </div>
			  </div>
			  
			   
			 
			
		  
		  <div class="modal-footer">

			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<!--<button type="button" class="btn btn-danger"  id="confirmar"  data-dismiss="modal" data-toggle="modal" data-target="#modalconfirm">
 				  Modificar DNI
			</button>-->

			<button type="button" class="btn btn-danger"  id="confirmar">
 				  Modificar DNI
			</button>
			<button type="submit" class="btn btn-danger" id="guardarDatos" name="guardarDatos" value="true">Guardar datos</button>
			

		  </div>
			<input type="text" id="dniAlumnoEdit" name="dniAlumnoEdit" hidden> 
			<input hidden type="text" name="curso" id="curso" value="<?php echo $_POST['curso']; ?>" >
		  </form>
		  </div>
		</div>
	  </div>
	
</div>
</div>

</body>



<script>
	$( document ).ready(function() {

$("[id='confirmar']").click(function() {

   var dniAlumno = $('#dniAlumnoEdit').val();
   var dniTutorViejo = $('#dniTutorEdit').val();
   var cursoActual = $('#curso').val();
   /*
   	var apeTutor = 	$('#apellidoTutorEdit').val();
   	var nomTutor = 	$('#nombreTutorEdit').val();
   	var telTutor = 	$('#telefonoTutorEdit').val();
   	var emailTutor = $('#emailTutorEdit').val();*/

    jQuery.noConflict();


    $('#dniAlumnoModif').val(dniAlumno);
    $('#dniViejo').val(dniTutorViejo);
    $('#cursoAct').val(cursoActual);


   	$('#modComoNuevoTutor').modal();
   	$("#editarTutor").modal('hide').on('hidden.bs.modal', functionThatEndsUpDestroyingTheDOM);
  }); 

  


});

</script>