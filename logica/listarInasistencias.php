<?php
include_once("clases.php");
$asistencia= new Asistencia();
$dni_alumno=$_POST["dni"];
$resultado=$asistencia -> listar_inasistencia($dni_alumno);
?>
<html>
  <body>
  <h3>  Boletin de inasistencias</h3> <hr>
            
      <div class="container">    
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Fecha</th><td></td>
              <th>Falto a</th><td></td>
              <th>Falta</th><td></td>
              <th>Causas de inasistencia</th><td></td>
              <th>Firma</th><td></td><td></td>
              <th>Total</th><td></td>
            </tr>
          </thead>
          <tbody>
<?php
  $acumulado=0; 
  foreach($resultado as $row)
  {
    $fecha=$row["fecha"];
    $faltoA=$row["tipo"];
    $falta=$row["valor"];
    $acumulado=$acumulado+$falta;
    echo "<tr><td>".$fecha."<td>";
    echo "<td>".$faltoA."<td>";
    echo "<td>".$falta."<td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td>".$acumulado."<td>";
    echo "<tr>";
  }
?>           
          </tbody>
        </table>
      </div>
  </body>
 </html>