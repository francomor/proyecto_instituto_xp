<?php
require_once "GUIPreceptor.class.php";
require_once "../logica/Curso.php";
require_once "../logica/Alumno.php";
require_once "../logica/Tutor.php";
require_once "../logica/Preceptor.php";
if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {


                $curso = new Curso();
                $alumno=new Alumno();
                $tutor=new Tutor();
                $preceptor=new Preceptor();
                $registros = $curso->cantRegistros();
                $alumnos=$alumno->cantRegistros();
                $tutores=$tutor->cantRegistros();
                $preceptores=$preceptor->cantRegistros();
            ?>

   <div class="content-wrapper">
 
    <section class="content-header">
      <h1>
        PANEL PRINCIPAL
      </h1> 
    </section>
    
    <section class="content">
     

       <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="glyphicon glyphicon-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Alumnos</span>
              <span class="info-box-number"><?php printf($alumnos); ?> </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Preceptores</span>
              <span class="info-box-number"><?php printf($preceptores); ?> </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-user"></i></span>


            <div class="info-box-content">
              <span class="info-box-text">Cursos</span>
              <span class="info-box-number"><?php printf($registros); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="glyphicon glyphicon-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Tutores</span>
              <span class="info-box-number"><?php printf($tutores); ?> </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

         




    </section>
  </div>
 
  <?php
} 
else {
  header('location: ../presentacion/login.php');
}