<!DOCTYPE html>
<html lang="en">
  
  <head>

 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Armar Boletín</title>


     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/estilos.css">
  
   <link rel=icon href='img/icon.png' sizes="32x32" type="image/png">
</head>

 <body>
 	<div class="panel-body">
		<div id="contenedor">

			     <form class="form-horizontal" method="POST" action="listarInasistencias.php" role="form">
			 
      				<div class="form-group row">
            		    <label for="dni_alumno" class="col-md-1 control-label">DNI del alumno</label>
            		    <input type="text" class="form-control input-sm" id="dni" name="dni">
            		    <button class="btn btn-primary" type="submit">Buscar</button>
            	</div>
    			 </form>
      	   <div>
              <div id="boletin">

              </div>
           </div>       
        </div>
     </div>
 </body>

      <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
      <script src="js/bootstrap.js"></script>
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

     <!--<script>
        function listarInasistencias(){
          dni=document.getElementById("dni");
          if(dni==""){
          document.getElementById("boletin").innerHTML="";
          return;
          }
          if (window.XMLHttpRequest) {
              // code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            } else { // code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function() {
              if (this.readyState==4 && this.status==200) {
                document.getElementById("boletin").innerHTML=this.responseText;
              }
            }
            xmlhttp.open("GET","listarInasistencias.php?q="+dni,true);
            xmlhttp.send();
          }
      </script>-->

 </html>