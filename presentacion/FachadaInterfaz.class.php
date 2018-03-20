<?php 

// PATRON FACHADA

	include("Interfaz.class.php");
	class FachadaInterfaz
	{ 
		public function __construct()
		{
			$fachadaGUI = new Interfaz();
			$fachadaGUI->cargarHeader();
			$fachadaGUI->cargarMenu();
			 

		}
	}
?>