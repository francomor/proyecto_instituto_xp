<?php
/**
 * Muestra un listado con todos los preceptores de la base de datos, donde cada uno tiene un boton de edicion el cual le permite modificar la contraseña de su cuenta.
 * @author Corrionero Federico y Peralta Gabriela
 * @version 1.0
 */

//Agrega la interfaz del preceptor comun a todas las secciones
include_once "GUIPreceptor.class.php";
include_once("../logica/Preceptor.php");


$gui_preceptor = new GUIPreceptor();
?>

 <div class="content-wrapper">
 
    <section class="content-header">
      <h1>
        MOSTRAR PRECEPTORES   
        <small> </small>
      </h1>
        <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mostrar Preceptores</li>
      </ol> 
    </section>
     
<div id="editar">
     <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> </h3>
            </div>
            <!-- /.box-header -->
          <div class="box-body">  

            <div class="container">
        
  
            <table class="table table-bordered table-hover" border="1" width="100%">

                
               <thead>
                 <tr>
                    <th scope="col">#</th>
                    <th scope="col">Preceptor</th>
                    <th scope="col">Editar</th>
                 </tr>

               </thead>


                <?php
                $p=new Preceptor();
                $preceptores=$p->obtenerPreceptor();
                for ($i = 0; $i < count($preceptores); $i++) {
                    
                    ?>
                    <tr>
                        <td><?php echo $i + 1 ?></td>
                        <td><?php 
                        $nombrePreceptor=$preceptores[$i]["nombre"] . " " . $preceptores[$i]["apellido"];
                        if (mb_detect_encoding($nombrePreceptor, 'utf-8', true) === false) {
                        $nombrePreceptor = mb_convert_encoding($nombrePreceptor, 'utf-8', 'iso-8859-1');
                        } 
                        echo $nombrePreceptor; ?> </td> 
                        <td>
                            <input  class="btn btn-danger" name="botonEditar" id="<?php echo $preceptores[$i]['id_usuario'];?>" value="Editar">
                        </td>
                    </tr>


                    <?php
                   
                }//cierre del for
                ?>

            </table>
  
        </div>
        </div>
      </div>
      </div>
      </div>
    </section>
 </div>   

</div>
  <script src="../recursos/jquery-2.2.3.min.js">
            //script para traer la libreria de Jquery
          </script>

          <script src="../recursos/jquery-ajax.min.js">
            //script para traer la libreria de Jquery
          </script>
          jquery-2.2.3.min

<script>
  $(document).ready(function() {

// funcion para que cuando se presiona el boton de "editar" de algun alumno, se ejecute el archivo "editarAlumno.php" y 
// se abra un formulario para editarlo.
$("[name='botonEditar']").on('click', function(){
  var parametros = {
                    "id_usuario" : $(this).attr('id')
                  };
                  $.ajax({
                   data: parametros,
                   type: "post",
                   url: "../presentacion/editarPreceptor.php",
                   datatype: "html",

                   success: function(respuesta)
                   {   
                     $("[id='editar']").html(respuesta);
                   }
                 }); 

});

});

</script>

  <?php
  $gui_preceptor->cargarFooter();
  ?>