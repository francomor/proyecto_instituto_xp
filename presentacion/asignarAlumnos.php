<?php

/**
 *  En este archivo se selecciona un curso al que se le quiere asignar alumnos.
 * @author Piñero Luciana  
 * @version 1.0
 */


//Agrega la interfaz del preceptor comun a todas las secciones
require_once "GUIPreceptor.class.php";

if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {

    $gui_preceptor = new GUIPreceptor();
?>

 <div class="content-wrapper">
 
    <section class="content-header">
      <h1>
        ASIGNAR ALUMNOS A CURSO  
        <small> </small>
      </h1>
        <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Cursos</a></li>
        <li class="active">Seleccionar Curso</li>
      </ol> 
    </section>
     

    <section class="content">   
	   <div class="panel panel-default">
		  <div class="panel-heading">
			<h4>Seleccionar Curso</h4>
		  </div>
		  
            <div class="panel-body">    
                <body onload="cargar()"> <!--cuando se carga el body se ejecuta el cargar cursos -->
                    <div id="aca"><!--Lista de cursos  --></div>
                </body>
            </div>
        </div>   
    </section>

 </div>
  
  <script>
                function cargar() //funcion ajax para traer desde cargar_cursos_ed.f-php todos los cursos de la bdd, para luego cargarlo en el select
                {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("aca").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("POST", "../logica/cargarCursos.php", true);
                    xmlhttp.send();
                }
    </script>

<?php

//Agrega el footer comun a todas las secciones
$gui_preceptor->cargarFooter();

} 
else {
  header('location: ../presentacion/login.php');
}