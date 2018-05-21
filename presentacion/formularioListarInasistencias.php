<?php
require_once "GUIPreceptor.class.php";

if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {

    //Agrega la interfaz del preceptor comun a todas las secciones
    /**
     * Formulario listar inasistencias
     * @author
     * @version 1.0
     */
    $gui_preceptor = new GUIPreceptor();
    ?>
          <div class="content-wrapper">

            <section class="content-header">
              <h1>BUSCAR INASISTENCIAS POR DNI</h1>
               <ol class="breadcrumb">
                <li><a href="home.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li class="active">Buscar alumno</li>
              </ol>
            </section>

            <section class="content">


              <form class="form-horizontal" method="POST" action="../presentacion/listarInasistencias.php" role="form">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Ingrese DNI del alumno</h3>
                  </div>
                  <div class="form-inline" style="padding: 0 15px 15px;">
                    <label style="margin: 5px 10px" for="dni">DNI</label>
                    <input type="text" style="width: 200px; margin: 5px 3pxx" class="form-control" id="dni" name="dni" size="30" pattern="[0-9]{8}" required>
                    <button class="btn btn-danger" style="margin: 5px 3px" type="submit">Buscar</button>
                  </div>
                </div>
              </form>
            </section>

          </div>


        <?php
//Agrega el footer comun a todas las secciones
    $gui_preceptor->cargarFooter();

} else {
    header('location: ../presentacion/login.php');
}
