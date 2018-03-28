
<?php

  //Agrega la interfaz del preceptor comun a todas las secciones
  include_once("GUIPreceptor.class.php");
  $gui_preceptor = new GUIPreceptor();
?>
  <style type="text/css">
    input{
      margin-left: 20px;
      margin-right: 20px;
      margin-top: 20px;
      margin-bottom: 20px;
    }
    button{
      margin-left: 20px;
      margin-right: 20px;
    }
  </style>
  <div class="content-wrapper">
  
    <section class="content-header">
      <h1>
        IMPRIMIR INASISTENCIAS
        <small> </small>
      </h1> 
       <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="formularioListarInasistencias.php">Asistencias</a></li>
        <li class="active">Imprimir Asistencia</li>
      </ol>
    </section>
    
    <section class="content">
      

    <form class="form-horizontal" method="POST" action="../presentacion/listarInasistencias.php" role="form">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Ingrese DNI del alumno</h3>
                <div class="row">
                    <input type="text" class="col-md-5" id="dni" name="dni" size="30" pattern="[0-9]{8}" required>
                </div>
                <div class="row">
                    <button class="btn btn-danger col-md-2" type="submit">Buscar</button>
                </div>
            </div>
          </div>
        </div>
      </div> 
    </form>
    </section> 



  </div>
 

<?php     
  
  //Agrega el footer comun a todas las secciones
  $gui_preceptor->cargarFooter();
?>