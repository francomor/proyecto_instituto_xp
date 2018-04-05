<?php
/**
 * En este archivo, se validan el email y contraseña del usuario.
 * @author Navarro Karen y Piñero Luciana
 * @version 1.0
 */

require_once "../persistencia/conexionBD.php";


if(!empty($_POST)){

	if(isset($_POST["username"]) &&isset($_POST["password"])){

		if($_POST["username"]!=""&&$_POST["password"]!=""){
			$db=conexionBD::getConexion();

			$username=$_POST["username"];
			$password=$_POST["password"];

			
			 
			$consulta="select * from user where usuario='".$username."' and clave='".$password."'";
			$resultado = $db -> recuperarAsociativo($consulta);
			$cantidad=count($resultado);
			$i=0;
			$tipo=$resultado [$i]['tipo'];

			if($tipo==null){

				//print "<div class='alert alert-danger'>  <strong>Error!</strong> Email o contraseña incorrectos.</div>";
				    //window.location='../presentacion/login.php';

				    header('location: ../presentacion/login2.php');
			}

			else{
				session_start();
				$_SESSION["usuario"]=$username;
				$_SESSION["tipo"]=$tipo;
				$_SESSION["clave"]=$password;

				print "<script>window.location='../presentacion/home.php';</script>";

				}
		}
		else
		{
			header('location: ../presentacion/login2.php');
		}
	}
}
?>
