 <?php
require_once "GUIPreceptor.class.php";
/**
 * Funcion principal para agregar un nuevo alumno al sistema. 
 * Consta de un formulario donde se agrega el dni del tutor. Se verifica su existencia. De no existir, el boton "nuevo tutor" nos
 * lleva a un modal donde podemos añadir uno.
 * Si el tutor que ingresamos existe, se ejecuta el archivo "cargarTutores" donde nos habilita a guardar al alumno que ingresemos. 
 * Si se presiona el boton guardar nos movemos a "cargaAlumnos.php"
 * archivos relacionados: cargarTutores.php - registroTutor.php - cargaAlumnos.php
 * @author Herrero Francisco Piñero Luciana
 * @version 1.0
 */
$gui_preceptor = new GUIPreceptor();
if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {
?> 

<body onkeypress="return pulsar(event)"> 
<div class="content-wrapper">

 <section class="content-header">
    <h1> CARGAR ALUMNOS
      <small> </small>
    </h1> 
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Agregar alumnos</li>
    </ol>
  </section>


  <section class="content">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4><i class='fa fa-user-plus'></i> Nuevo Alumno</h4>
			</div>
			<div class="panel-body">
				<?php 
				include("registroTutor.php"); // se incluye el modal para ingresar un tutor.
				?>
				<!-- formulario principal -->
				<form class="form-horizontal" role="form" id="datos_alumno" action="../logica/cargaAlumnos.php" method="post">
					 <div class="box-header">
			   			 <h3 class="box-title">Datos del Tutor</h3>
			   			 
							<div class="pull-right">
								<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#nuevoTutor" id="botonNuevoTutor">
								 <span class="fa fa-user-plus"></span> Nuevo Tutor
								</button>
							</div>	
						
			 		 </div>
		     		 
					<div class="form-group row">
					  <label for="dniTutor" class="col-md-1 control-label">DNI</label>
					  <div class="col-md-3">
					 
						  <input type="text" class="form-control input-sm" id="dniTutor" name="dniTutor" placeholder="Buscar Tutor" required >
					  
					  </div>
					  <div id="dniTutorAjax"> <!-- En este div se carga el resultado de cargaTutores.php -->

					  <label for="apeTutor" class="col-md-1 control-label">Apellidos</label>
								<div class="col-md-2">
									<input type="text" class="form-control input-sm" name="apeTutor" placeholder="apellidos" readonly>
								</div>
						<label for="" class="col-md-1 control-label">Nombre</label>
								<div class="col-md-3">
									<input type="text" class="form-control input-sm" name="nomTutor" placeholder="nombre" readonly>
								</div>
						 
					  </div>
					</div>	 
				</form>	
				<!-- fin formulario principal -->	
			</div>
		</div>
	</section>
</div>

<script src="../recursos/jquery-ajax.min.js">
    //script para traer la libreria de Jquery
</script>

<script>
function pulsar(e) {
    tecla=(document.all) ? e.keyCode : e.which;
  if(tecla==13) return false;
}
</script>

<script>
// funcion para que cuando vayamos ingresando el dni del tutor, se verifique su existencia. En caso afirmativo, 
//se habilita el panel "cargarTutores.php"
$( "#dniTutor" ).keyup(function() {
  var parametros = {
                    "dni" : $("#dniTutor").val(),
                  };
                  $.ajax({
                   data: parametros,
                   type: "post",
                   url: "../logica/cargarTutores.php",
                   datatype: "html",

                   success: function(respuesta)
                   {   
                     $('#dniTutorAjax').html(respuesta);
                   }
                 });
                });

// funcion para que cuando apretemos el boton "nuevo tutor" se habilite el modal "registroTutor.php"
$("[id='botonNuevoTutor']").click(function() {
   	var dniTutor = 	$('#dniTutor').val();

    jQuery.noConflict(); 

    $('#dni').val(dniTutor);
   	$('#nuevoTutor').modal();
  }); 


</script>

	<?php
	$gui_preceptor->cargarFooter();
}


else{
	?>


</body>
</html>
<?php
  }
?>