<?php
/**
 * En este archivo,  
 * @version 1.0
  * @author Piñero Luciana 
 * 
 */

//Agrega la interfaz del preceptor comun a todas las secciones
require_once "GUIPreceptor.class.php";


require "../logica/AlumnoxCurso.php";
require_once "../logica/Curso.php" ;
               
$gui_preceptor = new GUIPreceptor();
?>


<div class="content-wrapper">

  <section class="content-header">
     <h1>  
        <small> </small>
      </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="#">Cursos</a></li>
      <li class="active">Buscar Alumnos</li>
    </ol> 
  </section>


  
  <div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4><i class='glyphicon glyphicon-search'></i> Buscar Alumno</h4>
    </div>
    <div class="panel-body">

   
      <!-- formulario principal -->
 <form class="form-horizontal" role="form" id="datos_alumno" action="../logica/cargaAlumnosAlCurso.php" method="post">
      
    <div class="form-group row">
          
          <label for="dniAlumno" class="col-md-1 control-label">DNI</label>
          <div class="col-md-3">
            <input type="text" class="form-control input-sm" id="dniAlumno" name="dniAlumno" placeholder="Buscar Alumno" required >
          </div>
          
          <div id="dniAlumnoAjax"> <!-- En este div se carga el resultado de cargaAlumnosAlCurso.php -->
           
           
          </div>
    </div>   
         
        <?php
             
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $curso = $_REQUEST['sel']; //se obtiene el id del curso seleccionado desde el archivo cursos.php
        $alumnos = AlumnoxCurso::obtenerAlumnoxCurso($curso, (int) date("Y")); //se obtienen los alumnos del curso seleccionado del a�o actual
        $cantfilas = count($alumnos); //se cuentan los registros obtenidos de la consulta anterior
         ?>
          
           <?php
                        //se muestra en la tabla el curso actual
              $c = new Curso();
              $cursoActual = $c->obtenerCurso($curso);
    
            ?>
         
           <hr/>

        <div class="panel-heading ">
          <div class="box-header">
              <h3 class="box-title"> </h3>

              <label for="curso" class="col-md-1 control-label"> CURSO </label> 
                <div class="col-md-2">
                  <input type="text" value=" <?php    echo $cursoActual [0]['anio'] . ' ' . $cursoActual[0]['nombre'];  ?> " class="form-control input-sm" id="nombrecurso" name="nombrecurso" readonly>
                </div>

                <label for="curso" class="col-md-1 control-label">ID </label> 
                <div class="col-md-2">
                  <input type="text" value=" <?php   echo $curso  ?> " class="form-control input-sm" id="curso" name="curso" readonly>
                </div>

            <label for="anio" class="col-md-1 control-label">AÑO</label>
            <div class="col-md-2">
              <input type="text" value=" <?php   echo  (int)date('Y') ?> " class="form-control input-sm" id="anio" name="anio" readonly>
            </div>
          </div>
        </div>

    <!-- tabla donde estan contenidos todos los alumnos del curso seleccionado !-->
    <table class="table table-bordered table-hover" border="1" width="50%">
                <thead>
                  <tr>
                    <th scope="col" width="5%">#</th>
                    <th scope="col" width="80%">Apellido y Nombre</th>
                    <th scope="col">Dar de baja</th>
                  </tr>

                   
                </thead>
                  
                <?php
               
                for ($i = 0; $i < $cantfilas; $i++) {
                    
                    //se hace de manera dinamica la carga de los alumnos a la tabla, con sus respectivos 
                    //checkbox donde se computan las faltas a clase y a ed-fisica.
                    ?>
                
                    <tr>
                        <td><?php echo $i + 1 ?></td> <!-- se muestra el numero del alumno en la tabla -->
                        <td><?php 
                        $nombreAlumno=$alumnos[$i]["apellido"] . ", " . $alumnos[$i]["nombre"];
                        if (mb_detect_encoding($nombreAlumno, 'utf-8', true) === false) {
                        $nombreAlumno = mb_convert_encoding($nombreAlumno, 'utf-8', 'iso-8859-1');
                        } 
                        echo $nombreAlumno; ?> </td> 
                        <!-- se muestra el nombre y apellido del alumno en la tabla --> 
                       <td> 

                          <a href="#" class='btn btn-default bg-red' title='Borrar cliente' onclick="eliminar('<?php echo $id_cliente; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
                       </td>
                    </tr>
                    <?php
                   
                }//cierre del for
                ?>
    </table>
  </form>

</div>      
            
 <script src="../recursos/jquery-ajax.min.js">  //script para traer la libreria de Jquery </script>
 

<script>
// funcion para que cuando vayamos ingresando el dni del tutor, se verifique su existencia. En caso afirmativo, 
//se habilita el panel "cargarTutores.php"
$( "#dniAlumno" ).keyup(function() {
  var parametros = {
                    "dni" : $("#dniAlumno").val(),
                  };
                  $.ajax({
                   data: parametros,
                   type: "post",
                   url: "../logica/buscarAlumno.php",
                   datatype: "html",

                   success: function(respuesta)
                   {   
                     $('#dniAlumnoAjax').html(respuesta);
                   }
                 });
                });
</script>
 
</body>

</div>
</div>
</div>

</section>


</div>



<?php

//Agrega el footer comun a todas las secciones
$gui_preceptor->cargarFooter();

?>



