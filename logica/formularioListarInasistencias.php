<!DOCTYPE html>
<html lang="en">
  
  <head>

 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Armar Boletín</title>


     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>

 <body>
 	<div class="panel-body">
		<div id="contenedor" class="container">
        <div class="row justify-content-md-center">
			     <form class="form-horizontal" method="POST" action="../presentacion/listarInasistencias.php" role="form">
      				<div class="form-group row">
                <div class="row">
                    <label for="dni_alumno" class="col-md-5 control-label" style="text-align: center">DNI del alumno</label>
                </div>
                <div class="row">
            		    <input type="text" class="col-md-5" id="dni" name="dni">
                </div>
                <div class="row">
            		    <button class="btn btn-primary col-md-2" type="submit">Buscar</button>
                </div>
            	</div>
    			 </form>
          </div>       
        </div>
     </div>
 </body>

      <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
      <script src="js/bootstrap.js"></script>
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
 </html>