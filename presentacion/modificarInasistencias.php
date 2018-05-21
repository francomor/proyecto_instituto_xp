<?php
/**
 * En este archivo, se manejan las modificaciones de las faltas cuando en el archivo tabla.php se modifica la fecha.
 * @author Martinez Natali y Herrero Francisco
 * @version 1.0
 */
require_once "GUIPreceptor.class.php";
if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {

    require "../logica/AlumnoxCurso.php";
    require_once "../logica/Curso.php";
    require_once "../logica/Asistencia.php";
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $curso = (int)$_REQUEST['curso']; //se obtiene el id del curso desde el archivo tabla.php
    $fecha = $_REQUEST['fecha']; //se obtiene la fecha que se selecciona del archivo tabla.php

    $a = new Asistencia();
    $inasistencia = $a->inasistenciaxCurso($curso,$fecha,(int) date("Y"));// obtenemos todas las asistencias del curso dado en la fecha dada. 
    $cantAlumnos = count($inasistencia); //se cuentan los registros obtenidos de la consulta anterior
    $cantidadInasistencias=$a->ObtenerCantidadInasistencias($curso,$fecha);
?>
<body>
    <form action="../logica/guardar.php" method="post" onsubmit="noSobreescribir()">
        <div class="panel-heading ">
         <!--input para manipular facilmente la cantidad de inasistencias -->
          <input type="text" hidden value=<?php echo $cantidadInasistencias ?> id="cantInasistencias">
          <!--Boton para permitir la modificacion del formulario -->
          <input type="button" class="btn btn-danger" value="MODIFICAR" name="modificar" id="modificar"><br>
          <!--checkbox para habilitar o deshabilitar los dias de educacion fisica o clase -->
          <input type="checkbox" class="checkb" disabled name="valorParcial" id="valorParcial" title="Para habilitar presione modificar">
          Habilitar ed-fisica 
          <!--input hidden para enviar el valor de la falta correspondiente al dia, si es de clase solo, se envia un 1. Si es de clase y ed fisica se envia 0.5 -->
          <input type="text" name="valorParcialEnvio" id="valorParcialEnvio" value="1" hidden>

      </div>
      <!-- tabla donde estan contenidos todos los alumnos del curso a modificar en la fecha propuesta !-->
      <table class="table table-bordered table-hover" border="1" width="80%">

        <tr>
            <td rowspan="2" colspan="2">Curso: 
                <?php
                    //se muestra en la tabla el curso actual
                $c = new Curso();
                $curso_actual = $c->obtenerCurso($curso);
                echo $curso_actual [0]['anio'] . ' ' . $curso_actual[0]['nombre'];
                ?>
            </td>
            <td width="20%" colspan="3">Fecha: 
                <input type="date" name="fecha" id="fecha" value="<?php echo date('Y-m-d', strtotime($fecha)); ?>" required>  <!-- fecha de hoy por defecto !-->
            </td>
        </tr>
        <tr>
            <td colspan="3">Inasistencias</td>
        </tr>
        <tr>
            <td width="2%">#</td>
            <td width="40%">Apellido y nombre</td>
            <td width="7%" style="text-align: center;">Clase</td>
            <td width="7%" style="text-align: center;"> Llegada tarde </td>
            <td width="7%" style="text-align: center;">Ed-Fisica</td>
          </tr>        

        <?php
        for ($i = 0; $i < $cantAlumnos; $i++) {



                //se hace de manera dinamica la carga de los alumnos a la tabla, con sus respectivos 
                //checkbox donde se computan las faltas a clase y a ed-fisica.
            ?>
            <tr>
                <!--input hidden para obtener el tipo de falta que tienen los alumnos que queremos modificar -->
                <input hidden value="<?php echo $inasistencia[$i]["tipo"] ?>" id="<?php echo ($i + 1) . "tipoFalta" ?>">
                <!--input hidden para obtener el valor de falta que tienen los alumnos que queremos modificar -->
                <input hidden value="<?php echo $inasistencia[$i]["valor"] ?>" id="<?php echo ($i + 1) . "valorFalta" ?>">
                <!--input hidden para enviar al servidor todos los alumnos del curso -->
                <input hidden value="<?php echo $inasistencia[$i]["alumno_dni"] ?>" name="<?php echo $i + 1 ?>">
                <!--input hidden para enviar al servidor la cantidad de alumnos -->
                <input hidden value="<?php echo $cantAlumnos ?>" name="cantAlumnos" id="cantAlumnos">
                <!--input hidden para enviar al servidor el curso actual -->
                <input hidden value="<?php echo $curso ?>" name="cursoActual">
                <!-- se muestra el numero del alumno en la tabla -->
                <td><?php echo $i + 1 ?></td> 
                <!-- se muestra el nombre y apellido del alumno en la tabla --> 
                <td><?php 
                        $nombreAlumno=$inasistencia[$i]["apellido"] . ", " . $inasistencia[$i]["nombre"];
                        if (mb_detect_encoding($nombreAlumno, 'utf-8', true) === false) {
                        $nombreAlumno = mb_convert_encoding($nombreAlumno, 'utf-8', 'iso-8859-1');
                        } 
                        echo $nombreAlumno ?>  </td> 


                <td style="text-align: center;">
                    <!--checkbox para computar la asistencia a clase-->
                    <input disabled class="hab_deshab_clase" value="clase"  type="checkbox" name="<?php echo ($i + 1) . "claseAusente" ?>" id="<?php echo ($i + 1) . "claseAusente" ?>" title="Para habilitar presione modificar" onClick="controlarCB('<?php echo ($i + 1) ?>',1)"> 
                </td>
                <td style="text-align: center;">
                <!--checkbox para computar la llegada tarde a clase-->
                <input disabled class="hab_deshab_tarde" value="tarde"  type="checkbox" name="<?php echo ($i + 1) . "claseTarde" ?>" id="<?php echo ($i + 1) . "claseTarde" ?>" onClick="controlarCB('<?php echo ($i + 1) ?>',2)">
              </td>
                <td style="text-align: center;">
                    <!--checkbox para computar la asistencia a ed fisica -->
                    <input disabled class="hab_deshab" value="edfisica" type="checkbox" name="<?php echo ($i + 1) . "edFAusente" ?>" id="<?php echo ($i + 1) . "edFAusente" ?>" title="Para habilitar presione modificar"> 

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
            
            //funcion para no sobreescribir las inasistencias guardadas de ese curso en esa fecha cuando el usuario no presiona el boton modoficar
            // si el boton modificar no es presionado
            function noSobreescribir(){
            var cantidad = document.getElementById("cantAlumnos").value;
                for(var i=0; i<parseInt(cantidad); i++){
                        var clase=(i+1)+'claseAusente';
                        var ed_fisica=(i+1)+'edFAusente';
                        var tarde= (i+1)+'claseTarde';
                        document.getElementById(clase).disabled=false;
                        document.getElementById(ed_fisica).disabled=false;
                        document.getElementById(tarde).disabled=false;

                    }
                    document.getElementById("valorParcial").disabled=false;

           }

        </script>

        <script>
                //funcion Jquery para habilitar o deshabilitar los checkbox que representan las faltas a ed-fisica
            //de los alumnos a partir del evento de click a un checkbox.
            $(document).ready(function () {

                $('.checkb').change(function () {
                    
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
                $('#fecha').change(function () {
                    var parametros = {
                        "curso": "<?php echo $curso ?>",
                        "fecha": $("#fecha").val()

                    };
                    $.ajax({
                        data: parametros,
                        type: "post",
                        url: "modificarInasistencias.php",
                        datatype: "html",

                        success: function (respuesta)
                        {
                            $('#formulario').html(respuesta);
                        }
                    });
                });

                
                //cuando se presiona el boton modificar se habilitan todas las opciones
                $('#modificar').click(function () {
                    if (confirm("¿Está seguro que desea modificar?")) {
                        for(var i=0; i<$('#cantAlumnos').val();i++){
                        var clase='#'+(i+1)+'claseAusente';
                        var ed_fisica='#'+(i+1)+'edFAusente';  
                        $(clase).prop('title', '');
                        $(ed_fisica).prop('title', '');
                    }
                    if($('.checkb').prop('checked')){
                        $('.hab_deshab').prop('disabled', false);
                        $('.checkb').prop('title', "Deshabilitar como día de educación física");
                    }
                    else
                        {
                            $('.checkb').prop('title', "Habilitar como día de educación física");
                        }
                    $('.hab_deshab_clase').prop('disabled', false);
                    $('.hab_deshab_tarde').prop('disabled', false);
                    $('.checkb').prop('disabled', false);

                     }
                });
           
                
            //funcion Jquery para habilitar o deshabilitar los checkbox que representan las faltas a ed-fisica y clase
            //de los alumnos dependiendo el tipo y valor de falta que se trae de la base de datos. ademas se modifica
            // dependiendo tambien el tipo y valor de falta el checkbox de habilitar o deshabilitar ed-fisica.

            if($('#cantInasistencias').val()>0){
            for(var i=0; i<$('#cantAlumnos').val();i++){
                var clase='#'+(i+1)+'claseAusente';
                var ed_fisica='#'+(i+1)+'edFAusente';
                var tarde='#'+(i+1)+'claseTarde';
                var indice = '#'+(i+1)+'tipoFalta';
                var valor = '#'+(i+1)+'valorFalta';
                switch ($(indice).val()) {
                    case 'clase':
                            {
                              $(clase).prop('checked', true);
                            }
                            break;
                          case 'edFisica':
                            {
                              $('.checkb').prop('checked', true);
                              $(ed_fisica).prop('checked', true);
                              //$('.hab_deshab').prop('disabled', true);
                            }
                            break;
                          case 'clase+edFisica':
                            {
                              $(clase).prop('checked', true);
                              $(ed_fisica).prop('checked', true);
                              $('.checkb').prop('checked', true);
                              //$('.hab_deshab').prop('disabled', true);
                            }
                            break;
                          case 'tarde':
                            {
                              $(tarde).prop('checked', true);
                            }
                            break;
                          case 'tarde+edFisica':
                            {
                              $(tarde).prop('checked', true);
                              $(ed_fisica).prop('checked', true);
                              $('.checkb').prop('checked', true);
                            }
                            break;

            }
        }
}
else{
    for(var i=0; i<$('#cantAlumnos').val();i++){
    var clase='#'+(i+1)+'claseAusente';
    var ed_fisica='#'+(i+1)+'edFAusente';
    var tarde='#'+(i+1)+'claseTarde';
    $(ed_fisica).prop('disabled', true);
    $(tarde).prop('disabled', false);
    $(clase).prop('disabled', false);
    $(clase).prop('title', '');
    $(ed_fisica).prop('title', '');
}
    $('.checkb').prop('checked', false);
    $('.checkb').prop('disabled', false);
    $('#modificar').hide();
    $('.checkb').prop('title', '');
}



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

<?php
} 
else {
  header('location: ../presentacion/login.php');
}