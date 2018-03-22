<?php  
	
	include("FachadaInterfaz.class.php");
	
	/*
	* Clase encargada de crear la interfaz principal correspondiente al preceptor,
	con sus respectivas funcionalidades, haciendo llamadas a los metodos correspondientes
	*/
	class GUIPreceptor{

		public function __construct(){
		 	$fachada= new FachadaInterfaz();
		}	

		public function mostrarCursos(){
			include("../presentacion/contenido.php");
		}

		
		public static function cargarContenido(){
			include("../presentacion/contenido.php");
		}

		public static function registrarAsistencia(){
			include("../presentacion/cursos.php");
		}

		public static function cargarFooter(){
			include("footer.php");
		}
	}

?>	