<?php
require_once "GUIPreceptor.class.php";

if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {

        /**
         * Registrar asistencia
         * @author 
         * @version 1.0
         */
        $gui_preceptor = new GUIPreceptor();
        ?>
            
          <div class="content-wrapper">
         
            <section class="content-header">
              <h1>REGISTRAR ASISTENCIA</h1> 
               <ol class="breadcrumb">
                <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="registrarAsistencia.php">Asistencias</a></li>
                <li class="active">Registrar asistencias</li>
              </ol>
            </section>
            
           
           <section class="content">
              <div class="row">
                <div class="col-xs-12">
                  <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Seleccione un curso</h3>
                    </div>
                    <!-- /.box-header -->
                  <div class="box-body">
              
              

            <body onload="cargar()"> <!--cuando se carga el body se ejecuta el cargar cursos -->


             <div id="aca">
                <!--Lista de cursos  -->
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
                    xmlhttp.open("POST", "../logica/cargarCursosEdF.php", true);
                    xmlhttp.send();
                }
            </script>
         </div>
         </div>
         </div>
         
            </section>

         
        </div>
         
        <?php
        //Agrega el footer comun a todas las secciones
        $gui_preceptor->cargarFooter();

} 
else {
    header('location: ../presentacion/login.php');
}
