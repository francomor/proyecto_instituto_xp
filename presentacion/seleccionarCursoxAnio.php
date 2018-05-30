<?php
require_once "GUIPreceptor.class.php";

if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {

/**
 * Seleccionar curso
 * @author 
 * @version 1.0
 */
$gui_preceptor = new GUIPreceptor();

?>
          
<<<<<<< HEAD
        <div class="content-wrapper">
       
          <section class="content-header">
            <h1>
              VER INASISTENCIAS  
            </h1> 
             <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
              <li class="active">Seleccionar Curso</li>
            </ol>
          </section>
          
         
       <section class="content">
          <div class="panel panel-default">
            <div class="panel-heading">
                  <h4>Seleccione un curso y un año</h4>
            </div>
            <div class="panel-body">
                    
                  <body onload="cargar()"> <!--cuando se carga el body se ejecuta el cargar cursos -->

                   <div id="aca">
                      <!--Lista de cursos  -->
                   </div>
                  
                  <script>
                      function cargar() //funcion ajax para traer desde cargarCursosEdF-php todos los cursos de la bdd, para luego cargarlo en el select
                      {
                          var xmlhttp = new XMLHttpRequest();
                          xmlhttp.onreadystatechange = function () {
                              if (this.readyState == 4 && this.status == 200) {
                                  document.getElementById("aca").innerHTML = this.responseText;
                              }
                          };
                          xmlhttp.open("GET", "../logica/cargarCursosEdF.php?funcion=verInasistenciasAnio", true);
                          xmlhttp.send();
                      }
                  </script>
            </div>
          </div>

      </section>

       
      </div>
       
      <?php
      //Agrega el footer comun a todas las secciones
      $gui_preceptor->cargarFooter();
=======
<div class="content-wrapper">

  <section class="content-header">
    <h1>
      VER INASISTENCIAS  
      <small> </small>
    </h1> 
     <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Seleccionar Curso</li>
    </ol>
  </section>
  
 
 <section class="content">          
   <div class="panel panel-default">
    <div class="panel-heading">
    <h4>Seleccione un curso y un año</h4>
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
  function cargar() //funcion ajax para traer desde cargarCursosEdF-php todos los cursos de la bdd, para luego cargarlo en el select
  {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
              document.getElementById("aca").innerHTML = this.responseText;
          }
      };
      xmlhttp.open("GET", "../logica/cargarCursosEdF.php?funcion=verInasistenciasAnio", true);
      xmlhttp.send();
  }
  function control(){
      var curso = document.getElementById('selCurso');
        var anio = document.getElementById('selAnio');
        if(anio.value=='seleccionar...' || curso.value=='seleccionar...'){
          alert("Debe seleccionar una opción.");
        }
        else{
          document.getElementById('formuVerInasistencias').submit();
        }
  }
</script>
<?php
//Agrega el footer comun a todas las secciones
$gui_preceptor->cargarFooter();
>>>>>>> 0909144c74ec7d7ea3b02a6fec3afce4af15f8db

} 
else {
header('location: ../presentacion/login.php');
}