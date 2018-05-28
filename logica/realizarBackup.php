<?php
include ("funcionBackup.php");

function realizarBackup()
{
	 date_default_timezone_set('America/Argentina/Buenos_Aires');
	 $fecha=date("Y-m-d");
	 $archivo = fopen('fechaProxBackup.txt','r');
	 $diaDeBackup= fread($archivo,10);

	   fclose($archivo);
	   if($diaDeBackup <= $fecha){

		backup_tables("localhost","id5685006_institutonuestrasenora","proyectoinstituto","id5685006_instituto","user,preceptor,curso,tutor,alumno,alumnoxcurso,asistencia");
	   		$nuevafecha= strtotime('+7 day', strtotime($fecha));
	   		$nuevafecha= date("Y-m-d",$nuevafecha);
	   		$archivo= fopen('fechaProxBackup.txt','w');
	   		fwrite($archivo,$nuevafecha);
	   		fclose($archivo);
	   		//echo "<script>alert('ENVIADO');</script>";	
	   }

}

