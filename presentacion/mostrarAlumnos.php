<?php
/**
 * Muestra un listado con todos los alumnos de la base de datos, donde cada uno tiene relacionado 2 botones:
 * 1- editar. 2 - eliminar.
 * archivos relacionados: borrarAlumno.php - editarAlumno.php
 * @author Herrefo Francisco y Piñero Luciana
 * @version 1.0
 */

//Agrega la interfaz del preceptor comun a todas las secciones
include_once "GUIPreceptor.class.php";
include_once("../logica/Alumno.php");


$gui_preceptor = new GUIPreceptor();
?>

 <div class="content-wrapper">
 
    <section class="content-header">
      <h1>
        MOSTRAR ALUMNOS   
        <small> </small>
      </h1>
        <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mostrar Alumnos</li>
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
        
        <!-- formulario donde estará contenida la tabla con los alumnos y sus respectivos botones -->
        <form id="formu" name="formu">
            <table class="table table-bordered table-hover" border="1" width="100%">

                
               <thead>
                 <tr>
                    <th scope="col">#</th>
                    <th scope="col">Apellido y Nombre</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                 </tr>

               </thead>


                <?php
                $a=new Alumno();
                $alumnos=$a->obtenerAlumnos();
                for ($i = 0; $i < count($alumnos); $i++) {
                    
                    ?>
                    <tr>
                        <td><?php echo $i + 1 ?></td>
                        <td><?php 
                        $dniAlu=$alumnos[$i]['dni'];
                        $nombreAlumno=$alumnos[$i]["apellido"] . ", " . $alumnos[$i]["nombre"];
                        if (mb_detect_encoding($nombreAlumno, 'utf-8', true) === false) {
                        $nombreAlumno = mb_convert_encoding($nombreAlumno, 'utf-8', 'iso-8859-1');
                        } 
                        echo $nombreAlumno; ?> </td> 
                        <td>
                            <input  class="btn btn-danger" name="botonEditar" id="<?php echo $alumnos[$i]['dni'];?>" value="Editar">
                        </td>
                         <td>
                            <input  class="btn btn-danger" name="botonEliminar" id="<?php echo $alumnos[$i]['dni'];?>" value="Eliminar">
                            <input hidden type="text" name="dniAlu" id="dniAlu">
                        </td>
                    </tr>


                    <?php
                   
                }//cierre del for
                ?>

            </table>
        </form>
          <!-- fin formulario -->
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

// funcion para que cuando se presiona el boton de "elminiar" de algun alumno, se ejecute el archivo "borrarAlumno.php" y borre de la base
// de datos y de la tabla al alumno seleccionado.
$("[name='botonEliminar']").on('click', function(){
    var opcion = confirm("¿Está seguro que quiere borrar?");
    if (opcion == true) {
  var parametros = {
                    "dni" : $(this).attr('id')
                  };
                  $.ajax({
                   data: parametros,
                   type: "post",
                   url: "../logica/borrarAlumno.php",
                   datatype: "html",

                   success: function(respuesta)
                   {   
                     $("[id='formu']").html(respuesta);
                   }
                 });
                  } 

});

// funcion para que cuando se presiona el boton de "editar" de algun alumno, se ejecute el archivo "editarAlumno.php" y 
// se abra un formulario para editarlo.
$("[name='botonEditar']").on('click', function(){
  var parametros = {
                    "dni" : $(this).attr('id')
                  };
                  $.ajax({
                   data: parametros,
                   type: "post",
                   url: "../presentacion/editarAlumno.php",
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