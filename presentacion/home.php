<?php
require_once "GUIPreceptor.class.php";
session_start();

if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {

	$gui_preceptor = new GUIPreceptor();
	$gui_preceptor->cargarContenido();
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