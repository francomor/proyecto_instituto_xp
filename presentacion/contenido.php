<?php
/**
 * Archivo contenido
 * @version 2.0
 */
require_once "GUIPreceptor.class.php";
require_once "../logica/Curso.php";
require_once "../logica/AlumnoxCurso.php";
require_once "../logica/Alumno.php";
require_once "../logica/Tutor.php";
require_once "../logica/Preceptor.php";
if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {
              $anioActual= date('Y'); 
              $curso = new Curso();
              $alumno= new Alumno();
              $alumnoxcurso=new AlumnoxCurso();
              $tutor=new Tutor();
              $preceptor=new Preceptor();
              if($_SESSION['tipo']=='rector'){                                        //Vista Rector
                $registros = $curso->cantRegistros();
                $alumnos=$alumno->cantRegistros();
                $tutores=$tutor->cantRegistros();
                $preceptores=$preceptor->cantRegistros();
              }else{                                                                  //Vista preceptores
                $cursosObtenidos=$curso->obtenerCursosxPreceptor($_SESSION['usuario']);       //En primer lugar obtengo los cursos a cargo del preceptor
                $registros=sizeof($cursosObtenidos);
                $alumnos=sizeof($alumnoxcurso->obtenerAlumnoxCurso($cursosObtenidos[0]['idcurso'],$anioActual));  //Siempre será un arreglo de dos posiciones, pues
                $alumnos2=sizeof($alumnoxcurso->obtenerAlumnoxCurso($cursosObtenidos[1]['idcurso'],$anioActual));  // por el dominio, un preceptor tendrá 2 cursos
                $cantTutores=0;
                foreach ($alumnoxcurso->obtenerAlumnoxCurso($cursosObtenidos[0]['idcurso'],$anioActual) as $auxiliar){        //Para cada alumno de un curso
                  $auxTutores=$alumno->obtenerDNITUTOR($auxiliar['dni']);                                                     //verifico si tiene tutores
                  $dniTutor=$auxTutores[0][0];
                  if($dniTutor!=NULL || $dniTutor=='1')                                                                       //Si tiene, incremento el número
                    $cantTutores++;
                }
                foreach ($alumnoxcurso->obtenerAlumnoxCurso($cursosObtenidos[1]['idcurso'],$anioActual) as $auxiliar){        //Lo mismo pero para el otro curso
                  $auxTutores=$alumno->obtenerDNITUTOR($auxiliar['dni']);
                  $dniTutor=$auxTutores[0][0];
                  if($dniTutor!=NULL || $dniTutor=='1')
                    $cantTutores++;
                }
                $tutores=$cantTutores;
              }
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
              <?php            
              /*Si es la vista del rector, aca muestro 'Alumnos' indicando la cantidad de alumnos totales en el sistema. En caso de ser un preceptor, en este campo se ubicará el nombre del primer curso a cargo.*/
              if($_SESSION['tipo']=='rector'){
                $nombreSPAN='Alumnos';
              }else{
                $nombreSPAN= 'Alumnos en '.$cursosObtenidos[0]['anio'] ." ".$cursosObtenidos[0]['nombre'];

              }
              ?>
              <span class="info-box-text"><?php printf($nombreSPAN); ?></span>
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
              <?php            
              /*Si es la vista del rector, aca muestro 'Preceptores' indicando la cantidad de Preceptores totales en el sistema. En caso de la vista de preceptoresm en este caso se presentará la cantidad de alumnos en el segundo curso a cargo.*/
              if($_SESSION['tipo']=='rector'){
                $nombreSPAN='Preceptores';
                $valorSPAN=$preceptores;
              }else{
                $nombreSPAN= 'Alumnos en '.$cursosObtenidos[1]['anio'] ." ".$cursosObtenidos[1]['nombre'];
                $valorSPAN=$alumnos2;
              }
              ?>
              <span class="info-box-text"><?php printf($nombreSPAN);?></span>
              <span class="info-box-number"><?php printf($valorSPAN) ?> </span>
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