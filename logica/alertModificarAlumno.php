 <?php
require_once "../presentacion/GUIPreceptor.class.php";

/**
 * Cursos
 * @author 
 * @version 1.0
 */


$gui_preceptor = new GUIPreceptor();
if (isset($_SESSION["login"]) && $_SESSION["login"] == true && $_GET['valor']=='error') {
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
		 <div class="panel panel-danger" align="center">
			<div class="panel-heading"> 
	 			El DNI no puede ser modificado, ya que pertenece a otro alumno
			</div>
		
         	<div class="card" style="width: 18rem;" align="center">
 				<div class="card"  style="width: 18rem;">
  				 	<div class="card-body">
    				 
					</div>
				</div>
  			</div>
		</div>
		<div class="col-md-11"> 
		<a href="../presentacion/mostrarAlumnos.php"  >
		<button  type="button" class="btn btn-danger" > 
		 <span class="fa fa-user-plus"></span> Volver a mostrar alumnos
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
	 			Alumno modificadoCorrectamente 
			</div>
		
         	<div class="card" style="width: 18rem;" align="center">
 				<div class="card"  style="width: 18rem;">
  				 	<div class="card-body">
    				 
					</div>
				</div>
  			</div>
		</div>
		<div class="col-md-11"> 
		<a href="../presentacion/mostrarAlumnos.php"  >
		<button  type="button" class="btn btn-danger" > 
		 <span class="fa fa-user-plus"></span> Volver a mostrar alumnos 
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
  }
?>
 

