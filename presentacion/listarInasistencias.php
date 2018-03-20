
<?php
include_once("../logica/clases.php");
$asistencia= new Asistencia();
$alumno= new Alumno();
$dni_alumno=$_POST["dni"];
foreach ($alumno->obtener_nombre($dni_alumno) as $fila) {
  $nombre_alumno=$fila['apellido']." ".$fila['nombre'];

}

$resultado=$asistencia -> listar_inasistencia($dni_alumno);
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Armar Boletín</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  </head>
  <body>
      <br>
      
      <div class="container">
        <div id="contenidoPDF" display="none"></div> 
        <table class="table table-bordered">
          <thead>
            <tr>
              <th colspan="7" style="text-align: center;">Boletin de inasistencias de <?php echo $nombre_alumno;?></th>
            </tr>
            <tr>
              <th>Fecha</th>
              <th>Falto a</th>
              <th>Falta</th>
              <th>Causas de inasistencia</th>
              <th>Firma</th>
              <th>Total</th>
              <th>V°B°</th>
            </tr>
          </thead>
          <tbody>
<?php
  $acumulado=0; 
  foreach($resultado as $row)
  {
    $auxFecha=$row["fecha"];
    $partes=explode('-',$auxFecha);
    $fecha="{$partes[2]}-{$partes[1]}-{$partes[0]}";

    $faltoA=$row["tipo"];
    if($row["valor"]=='1/2'){
      $falta=0.5;
    }
    else if($row["valor"]=='1'){
      $falta=1;
    }
    $acumulado=$acumulado+$falta;
    echo "<tr><td>".$fecha."</td>";
    echo "<td>".$faltoA."</td>";
    echo "<td>".$row["valor"]."</td>";
    echo "<td></td> <td></td>";
    echo "<td>".$acumulado."</td>";
    echo "<td> </td>";
    echo "<tr>";
    echo"</body>";
  }
?>           
          </tbody>
        </table>
    <div id="fincontenidoPDF"></div>
        
    <div class="col align-self-end">
      <form class="form-horizontal" method="POST" action="generarpdf.php">
         <button class="btn btn-primary" type="submit" name="generarPDF">Imprimir</button>
      </form>
    </div>



      </div>
  </body>
 </html>