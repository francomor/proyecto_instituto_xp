<?php
/**
 * En este archivo, se manejan las cargas de las faltas cuando en el archivo curso.php se selecciona un curso.
 * @author Corrionero Federico y Herrero Francisco
 * @version 1.0
  * @author Martinez Natali y Herrero Francisco
 * @version 2.0
 */

//Agrega la interfaz del preceptor comun a todas las secciones
require_once "GUIPreceptor.class.php";

/**
 * Tabla
 * @author 
 * @version 1.0
 */
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
              require "../logica/AlumnoxCurso.php";
              require_once "../logica/Curso.php" ;
              require_once "../logica/Asistencia.php";
              date_default_timezone_set('America/Argentina/Buenos_Aires');
        $curso = $_REQUEST['sel']; //se obtiene el id del curso seleccionado desde el archivo cursos.php
        $alumnos = AlumnoxCurso::obtenerAlumnoxCurso($curso, (int) date("Y")); //se obtienen los alumnos del curso seleccionado del a�o actual
        $cantfilas = count($alumnos); //se cuentan los registros obtenidos de la consulta anterior
        $fecha = date("Y")."-".date("m")."-".date("d"); // obtenermos la fecha de hoy y le damos formato de bdd
        $a = new Asistencia(); //crear asistencia
        $inasistencia = $a->inasistenciaxCurso($curso,$fecha,(int) date("Y")); // obtenemos todas las asistencias del curso dado en la fecha dada. 
        $cantidadInasistencias=$a->ObtenerCantidadInasistencias($curso,$fecha);
        ?>
        <form action="../logica/guardar.php" method="post" id="formulario">
          <div class="panel-heading ">
          <!--input para manipular facilmente la cantidad de inasistencias -->
          <input type="text" hidden value=<?php echo $cantidadInasistencias ?> id="cantInasistencias">
           <!--checkbox para habilitar o deshabilitar los dias de educacion fisica o clase -->
           <input type="checkbox" class="checkb"  name="valorParcial" id="valorParcial">
           Habilitar ed-fisica 
           <!--input hidden para enviar el valor de la falta correspondiente al dia, si es de clase solo, se envia un 1. Si es de clase y ed fisica se envia 1/2 -->
           <input type="text" name="valorParcialEnvio" id="valorParcialEnvio" value="1" hidden>

         </div>
         <!-- tabla donde estan contenidos todos los alumnos del curso seleccionado !-->
         <table class="table table-bordered table-hover" border="1" width="80%">

          <tr>
            <td rowspan="2" colspan="2">Curso: 
              <?php
                        //se muestra en la tabla el curso actual
              $c = new Curso();
              $cursoActual = $c->obtenerCurso($curso);
              echo $cursoActual [0]['anio'] . ' ' . $cursoActual[0]['nombre'];
              ?>
            </td>
            <td width="20%" colspan="3">Fecha: 
              <input name="fecha" id="fecha" type="date" value="<?php echo date('Y-m-d', strtotime($fecha)) ?>" required> <!-- fecha de hoy por defecto !-->
            </td>
          </tr>
          <tr>
            <td colspan="3">Inasistencias</td>
          </tr>
          <tr>
            <td width="2%">#</td>
            <td width="40%">Apellido y nombre</td>
            <td width="7%">Clase</td>
            <td width="7%"> Llegada tarde </td>
            <td width="7%">Ed-Fisica</td>
          </tr>       

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
                        echo $nombreAlumno ?> </td> 
              <!-- se muestra el nombre y apellido del alumno en la tabla --> 
              <td>
                <!--checkbox para computar la asistencia a clase-->
                <input value="clase"  type="checkbox" name="<?php echo ($i + 1) . "claseAusente" ?>" id="<?php echo ($i + 1) . "claseAusente" ?>" onClick="controlarCB('<?php echo ($i + 1) ?>',1)"> 
              </td>
              <td>
                <!--checkbox para computar la llegada tarde a clase-->
                <input value="tarde"  type="checkbox" name="<?php echo ($i + 1) . "claseTarde" ?>" id="<?php echo ($i + 1) . "claseTarde" ?>" onClick="controlarCB('<?php echo ($i + 1) ?>',2)"> 
              </td>
              <td>
               <!--input hidden para obtener el tipo de falta que tienen los alumnos que queremos modificar -->
               <input hidden value="<?php echo $inasistencia[$i]["tipo"] ?>" id="<?php echo ($i + 1) . "tipoFalta" ?>">
               <!--input hidden para obtener el valor de falta que tienen los alumnos que queremos modificar -->
               <input hidden value="<?php echo $inasistencia[$i]["valor"] ?>" id="<?php echo ($i + 1) . "valorFalta" ?>">

               <!--checkbox para computar la asistencia a ed fisica -->
               <input disabled class="hab_deshab" value="edfisica" type="checkbox" name="<?php echo ($i + 1) . "edFAusente" ?>" id="<?php echo ($i + 1) . "edFAusente" ?>"> 
               <!--input hidden para enviar al servidor todos los alumnos del curso -->
               <input hidden value="<?php echo $alumnos[$i]["dni"] ?>" name="<?php echo $i + 1 ?>">
               <!--input hidden para enviar al servidor la cantidad de alumnos -->
               <input hidden value="<?php echo $cantfilas ?>" name="cantAlumnos" id="cantAlumnos">
               <!--input hidden para enviar al servidor el curso actual -->
               <input hidden value="<?php echo $curso ?>" name="cursoActual">
             </td>
           </tr>


           <?php
                }//cierre del for
                ?>

              </table>

              <div class="float-right">
                <input type="submit" class="btn btn-danger" value="GUARDAR" id="guardar"> <!-- Envio de formulario !-->
              </div>
            </form>

            <script>
            //funcion para cambiar el imput hidden que envia al servidor el valor de la falta, dependiendo el dia.
            // si es de clase solo se cambia por 1, si es de clase y educacion fisica se cambia por 1/2.
            function habDeshabEF() {
              var chkbox = document.getElementById("valorParcial");
              var envio = document.getElementById("valorParcialEnvio");
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
             //funcion Jquery para habilitar o deshabilitar los checkbox que representan las faltas a ed-fisica y clase
            //de los alumnos dependiendo el tipo y valor de falta que se trae de la base de datos. ademas se modifica
            // dependiendo tambien el tipo y valor de falta el checkbox de habilitar o deshabilitar ed-fisica.
            $(document).ready(function () {
              //condicion para que si en la fecha de hoy en el curso elegido hay inasistencias, es decir, ya fue cargado, se habilite como formulario de modificacion
              if($('#cantInasistencias').val()>0){
                var parametros = {
                    "curso" : "<?php echo $curso ?>",
                    "fecha" : $("#fecha").val()

                  };
                  $.ajax({
                   data: parametros,
                   type: "post",
                   url: "modificarInasistencias.php",
                   datatype: "html",

                   success: function(respuesta)
                   {   
                     $('#formulario').html(respuesta);
                   }
                 });
                }

              for(var i=0; i<$('#cantAlumnos').val();i++){
                var clase='#'+(i+1)+'claseAusente';
                var ed_fisica='#'+(i+1)+'edFAusente';
                var indice = '#'+(i+1)+'tipoFalta';
                var valor = '#'+(i+1)+'valorFalta';
                switch ($(indice).val()) {
                  case 'clase': {
                    $(clase).prop('checked', true);
                    if($(valor).val()=='1/2'){
                      $('.checkb').prop('checked', true); 
                      habDeshabEF();
                      $('.hab_deshab').prop('disabled', false);
                    }
                    else{
                     $('.checkb').prop('checked', false); 
                     habDeshabEF();
                   }

                 }
                 break;
                 case 'edFisica': {
                  $(ed_fisica).prop('checked', true);
                  habDeshabEF();
                  $('.hab_deshab').prop('disabled', false);
                }
                  break;
                  case 'clase+edFisica':{$(clase).prop('checked', true);
                  $(ed_fisica).prop('checked', true);
                  $('.checkb').prop('checked', true);
                  $('.hab_deshab').prop('disabled', false);
                  habDeshabEF();
                }
                break;
                case 'tarde':{
                        $(tarde).prop('checked', true);
                        $('.checkb').prop('checked', true);
                        habDeshabEF();
                        }
                    break;
                case 'tarde+edFisica':{
                        $(tarde).prop('checked', true);
                        $(ed_fisica).prop('checked', true);
                        $('.checkb').prop('checked', true);
                        habDeshabEF();
                        }
                    break;

              }
            }



            //funcion Jquery para habilitar o deshabilitar los checkbox que representan las faltas a ed-fisica
            //de los alumnos a partir del evento de click a un checkbox.
            $('.checkb').change(function () {
              habDeshabEF();
              if ($(this).prop('checked')) {
                $('.hab_deshab').prop('disabled', false);
                $('.hab_deshab').prop('checked', false);
                $('.checkb').prop('title', "Deshabilitar como día de educación física");
              } else {
                $('.hab_deshab').prop('disabled', true);
                $('.hab_deshab').prop('checked', false);
                $('.checkb').prop('title', "Habilitar como día de educación física");
              }
            });

                //Funcion Jquery y Ajax para al accionar el evento de cambiar de fecha se obtenga de la base de datos los valores de inasistencia que
                //corresponden a los alumnos del curso de donde estamos trabajando
                $('#fecha').change(function(){
                  var parametros = {
                    "curso" : "<?php echo $curso ?>",
                    "fecha" : $("#fecha").val()

                  };
                  $.ajax({
                   data: parametros,
                   type: "post",
                   url: "modificarInasistencias.php",
                   datatype: "html",

                   success: function(respuesta)
                   {   
                     $('#formulario').html(respuesta);
                   }
                 });
                });

                //Mensajes en los imputs para mejor comprension.
                if($('.checkb').checked=='true')
                  $('.checkb').prop('title', "Habilitar como día de educación física");
                else
                  $('.checkb').prop('title', "Deshabilitar como día de educación física");

                //condicion para que si ya hay cargadas asistencias entonces se abra el formulario como si fuera a modificar. en otro caso, se abre como nueva carga.


              });
</script>
<script>
  
 function controlarCB(numID,activador){

  //var cbClase = document.getElementById(numID.concat("claseAusente"));
  //var cbTarde = document.getElementById(numID.concat("claseTarde"));

if(activador==1 && document.getElementById(numID.concat("claseTarde")).checked==true)
      document.getElementById(numID.concat("claseTarde")).checked=false;
    //alert("debe desactivar algo");
  if(activador==2 && document.getElementById(numID.concat("claseAusente")).checked==true)
      document.getElementById(numID.concat("claseAusente")).checked=false;
    //alert("debe desactivar algo");


  }


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



