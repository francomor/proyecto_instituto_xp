<?php
include_once("../presentacion/modalModificarComoNuevoTutor.php");
include_once("../presentacion/modalModificarSoloDni.php");
?>

<div class="modal" tabindex="-1" role="dialog" id="modalconfirm">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modificar DNI tutor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Seleccione una de las acciones a realizar.</p>
      </div>
      <div class="modal-footer">
       <!-- <button type="button" class="btn btn-danger"  id="nuevotut"  data-dismiss="modal" data-toggle="modal" data-target="#modComoNuevoTutor">
          Modificar como nuevo tutor
      </button>-->
      <button type="button" class="btn btn-danger"  id="nuevotut" >
          Modificar como nuevo tutor
      </button>
        <button type="button" class="btn btn-danger"  id="solodni" >
          Cambiar solo DNI
      </button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
  <input hidden type="text" id="dniAlumnoMod">
  <input hidden type="text" id="dniTutorMod">
  <input hidden type="text" id="nomTutorMod">
  <input hidden type="text" id="apeTutorMod">
  <input hidden type="text" id="telTutorMod">
  <input hidden type="text" id="emailTutorMod">
</div>

<script>
    $("[id='solodni']").click(function() {
    
    var dniAlumno =  $('#dniAlumnoMod').val();
    var dniTutor =  $('#dniTutorMod').val();
    var apeTutor =  $('#apeTutorMod').val();
    var nomTutor =  $('#nomTutorMod').val();
    var telTutor =  $('#telTutorMod').val();
    var emailTutor = $('#emailTutorMod').val();


    jQuery.noConflict(); 
    $('#modalconfirm').hide();

    $('#dniAlumnoModif').val(dniAlumno);
    $('#apeTutorModif').val(apeTutor);
    $('#nomTutorModif').val(nomTutor);
    $('#telTutorModif').val(telTutor);
    $('#emailTutorModif').val(emailTutor);

    $('#modSoloDni').modal();

});

$("[id='nuevotut']").click(function() {
    
    var dniAlumno =  $('#dniAlumnoMod').val();
    var dniTutor =  $('#dniTutorMod').val();
    var apeTutor =  $('#apeTutorMod').val();
    var nomTutor =  $('#nomTutorMod').val();
    var telTutor =  $('#telTutorMod').val();
    var emailTutor = $('#emailTutorMod').val();


    jQuery.noConflict(); 
    $('#modalconfirm').hide();

    $('#dniAlumnoModif').val(dniAlumno);

    $('#modComoNuevoTutor').modal();

});

</script>