<?php
 /** 
 * Interfaz para que el tutor pueda ver las inasistencias de un alumno
 * @author Francisco Herrero, Franco Morero
 * @version 1.0 
 */
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

    <body class="hold-transition skin-red-light sidebar-mini">
        <div class="wrapper" style="height: auto;">
            <nav class="navbar main-header" style="margin-bottom: 0; background-color: #dd4b39;">
              <a class="navbar-brand logo" href="login.php">
                <b>INS</b> Nuestra Señora
              </a>
            </nav>

            <div class="content-wrapper" style="margin-left: 0px;">
                <div class="container">
                    <div class="panel panel-default" style="margin-top: 10px;">
                        <div class="panel-heading">
                            <h4>
                                <i class='glyphicon glyphicon-search'></i> Visualizar inasistencias</h4>
                        </div>
                        <div class="panel-body">

                            <!-- formulario principal -->
                            <form class="form-horizontal" novalidate>
                                <h4>Ingrese DNI del alumno</h4>
                                <div class="form-inline">
                                    <label style="margin: 5px 3px" for="dniAlumno">DNI</label>
                                    <input style="width: 200px; margin: 5px 3px" type="text" class="form-control" id="dniAlumno" name="dniAlumno" required>
                                    <button style="margin: 5px 3px" class="btn btn-danger" id="botonBuscar">
                                        <span class="glyphicon glyphicon-search"></span> Buscar
                                    </button>
                                </div>
                            </form>
                        </div>

                        
                        <!-- fin formulario principal -->
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="col-md-12">

                    </div>
                </div>
                <div id="panelInasistencias">
                </div>
            </div>

        </div>


        </div>



        <!-- Footer -->

        <footer class="main-footer" style=" margin-left: 0px;">
            <div class="pull-right hidden-xs">
                <b>Sistema de Gestión</b>
            </div>
            <strong>INSTITUTO</strong> Nuestra Señora
        </footer>
        </div>
        <!-- Script -->
        <script src="../recursos/jquery-ajax.min.js"></script>
        <script src="../recursos/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <script src="../recursos/bootstrap/js/bootstrap.min.js"></script>
        <script src="../recursos/plugins/fastclick/fastclick.js"></script>
        <script src="../recursos/dist/js/app.min.js"></script>
        <script src="../recursos/plugins/sparkline/jquery.sparkline.min.js"></script>
        <script src="../recursos/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="../recursos/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="../recursos/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <script src="../recursos/plugins/chartjs/Chart.min.js"></script>

        <script>
            $(document).ready(function () {

                $('#botonBuscar').click(function () {
                    var parametros = {
                        "dniAlumno": $('#dniAlumno').val(),
                    };
                    $.ajax({
                        data: parametros,
                        type: "post",
                        url: "../logica/inasistenciasxAlumno.php",
                        datatype: "html",

                        success: function (respuesta) {

                            $('#panelInasistencias').html(respuesta);

                        }
                    });
                });
                
            });
        </script>
    </body>

    </html>