<?php
require_once "../logica/Asistencia.php";
require_once "../logica/Alumno.php";

/**
 * Listar Inasistencias x alumno
 * @author 
 * @version 1.0
 */

//se inicia la sesion para poder mantener los valores que luego se utilizaran para imprimir un PDF
//session_start();
$asistencia = new Asistencia();
$alumno = new Alumno();

  $dni_alumno = $_POST['dniAlumno'];

if(count($alumno->obtenerNombre($dni_alumno)) > 0){
  //fecha1 es fecha desde y fecha2 es fecha hasta
  date_default_timezone_set('America/Argentina/Buenos_Aires');
  $fecha1 = date("Y")."-"."01"."-"."01"; 
  $fecha2 = date("Y")."-".date("m")."-".date("d");


foreach ($alumno->obtenerNombre($dni_alumno) as $fila) {
    $nombreAlumno = $fila['apellido'] . " " . $fila['nombre'];
    //Si el nombre contiene acentos permite hacer visible los caracteres
    if (mb_detect_encoding($nombreAlumno, 'utf-8', true) === false) {
        $nombreAlumno = mb_convert_encoding($nombreAlumno, 'utf-8', 'iso-8859-1');
    } 
}
$resultado = $asistencia->listarInasistencia($fecha1, $fecha2,$dni_alumno);

?>



    <div class="container">
        <div class="panel panel-default" style="margin-top: 10px;">
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="7" style="text-align: center;">Boletin de inasistencias de
                                <?php 
              echo $nombreAlumno; 
              ?>
                            </th>
                        </tr>
                        <tr>
                            <th>Fecha</th>
                            <th>Falto a</th>
                            <th>Falta</th>

                            <th>Total</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
          $acumulado = 0;
          foreach ($resultado as $row) {
              $auxFecha = $row["fecha"];
              $partes = explode('-', $auxFecha);
              $fecha = "{$partes[2]}-{$partes[1]}-{$partes[0]}";
              $faltoA = $row["tipo"];
              if($faltoA == 'clase+edFisica'){
                $faltoA = 'clase y ef';
              }
              if ($row["valor"] == '0.5') {
                  $falta = 0.5;
              } else if ($row["valor"] == '1') {
                  $falta = 1;
              }
              $acumulado = $acumulado + $falta;
              echo "<tr><td>" . $fecha . "</td>";
              echo "<td>" . $faltoA . "</td>";
              echo "<td>" . $row["valor"] . "</td>";
              
              echo "<td>" . $acumulado . "</td>";
              
              echo "</tr>";
          }

          ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    </body>

    </html>
    <?php
    }
    else{
        ?>
        <div class="container">
            <div class='alert alert-danger'>
                Alumno inexistente. Intente nuevamente.
            </div>
        </div>
        <?php
    }