<?php
require_once "GUIPreceptor.class.php";
require_once "../logica/Asistencia.php";
require_once "../logica/Alumno.php";
if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {


/**
 * Listar Inasistencias
 * @author 
 * @version 1.0
 */

//se inicia la sesion para poder mantener los valores que luego se utilizaran para imprimir un PDF
//session_start();
$asistencia = new Asistencia();
$alumno = new Alumno();
/*
if (!isset($_SESSION['dni_alumno']) && isset($_POST['dni'])) {
    //if (!isset($_SESSION['dni_alumno'])){
    $_SESSION['dni_alumno'] = $_POST["dni"];
}
if (isset($_POST['dni']) && ($_SESSION['dni_alumno'] != $_POST['dni'])) {
    $_SESSION['dni_alumno'] = $_POST['dni'];
}
if (!isset($_POST['dni']) && isset($_SESSION['dni_alumno'])) {
    $_POST['dni'] = $_SESSION['dni_alumno'];
}
if (isset($_GET['dni'])) {
    $_SESSION['dni_alumno'] = $_GET['dni'];
    $_POST['dni'] = $_GET['dni'];
}*/

if(isset($_POST['dni'])){
  $dni_alumno = $_POST['dni'];
  $fecha1 = $_POST['fechadesde'];
  $fecha2 = $_POST['fechahasta'];
 
}
//$dni_alumno = $_POST['dni'];
foreach ($alumno->obtenerNombre($dni_alumno) as $fila) {
    $nombreAlumno = $fila['apellido'] . " " . $fila['nombre'];
    //Si el nombre contiene acentos permite hacer visible los caracteres
    if (mb_detect_encoding($nombreAlumno, 'utf-8', true) === false) {
        $nombreAlumno = mb_convert_encoding($nombreAlumno, 'utf-8', 'iso-8859-1');
    } 
}
$resultado = $asistencia->listarInasistencia($fecha1, $fecha2,$dni_alumno);

?>

<?php

//Agrega la interfaz del preceptor comun a todas las secciones

$gui_preceptor = new GUIPreceptor();
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      <!-- Armar Boletin -->
      <small></small>
    </h1>
      <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="formularioListarInasistencias.php">Asistencias</a></li>
      <li class="active">Imprimir Asistencia</li>
    </ol>
  </section>

  <!-- <title>Armar Boletín</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  -->
  <div class="box">
    <div class="box-body">
      <div class="container">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th colspan="7" style="text-align: center;">Boletin de inasistencias de <?php 
              echo $nombreAlumno; 
              ?> 
              </th>
            </tr>
            <tr>
              <th>Fecha</th>
              <th>Falto a</th>
              <th>Falta</th>
              <th style='width: 30%;text-align: center;'>Causas de inasistencia</th>
              <th>Firma</th>
              <th>Total</th>
              <th>V°B°</th>
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
              echo "<td id='justificar' ></td> <td id='firma'></td>";
              echo "<td>" . $acumulado . "</td>";
              echo "<td> </td>";
              echo "</tr>";
          }

          ?>
          </tbody>
        </table>
        <?php 
        if($_REQUEST['verInasistencias']==null){
          ?>
            <div class="col align-self-end">
              <form class="form-horizontal" method="POST" action="../logica/generarPdfBoletin.php">
                <button class="btn btn-danger col-md-2" type="submit" name="generarPDF">Imprimir</button>
                <input type="hidden" name="fechadesde" id="fechadesdehiden"value="<?php echo $fecha1; ?>">
                <input type="hidden" name="fechahasta" id="fechahastahiden"value="<?php echo $fecha2; ?>">
                <input type="hidden" name="dni" value="<?php echo $dni_alumno;?>">
              </form>
       
          </div>
        <?php
         }
        ?>
      </div>
    </div>
  </div>  
</div>
</body>
</html>
<?php
//Agrega el footer comun a todas las secciones
$gui_preceptor->cargarFooter();

} 
else {
  header('location: ../presentacion/login.php');
}
