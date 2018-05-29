<?php

/**
 *  En este archivo se selecciona un curso al que se le quiere asignar alumnos.
 * @author Piñero Luciana  
 * @version 1.0
 */



require_once "GUIPreceptor.class.php";
require_once "../logica/Curso.php";
require_once "../logica/Alumno.php";
require_once "../logica/Tutor.php";
require_once "../logica/Preceptor.php";
 



//Agrega la interfaz del preceptor comun a todas las secciones


if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {

    $gui_preceptor = new GUIPreceptor();
?>


   <div class="content-wrapper">
 
    <section class="content-header">
      <h1>
        CURSOS -  AÑO     <?php date_default_timezone_set('America/Argentina/Buenos_Aires');  echo date('Y')?>
      </h1> 
    </section>
    
    <section class="content">

      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua">1° I</span>

            <div class="info-box-content">
              <span class="info-box-text">ALUMNOS</span>
              <span class="info-box-number">#</span>
            <a href="#" class="card-link"> VER </a>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua">1° II </span>

            <div class="info-box-content">
              <span class="info-box-text">ALUMNOS</span>
              <span class="info-box-number">#</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
             <span class="info-box-icon bg-yellow">4° E</i></span>
            <div class="info-box-content">
              <span class="info-box-number">ECONOMICO</span>
              <span class="info-box-text">ALUMNOS</span>
              <span class="info-box-number"> #</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow">4° B</i></span>
            <div class="info-box-content">
              <span class="info-box-number">BIOLOGICO</span>
              <span class="info-box-text">ALUMNOS</span>
              <span class="info-box-number"> #</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- =========================================================== -->

      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-light-blue">2° I</span>

            <div class="info-box-content">
              <span class="info-box-text">ALUMNOS</span>
              <span class="info-box-number">#</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-light-blue">2° II</span>

            <div class="info-box-content">
              <span class="info-box-text">ALUMNOS</span>
              <span class="info-box-number">#</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-orange">5° E</i></span>
            <div class="info-box-content">
              <span class="info-box-number">ECONOMICO</span>
              <span class="info-box-text">ALUMNOS</span>
              <span class="info-box-number"> #</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
             <span class="info-box-icon bg-orange">5° B</i></span>
            <div class="info-box-content">
              <span class="info-box-number">BIOLOGICO</span>
              <span class="info-box-text">ALUMNOS</span>
              <span class="info-box-number"> #</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- =========================================================== -->

      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue">3° I </i></span>
            <div class="info-box-content"> 
              <span class="info-box-text">ALUMNOS</span>
              <span class="info-box-number"># </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue">3° II </i></span>
            <div class="info-box-content"> 
              <span class="info-box-text">ALUMNOS</span>
              <span class="info-box-number">#</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red">6° E</i></span>
            <div class="info-box-content">
              <span class="info-box-number">ECONOMICO</span>
              <span class="info-box-text">ALUMNOS</span>
              <span class="info-box-number"> #</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
             <span class="info-box-icon bg-red">6° B</i></span>
            <div class="info-box-content">
              <span class="info-box-number">BIOLOGICO</span>
              <span class="info-box-text">ALUMNOS</span>
              <span class="info-box-number"> #</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>


  </div>
 <?php

//Agrega el footer comun a todas las secciones
$gui_preceptor->cargarFooter();

} 
else {
  header('location: ../presentacion/login.php');
}