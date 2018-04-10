<?php
require_once "GUIPreceptor.class.php";
session_start();

if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {

      /**
       * Seleccionar curso
       * @author 
       * @version 1.0
       */
      $gui_preceptor = new GUIPreceptor();

      ?>
          
        <div class="content-wrapper">
       
          <section class="content-header">
            <h1>
              IMPRESION DE BOLETINES
              <small> </small>
            </h1> 
             <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="registrarAsistencia.php">Asistencias</a></li>
              <li class="active">Seleccionar Curso</li>
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
              function cargar() //funcion ajax para traer desde cargarCursosEdF-php todos los cursos de la bdd, para luego cargarlo en el select
              {
                  var xmlhttp = new XMLHttpRequest();
                  xmlhttp.onreadystatechange = function () {
                      if (this.readyState == 4 && this.status == 200) {
                          document.getElementById("aca").innerHTML = this.responseText;
                      }
                  };
                  xmlhttp.open("GET", "../logica/cargarCursosEdF.php?funcion=imprimirCurso", true);
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
  ?>
  <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistema | Web</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- links -->
  <link rel="stylesheet" href="../recursos/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../recursos/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <link rel="stylesheet" href="../recursos/dist/css/Style.min.css">
  <link rel="stylesheet" href="../recursos/dist/css/skins/_all-skins.min.css">

</head>
<body class="hold-transition login-page" style="background-color: #ffffff;">
<div class="login-box">
  <div class="login-logo">
      <span class="logo-mini" >   <img src="../recursos/imagenes/logo_index.jpeg" > </span>
  </div>
 
  <div class="login-box-body" style="background-color: #F3EDED;" >
    <p class="login-box-msg">Esta página es solo para usuarios registrados</p>

    <form action="../presentacion/login.php" method="post" name="login">
    
      <div class="form-group has-feedback">
          <div class="row">
            <button type="submit" class="btn btn-danger btn-primary btn-block btn-flat" >Iniciar Sesión</button>
          </div>
           
      </div>
    </form>
 
 
  </div>
   
</div>
 

<script src="recursos/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="recursos/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
<?php
  }
?>

