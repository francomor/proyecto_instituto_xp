  <?php
require_once "GUIPreceptor.class.php";

/**
 * Este archivo informa si el alumno fue asinago a un curso correctamente.
 * @author Piñero Luciana  
 * @version 1.0
 */
$gui_preceptor = new GUIPreceptor();
if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {
?> 


<div class="content-wrapper">

 <section class="content-header">
    <h1>  
      <small> </small>
    </h1> 
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#"><i class="#"></i> Alumnos</a></li>
      <li class="active">Carga de alumnos</li>
    </ol>
  </section>


    <div class="container">

    <div class="col-md-12"> 
	  <div class="panel panel ">  
		 
	 
		<div class="panel-body" align="center">
		<div class="col-md-12"> 
		 <div class="panel panel-success" align="center">
			<div class="panel-heading"> 
	 			Alumno Asignado correctamente! 
			</div>
		
         	
		</div>
	<div class="col-md-11"> 	
		<a href="../presentacion/asignarAlumnos.php"  >
			<button  type="button" class="btn btn-danger" > 
		 		<span class="fa fa-user-plus"></span> Asignar otro Alumno
			</button>
		</a>
	</div>

		</div>
		
		</div>

	</div> 	
	</div>
	
		</div>	
	</div>
</div>

          

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
 

