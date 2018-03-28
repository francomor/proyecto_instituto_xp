<?php
    
    //Agrega la interfaz del preceptor comun a todas las secciones
    include_once("GUIPreceptor.class.php");
    $gui_preceptor = new GUIPreceptor();
?>
    

 <div class="content-wrapper">
 
    <section class="content-header">
      <h1>
         
        <small> </small>
      </h1>
        <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="registrarAsistencia.php">Asistencias</a></li>
        <li class="active">Registrar asistencias</li>
      </ol> 
    </section>
     

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
        
    </div>

    <body>
        <?php
        include("../logica/clases.php");
        date_default_timezone_set('UTC');
        $curso = $_REQUEST['sel']; //se obtiene el id del curso seleccionado desde el archivo cursos.php
        $alumnos = AlumnoxCurso::obtener_alumnoxCurso($curso, (int) date("Y")); //se obtienen los alumnos del curso seleccionado del a�o actual
        $cantfilas = count($alumnos); //se cuentan los registros obtenidos de la consulta anterior
        ?>
        <form action="#" method="get">
        <div class="panel-heading ">
             
            </div>
            <!-- tabla donde estan contenidos todos los alumnos del curso seleccionado !-->
            <table class="table table-bordered" border="1" width="100%">

                <tr>
                    <td rowspan="2" colspan="2">Curso: 
                        <?php
                        //se muestra en la tabla el curso actual
                        $c = new Curso();
                        $curso_actual = $c->obtener_curso($curso);
                        echo $curso_actual [0]['anio'] . ' ' . $curso_actual[0]['nombre'];
                        ?>
                    </td>
                
                </tr>
                <tr>
                    <td colspan="2">Inasistencias</td>
                </tr>
                <tr>
                    <td width="3%">#</td>
                    <td width="40%">Apellido y nombre</td>
                    <td >Clase
                    </td>
                    <td>Ed-Fisica</td>
                </tr>       

                <?php
                for ($i = 0; $i < $cantfilas; $i++) {
                    //se hace de manera dinamica la carga de los alumnos a la tabla, con sus respectivos 
                    //checkbox donde se computan las faltas a clase y a ed-fisica.
                    ?>
                    <tr>
                        <td><?php echo $i + 1 ?></td> <!-- se muestra el numero del alumno en la tabla -->
                        <td><?php echo $alumnos[$i]["apellido"] . ", " . $alumnos[$i]["nombre"] ?> </td> 
                        <!-- se muestra el nombre y apellido del alumno en la tabla --> 
                        <td>
                            <!--checkbox para computar la asistencia a clase-->
                            <input class="btn btn-danger col-md-2" value="Imprimir Boletin"  type="button" name="<?php echo ($i + 1) . "clase_aus" ?>" id="<?php echo ($i + 1) . "clase_aus" ?>"> 
                        </td>
                        <td>
                            <!--checkbox para computar la asistencia a ed fisica -->
                            <input  class="hab_deshab" value="Ver Boletin" type="button" name="<?php echo ($i + 1) . "ed-f_aus" ?>" id="<?php echo ($i + 1) . "ed-f_aus" ?>"> 
                            <!--input hidden para enviar al servidor todos los alumnos del curso -->
                            <input hidden value="<?php echo $alumnos[$i]["dni"] ?>" name="<?php echo $i + 1 ?>">
                            <!--input hidden para enviar al servidor la cantidad de alumnos -->
                            <input hidden value="<?php echo $cantfilas ?>" name="cant_alumnos">
                            <!--input hidden para enviar al servidor el curso actual -->
                            <input hidden value="<?php echo $curso ?>" name="curso_actual">
                        </td>
                    </tr>


                    <?php
                }//cierre del for
                ?>

            </table>
           
             <div class="float-right">
                <input type="submit" class="btn btn-danger" value="GUARDAR" id="guardar">
            </div>
        </form>

        <script>
            //funcion para cambiar el imput hidden que envia al servidor el valor de la falta, dependiendo el dia.
            // si es de clase solo se cambia por 1, si es de clase y educacion fisica se cambia por 1/2.
            function hab_des_ef() {
                var chkbox = document.getElementById("valor-parcial");
                var envio = document.getElementById("valor_parcial_envio");
                if (chkbox.checked === true) {
                    envio.value = 1 / 2;
                } else {
                    envio.value = 1;
                }
            }
        </script>

        <script src="../recursos/jquery-ajax.min.js">
            //script para traer la libreria de Jquery
        </script>
        <script>
            //funcion Jquery para habilitar o deshabilitar los checkbox que representan las faltas a ed-fisica
            //de los alumnos a partir del evento de click a un checkbox.
            $(document).ready(function () {
                $('.checkb').change(function () {
                    hab_des_ef();
                    if ($(this).prop('checked')) {
                        $('.hab_deshab').prop('disabled', false);
                        $('.hab_deshab').prop('checked', false);
                    } else {
                        $('.hab_deshab').prop('disabled', true);
                        $('.hab_deshab').prop('checked', false);
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