<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Instituto Nuestra Señora | Sistema de Inasistencias</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- links -->
  <link rel="stylesheet" href="../recursos/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../recursos/dist/css/Style.min.css">
  <link rel="icon" type="image/png" sizes="192x192"  href="../recursos/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../recursos/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="../recursos/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../recursos/favicon/favicon-16x16.png">

</head>

<body class="hold-transition login-page" style="background-color: #ffffff;">

  <div class="login-box" style="text-align: center">
    <div class="login-logo">
      <span class="logo-mini">
        <img src="../recursos/imagenes/logo_index.jpg" alt="Logo del Instituto"> </span>
    </div>

    <div class="login-box-body" style="background-color: #F3EDED; margin-bottom: 20px">
      <p class="login-box-msg">¡Bienvenido! Ingrese usuario y contraseña</p>

      <form name="login">

        <div class="form-group has-feedback">
          <input type="text" class="form-control" id="username" name="username" placeholder="Usuario">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" autocomplete="off">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <!-- <div class="col-xs-8">
          <div class="checkbox icheck">
             
          </div>
        </div> -->
          <div class="col-xs-12">
            <button type="button" id="enviar" class="btn btn-primary btn-block btn-flat">Ingresar</button>
          </div>


        </div>

      </form>
    </div>
    <div id="loginAjax">
    </div>

    <a href="interfazTutor.php" id="tutor" >Visualizar como tutor</a>
    

    <script src="../recursos/jquery-ajax.min.js">
      //script para traer la libreria de Jquery
    </script>
    <script>
      $(document).ready(function () {
        $('#enviar').click(function () {
          var parametros = {
            "username": $('#username').val(),
            "password": $("#password").val()
          };
          $.ajax({
            data: parametros,
            type: "post",
            url: "../logica/validarUsuario.php",
            datatype: "html",
            success: function (respuesta) {
                if(respuesta.includes("window")){
                  eval(respuesta);
                }
                else{
                  $('#loginAjax').html(respuesta);
                }
            },
            error : function(xhr, status) {
                $('#loginAjax').html('Disculpe, existió un problema');
            },
          });
        });
        $('#tutor').click(function () {
          window.location.replace("../presentacion/interfazTutor.php");
        });
        $(document).keydown(function (e) {
          if (e.keyCode == 13) {
            var parametros = {
              "username": $('#username').val(),
              "password": $("#password").val()
            };
            $.ajax({
              data: parametros,
              type: "post",
              url: "../logica/validarUsuario.php",
              datatype: "html",
              success: function (respuesta) {
                  if(respuesta.includes("window")){
                  eval(respuesta);
                }
                else{
                  $('#loginAjax').html(respuesta);
                }
              },
            });
          }
        });
      });
    </script>

</body>

</html>