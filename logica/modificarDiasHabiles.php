<?php
	require_once "../logica/DiasHabiles.php";
	date_default_timezone_set('America/Argentina/Buenos_Aires');

	$dHabil=new DiasHabiles();
	  if (isset($_POST["agregar"])) {
	  	if(!$dHabil->existeDia($_POST["fecha"])){      //compruaba que no se haya cargado previamente.
	  		$estado= $dHabil->guardarFecha($_POST['fecha']);
	  		switch (date('w', strtotime($_POST['fecha']))){ 
                  case 0:
                  		echo "<script>alert('Acaba de agregar un DOMINGO: ".$_POST['fecha']."')</script>";
                   break; 
                  case 6:
                  		echo"<script>alert('Acaba de agregar un SABADO: ".$_POST['fecha']."')</script>";
                   break; 
                   default: 
	  					echo "<script>alert('Se añado correctamente: ".$_POST['fecha']."')</script>";
                    break;
                  }
			}
		}
	 if (isset($_POST["quitar"])) {
	  $estado= $dHabil->eliminarDia($_POST['fecha']);
	  	if ($estado)
	  		echo "<script>alert('Se ha eliminado correctamente la fecha: ".$_POST['fecha']."')</script>";
	}

	print("<script>window.location='../presentacion/administrarDiasHabiles.php';</script>"); 
?>