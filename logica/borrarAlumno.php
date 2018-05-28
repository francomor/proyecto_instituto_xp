<?php
/**
* Este archivo se ejecuta por la llamada ajax del archivo "mostrarAlumno.php" mediante el boton eliminar.
* Borra de la base de datos el alumno relacionado al boton eliminar. devuelve una tabla similar a la de mostrar alumnos
* pero sin el alumno eliminado.
 * @author Herrero Francisco Piñero Luciana
 * @version 1.0
 */
include_once("../logica/Alumno.php");
include_once("../logica/Tutor.php");
include_once("../logica/AlumnoxCurso.php");
$dni = (int)$_POST['dni'];
$curso = $_POST['curso'];
$a = new Alumno();
$t = new Tutor();
$alumno=$a->obtenerAlumno($dni);


$a->eliminarAlumno($dni);
$cant=$a->cantidadAlumnosRelacionadosATutor((int)$alumno[0]['tutor_dni']);



if($cant==0){
  $t->eliminarTutor((int)$alumno[0]['tutor_dni']);
  //mensaje: se borra el alumno y el tutor relacionado 
}
else{
  //mensaje: el alumno fue borrado.
}

?>
<body>
<div id='editar'>
            <table class="table table-bordered table-hover" border="1" width="100%">

                  <thead>
                 <tr>
                    <th scope="col">#</th>
                    <th scope="col">Apellido y Nombre</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                 </tr>

               </thead>
   
                <?php
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $a=new AlumnoxCurso();
                $alumnos=$a->obtenerAlumnoxCurso($curso,date('Y'));  

                for ($i = 0; $i < count($alumnos); $i++) {
                    ?>
                    <tr>
                        <td><?php echo $i + 1 ?></td> <!-- se muestra el numero del alumno en la tabla -->
                        <td><?php 
                        $dniAlu=$alumnos[$i]['dni'];
                        $nombreAlumno=$alumnos[$i]["apellido"] . ", " . $alumnos[$i]["nombre"];
                        if (mb_detect_encoding($nombreAlumno, 'utf-8', true) === false) {
                        $nombreAlumno = mb_convert_encoding($nombreAlumno, 'utf-8', 'iso-8859-1');
                        } 
                        echo $nombreAlumno; ?> </td> 
                        <td>

                            <input  class="btn btn-danger" name="botonEditar" id="<?php echo $alumnos[$i]['dni'];?>" value="Editar" >
 
                        </td>
                         <td>
                        
                            <input  class="btn btn-danger" name="botonEliminar" id="<?php echo $alumnos[$i]['dni'];?>" value="Eliminar" >


    
                            <input hidden type="text" name="dniAlu" id="dniAlu">
                            <input hidden type="text" name="curso" id="curso" value="<?php echo $curso;?>" >
                        </td>
                    </tr>


                    <?php
                   
                }//cierre del for
                ?>

            </table>
</div>



<script src="../recursos/jquery-ajax.min.js">
            //script para traer la libreria de Jquery
</script>
<script>

  $(document).ready(function() {

 /*$("[name='botonEliminar']").on('click', function(){
    var codigo = $(this).attr('id');
    $("[id='dniAlu']").val(codigo);
 
  });

    $("[name='botonEditar']").on('click', function(){
    var codigo = $(this).attr('id');
    $("[id='dniAlu']").val(codigo);
 
  });*/
$("[name='botonEliminar']").on('click', function(){
	var opcion = confirm("¿Está seguro que quiere borrar?");

    if (opcion == true) {
        var parametros = {
                    "dni" : $(this).attr('id'),
                    "curso" : $("[id='curso']").val()
                  };
                  $.ajax({
                   data: parametros,
                   type: "post",
                   url: "../logica/borrarAlumno.php",
                   datatype: "html",

                   success: function(respuesta)
                   {   
                     $("[id='formu']").html(respuesta);
                   }
                 });

	}
}); 
  $("[name='botonEditar']").on('click', function(){
  var parametros = {
                    "dni" : $(this).attr('id'),
                  };
                  $.ajax({
                   data: parametros,
                   type: "post",
                   url: "../presentacion/editarAlumno.php",
                   datatype: "html",

                   success: function(respuesta)
                   {   
                     $("[id='editar']").html(respuesta);
                   }
                 }); 


});
});

</script>
</body>