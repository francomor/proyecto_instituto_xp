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

  <div class="login-box" style="text-align: center">
    <div class="login-logo">
      <span class="logo-mini">
        <img src="../recursos/imagenes/logo_index.jpeg"> </span>
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
    <script src="recursos/bootstrap/js/bootstrap.min.js"></script>
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
                if (respuesta == "home ") {
                  window.location.replace("../presentacion/home.php");
                } else {
                  $('#loginAjax').html(respuesta);
                }
              }
            });
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
                  if (respuesta == "home ") {
                    window.location.replace("../presentacion/home.php");
                  } else {
                    $('#loginAjax').html(respuesta);
                  }
                }
              });
            }
          });
      });
    </script>

</body>

</html>