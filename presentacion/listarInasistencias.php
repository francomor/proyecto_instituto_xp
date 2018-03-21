
<?php
include_once("../logica/clases.php");

session_start();


$asistencia= new Asistencia();
$alumno= new Alumno();
      if ($_SESSION['dni_alumno']==''){
       $_SESSION['dni_alumno']=$_POST["dni"];
       $dni_alumno=$_SESSION['dni_alumno'];
      }else{
        $dni_alumno=$_SESSION['dni_alumno'];
      }
foreach ($alumno->obtener_nombre($dni_alumno) as $fila) {
  $nombre_alumno=$fila['apellido']." ".$fila['nombre'];

}

$resultado=$asistencia -> listar_inasistencia($dni_alumno);
?>

<?php       
    include_once("GUIPreceptor.class.php");
    $gui_preceptor = new GUIPreceptor();
    
?>
  
  <div class="content-wrapper">
 
    <section class="content-header">
      <h1>
       <!-- Armar Boletin -->
        <small> </small>
      </h1> 
       <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Asistencias</a></li>
        <li class="active">Imprimir Asistencia</li>
      </ol>
    </section>
  
    <!-- <title>Armar Boletín</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    -->
  

      
      
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
    echo "<td id='justificar' ></td> <td id='firma'></td>";
    echo "<td>".$acumulado."</td>";
    echo "<td> </td>";
    echo "</tr>";
    
  }
?>           
          </tbody>
        </table>
    <div id="fincontenidoPDF"></div>
        
    <div class="col align-self-end">
      <form class="form-horizontal" method="POST" action="../logica/generarPdfInasistencias.php">
         <button class="btn btn-primary" type="submit" name="generarPDF">Imprimir</button>
      </form>
    </div>



      </div>

  </div>

<?php     
 
  $gui_preceptor->cargarFooter();
?>