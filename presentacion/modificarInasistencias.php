<?php
/**
 * En este archivo, se manejan las modificaciones de las faltas cuando en el archivo tabla.php se modifica la fecha.
 * @author Martinez Natali y Herrero Francisco
 * @version 1.0
 */
require "../logica/AlumnoxCurso.php";
require_once "../logica/Curso.php";
require_once "../logica/Asistencia.php";
date_default_timezone_set('UTC');
$curso = (int)$_REQUEST['curso']; //se obtiene el id del curso desde el archivo tabla.php
$fecha = $_REQUEST['fecha']; //se obtiene la fecha que se selecciona del archivo tabla.php

$a = new Asistencia();
$inasistencia = $a->inasistenciaxCurso($curso,$fecha,(int) date("Y"));// obtenemos todas las asistencias del curso dado en la fecha dada. 
$cantfilas = count($inasistencia); //se cuentan los registros obtenidos de la consulta anterior
?>
<body>
    <form action="../logica/guardar.php" method="get">
        <div class="panel-heading ">
          <!--Boton para permitir la modificacion del formulario -->
          <input type="button" class="btn btn-danger" value="MODIFICAR" name="modificar" id="modificar"><br>
          <!--checkbox para habilitar o deshabilitar los dias de educacion fisica o clase -->
          <input type="checkbox" class="checkb" disabled name="valor-parcial" id="valor-parcial">
          Habilitar ed-fisica 
          <!--input hidden para enviar el valor de la falta correspondiente al dia, si es de clase solo, se envia un 1. Si es de clase y ed fisica se envia 1/2 -->
          <input type="text" name="valor_parcial_envio" id="valor_parcial_envio" value="1" hidden>

      </div>
      <!-- tabla donde estan contenidos todos los alumnos del curso a modificar en la fecha propuesta !-->
      <table class="table table-bordered" border="1" width="80%">

        <tr>
            <td rowspan="2" colspan="2">Curso: 
                <?php
                    //se muestra en la tabla el curso actual
                $c = new Curso();
                $curso_actual = $c->obtenerCurso($curso);
                echo $curso_actual [0]['anio'] . ' ' . $curso_actual[0]['nombre'];
                ?>
            </td>
            <td width="20%" colspan="2">Fecha: 
                <input type="date" name="fecha" id="fecha" value="<?php echo date('Y-m-d', strtotime($fecha)); ?>" required>  <!-- fecha de hoy por defecto !-->
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
                <!--input hidden para obtener el tipo de falta que tienen los alumnos que queremos modificar -->
                <input hidden value="<?php echo $inasistencia[$i]["tipo"] ?>" id="<?php echo ($i + 1) . "tipo" ?>">
                <!--input hidden para obtener el valor de falta que tienen los alumnos que queremos modificar -->
                <input hidden value="<?php echo $inasistencia[$i]["valor"] ?>" id="<?php echo ($i + 1) . "valor" ?>">
                <!--input hidden para enviar al servidor todos los alumnos del curso -->
                <input hidden value="<?php echo $inasistencia[$i]["alumno_dni"] ?>" name="<?php echo $i + 1 ?>">
                <!--input hidden para enviar al servidor la cantidad de alumnos -->
                <input hidden value="<?php echo $cantfilas ?>" name="cant_alumnos" id="cant_alumnos">
                <!--input hidden para enviar al servidor el curso actual -->
                <input hidden value="<?php echo $curso ?>" name="curso_actual">
                <!-- se muestra el numero del alumno en la tabla -->
                <td><?php echo $i + 1 ?></td> 
                <!-- se muestra el nombre y apellido del alumno en la tabla --> 
                <td><?php echo $inasistencia[$i]["apellido"] . ", " . $inasistencia[$i]["nombre"] ?> </td> 


                <td>
                    <!--checkbox para computar la asistencia a clase-->
                    <input disabled class="hab_deshab_clase" value="clase"  type="checkbox" name="<?php echo ($i + 1) . "clase_aus" ?>" id="<?php echo ($i + 1) . "clase_aus" ?>"> 
                </td>
                <td>
                    <!--checkbox para computar la asistencia a ed fisica -->
                    <input disabled class="hab_deshab" value="edfisica" type="checkbox" name="<?php echo ($i + 1) . "ed-f_aus" ?>" id="<?php echo ($i + 1) . "ed-f_aus" ?>"> 

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



                //Funcion Jquery y Ajax para al accionar el evento de cambiar de fecha se obtenga de la base de datos los valores de inasistencia que
                //corresponden a los alumnos del curso de donde estamos trabajando
                $('#fecha').change(function () {
                    var parametros = {
                        "curso": "<?php echo $curso ?>",
                        "fecha": $("#fecha").val()

                    };
                    $.ajax({
                        data: parametros,
                        type: "Get",
                        url: "modificarInasistencias.php",
                        datatype: "html",

                        success: function (respuesta)
                        {
                            $('#formulario').html(respuesta);
                        }
                    });
                });


                $('#modificar').click(function () {
                    if($('.checkb').prop('checked')){
                        $('.hab_deshab').prop('disabled', false);
                    }
                    $('.hab_deshab_clase').prop('disabled', false);
                    $('.checkb').prop('disabled', false);
                });
                
                             //funcion Jquery para habilitar o deshabilitar los checkbox que representan las faltas a ed-fisica y clase
            //de los alumnos dependiendo el tipo y valor de falta que se trae de la base de datos. ademas se modifica
            // dependiendo tambien el tipo y valor de falta el checkbox de habilitar o deshabilitar ed-fisica.
            for(var i=0; i<$('#cant_alumnos').val();i++){
                var clase='#'+(i+1)+'clase_aus';
                var ed_fisica='#'+(i+1)+'ed-f_aus';
                var indice = '#'+(i+1)+'tipo';
                var valor = '#'+(i+1)+'valor';
                switch ($(indice).val()) {
                    case 'clase': {
                        $(clase).prop('checked', true);
                        if($(valor).val()=='1/2'){
                          $('.checkb').prop('checked', true); 
                          hab_des_ef();
                      }
                      else{
                         $('.checkb').prop('checked', false); 
                         hab_des_ef();
                     }

                 }
                 break;
                 case 'edFisica': {
                    $(ed_fisica).prop('checked', true);
                    hab_des_ef();}
                    break;
                    case 'clase+edFisica':{$(clase).prop('checked', true);
                    $(ed_fisica).prop('checked', true);
                    $('.checkb').prop('checked', true);
                    hab_des_ef();
                }
                break;

            }
        }

    });


</script>
</body>

