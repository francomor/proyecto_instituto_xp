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
    <p class="login-box-msg">Bienvenido! Ingrese email y contraseña</p>

    <form action="../logica/validarUsuario.php" method="post" name="login">
    
      <div class="form-group has-feedback">
        <input type="email" class="form-control" id="username" name="username" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
             
          </div>
        </div>
        <div class="col-xs-12">
          <button type="submit" class="btn btn-danger btn-primary btn-block btn-flat" >Ingresar</button>
        </div>
         
      </div>
    </form>
 
 
  </div>
   
</div>
 

<script src="recursos/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="recursos/bootstrap/js/bootstrap.min.js"></script>

<script src="recursos/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>