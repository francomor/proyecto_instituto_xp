
<?php

  //Agrega la interfaz del preceptor comun a todas las secciones
  include_once("GUIPreceptor.class.php");
  $gui_preceptor = new GUIPreceptor();
?>
  
  <div class="content-wrapper">
  
    <section class="content-header">
      <h1>
        IMPRIMIR ASISTENCIA
        <small> </small>
      </h1> 
       <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="formularioListarInasistencias.php">Asistencias</a></li>
        <li class="active">Imprimir Asistencia</li>
      </ol>
    </section>
    
 
 	<div class="panel-body">
		<div id="contenedor" class="container">
      <div class="row justify-content-md-center">
			     <form class="form-horizontal" method="POST" action="../presentacion/listarInasistencias.php" role="form">
      				<div class="form-group row">
                <div class="row">
                    <label for="dni_alumno" class="col-md-5 control-label" style="text-align: center">DNI del alumno</label>
                </div>
                <div class="row">
            		    <input type="text" class="col-md-5" id="dni" name="dni" pattern="[0-9]{8}" required>
                </div>
                <div class="row">
            		    <button class="btn btn-primary col-md-2" type="submit">Buscar</button>
                </div>
            	</div>
    			 </form>
      </div>       
    </div>
  </div>

  </div>
 

<?php     
  
  //Agrega el footer comun a todas las secciones
  $gui_preceptor->cargarFooter();
?>