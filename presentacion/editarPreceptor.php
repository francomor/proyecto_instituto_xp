<?php
include_once("../logica/Preceptor.php");


/**
 * Cursos
 * @author 
 * @version 1.0
 */

$idP = $_POST['id_usuario'];
$p=new Preceptor();
$preceptores=$p->obtenerPreceptorXid($idP);

?> 
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4><i class="fa fa-pencil fa-fw"></i> <?php echo $preceptores[0]['nombre'].' '. $preceptores[0]['apellido'] ?> </h4>
		</div>
		<div class="panel-body">
			<form class="form-horizontal" role="form" id="editarPreceptor" action="../logica/modificarPreceptor.php" method="post">  
				 <div class="box-header">
           			 <h3 class="box-title">Modificar contraseña</h3>

         		 </div>


         		 
				<div class="form-group row">
				  <label for="contraseña" class="col-md-1 control-label">Contraseña</label>
				  <div class="col-md-3">

				  	<input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" autocomplete="off">
				 
				  
				  </div>
						 
				</div>	 

					<!--<div class="form-row">-->
            		  	<div class="col-lg-offset-0 col-lg-10">
    
                		<button type="submit" class="btn btn-danger" name="boton_guardar" value="Guardar">Guardar</button>

                		  <a href="./mostrarPreceptores.php" class="btn btn-danger">Cancelar</a>
            
             		</div>


             	
             		<input hidden type="text" id="idp" name="idp" value="<?php echo $preceptores[0]['id_usuario'] ?>">



			</form>	
			
		<div id="resultados" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->			
		</div>
	</div>		
		  <div class="row-fluid">
			<div class="col-md-12">
			
	

			
			</div>	
		 </div>
</div>
	<!--agregar estas librerias despues, es para los alert -->


<script src="../recursos/jquery-ajax.min.js">
//script para traer la libreria de Jquery
</script>

