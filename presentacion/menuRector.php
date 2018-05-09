<?php
require_once "GUIPreceptor.class.php";
if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {
?>
<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu">
      <li class="header">MENU PRINCIPAL</li>
      
      <li class="  treeview">
        <a href="#">
          <i class=" glyphicon glyphicon-align-left"></i> 
          <span>Tutores </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="#">
              <i class="glyphicon glyphicon-th-list"></i> 
              Mostrar Tutores
            </a>
          </li>
          <li class="active">
            <a href="#">
              <i class="glyphicon glyphicon-indent-left"></i> 
              Agregar Tutores 
            </a>
          </li>
        </ul>
      </li>
      <li class="  treeview">
        <a href="#">
          <i class=" glyphicon glyphicon-align-left"></i> 
          <span>Cursos </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="mostrarCursos.php">
              <i class="glyphicon glyphicon-th-list"></i> 
              Mostrar Cursos
            </a>
          </li>
          <li class="active">
            <a href="#">
              <i class="glyphicon glyphicon-indent-left"></i> 
              Agregar Curso 
            </a>
          </li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="ion-person-stalker"></i>
          <span>Alumnos</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="#">
              <i class="ion-person"></i>  
              Mostrar Alumnos
            </a>
          </li>
          <li>
            <a href="#">
              <i class="ion-person-add"></i> 
              Agregar Alumno
            </a>
          </li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i class=" ion-pie-graph"></i>
          <span>Asistencias</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
        <li>
          <a href="registrarAsistencia.php">
            <i class=" glyphicon glyphicon-check"></i> 
            Registrar Asistencias 
          </a>
        </li>
          <li>
            <a href="formularioListarInasistencias.php">
              <i class=" glyphicon glyphicon-search"></i> 
              Buscar Alumno
            </a>
          </li>
          <li>
            <a href="seleccionarCurso.php">
              <i class=" glyphicon glyphicon-print"></i> 
              Imprimir Inasistencias
            </a>
          </li> 
        </ul>
      </li>
      
    </ul>
  </section>
</aside>

<?php
} 
else {
  header('location: ../presentacion/login.php');
}