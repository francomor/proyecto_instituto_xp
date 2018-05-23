<?php
require_once "../logica/DiasHabiles.php";
require_once "GUIPreceptor.class.php";
/**
 * En este archivo,
 * @author Nicolases
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
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="registrarAsistencia.php">Asistencias</a></li>
      <li class="active">Registrar asistencias</li>
    </ol> 
  </section>
<div style="text-align: center; background-color: cyan;"> Los dias habiles se cargan automáticamente al cargar una inasistencia, solo agregue en caso de anomalía, o elimine en casos de errores.</div>

 <form action="../logica/modificarDiasHabiles.php" method="post" id="formularioDH">
	<table class="table table-bordered table-hover" border="1"> 
              <?php
                $dhabiles=new DiasHabiles();
                $dias=$dhabiles->recuperarOrdenado();
                $cantfilas = count($dias);
                $fActual= date("Y")."-".date("m")."-".date("d");
              ?>

 	        <?php
          for ($i = 0; $i < $cantfilas; $i++) {
                    //se hace de manera dinamica la carga de los dias a la tabla, con sus respectivos 
                    //checkbox donde un checkbox marcado es un día habil.
          ?>
            <tr>
              <td width="20%">
                <?php
                switch (date('w', strtotime($dias[$i]['fecha']))){ 
                  case 0: echo "Domingo"; break; 
                  case 1: echo "Lunes"; break; 
                  case 2: echo "Martes"; break; 
                  case 3: echo "Miercoles"; break; 
                  case 4: echo "Jueves"; break; 
                  case 5: echo "Viernes"; break; 
                  case 6: echo "Sabado"; break; 
                  } 
                ?>
              </td>
              <td width="75%"> 
              <?php
              $auxFecha=$dias[$i]['fecha'];
              $partes = explode('-', $auxFecha);                      //Es mas legible si damos vuelta la fecha
              $fecha = "{$partes[2]}-{$partes[1]}-{$partes[0]}";
              echo "{$partes[2]}-{$partes[1]}-{$partes[0]}";
              ?> </td>   <!-- se muestra el dia habil -->
           </tr>

           <?php
                }//cierre del for
                ?>
    </table>
    <table">
          <tr>
            <td colspan="2">
              <input name="fecha" id="fecha" type="date" value="<?php echo date('Y-m-d', strtotime($fActual)) ?>"  required>
            </td>
           <td colspan="2">
            <input type="submit" class="btn btn-primary" value="Agregar" name="agregar" id="agregar">
           </td>
             <td colspan="2">
            <input type="submit" class="btn btn-primary" value="Quitar" name="quitar" id="quitar" onclick="quitarMarcados()">
           </td>
           </tr>
    </table>
	</form>
</div>


<?php
//Agrega el footer comun a todas las secciones
$gui_preceptor->cargarFooter();
?>	
