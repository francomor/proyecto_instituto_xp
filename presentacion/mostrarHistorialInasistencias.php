<?php
/**
 * Muestra el historial de las inasistencias tomadas hasta el dia de la fecha, detallando preceptor, curso y fecha en la que fue registrada. 
 * @author Corrionero Federico y Peralta Gabriela
 * @version 1.0
 */

//Agrega la interfaz del preceptor comun a todas las secciones
include_once "GUIPreceptor.class.php";
include_once("../logica/Asistencia.php");


$gui_preceptor = new GUIPreceptor();
?>

 <div class="content-wrapper">
 
    <section class="content-header">
      <h1>
        HISTORIAL DE REGISTRO DE ASISTENCIAS   
        <small> </small>
      </h1>
        <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Ver Historial</li>
      </ol> 
    </section>
     
<div id="historial">
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
            <body>
            <table class="table table-bordered table-hover" border="1" width="80%">

                
               <thead>
                 <tr>
                    <th>Fecha</th>
                    <th>Preceptor</th>
                    <th>Curso</th>
                 </tr>

               </thead>


                <?php
                $a=new Asistencia();
                $datos=$a->obtenerHistorialDeInasistencias();
                for ($i = 0; $i < count($datos); $i++) {
                    
                    ?>
                    <tr>
                        <td><?php echo $fecha=$datos[$i]["fecha"]?></td>
                          <td><?php 
                        echo $preceptor=$datos[$i]["preceptor_id"];
                        ?>
                        </td>
                        <td><?php 
                        echo $nombreCurso=$datos[$i]["anio"] . " " . $datos[$i]["nombre"];
                        ?></td> 
                      
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



 <?php

$gui_preceptor->cargarFooter();

?>