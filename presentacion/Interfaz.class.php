<?php 
	
	/*
	* Clase que se encarga de crear una que sea comun para las distintas secciones
	del sitio correspondientes a un preceptor, con el objetivo de mantener uniforme 
	el diseño del sitio web.
	*/
	class Interfaz
	{ 
		public function __construct() {
			
		}
		public static function cargarHeader(){
			include("header.php");
		}

		public static function cargarMenu(){
			
				include("menuPreceptor.php");
		}

		

		 
	}
?>