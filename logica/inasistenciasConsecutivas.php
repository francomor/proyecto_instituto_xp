<?php
    require_once "../logica/Alumno.php";
    require_once "../logica/Tutor.php";
    require_once "../logica/Asistencia.php";

    $a = new Asistencia();
    $alumno = new Alumno();
    $tutor = new Tutor();
    $fecha = $_GET['fecha'];
    $dia = date('D', strtotime($fecha));
    switch ($dia) {
        case 'Mon':
            $ant = 3;
            $aAnt = 4;
            break;
        case 'Tue':
            $ant = 1;
            $aAnt = 4;
            break;
        default:
            $ant = 1;
            $aAnt = 2;
            break;
    }
    $par1 = "-".$ant." day";
    $par2 = "-".$aAnt." day";
    $nuevafecha = strtotime($par1, strtotime($fecha));
    $nuevafecha = date('Y-m-j', $nuevafecha);
    $diaA = date('D', strtotime($nuevafecha));
    $nuevafecha2 = strtotime($par2, strtotime($fecha));
    $nuevafecha2 = date('Y-m-j', $nuevafecha2);
    $diaAA = date('D', strtotime($nuevafecha2));
    $res = $a->inasistenciasConsecutivas($nuevafecha2, $nuevafecha, $fecha); //agregue esta funcion a asistencia.php
    foreach ($res as $row) {    
        $a = $alumno->obtenerAlumno($row['alumnoxcurso_alumno_dni']); //agregue esta funcion a alumno.php
        $dniTutor = $a[0]['tutor_dni'];
        $t = $tutor->obtenerTutor($dniTutor);//agregue esta funcion a tutor.php
        $email = $t[0]['email'];

        //mensaje
        $msn = "Prueba de mensaje";
        
        //Titulo
        $titulo = "PRUEBA DE TITULO";
        
        //Enviamos el mensaje al tutor 
        $bool = mail($email,$titulo,$msn);
        if($bool){
            echo "Mensaje enviado";
        }else{
            echo "Mensaje no enviado";
        }
    }
    
    //eliminar cuando ande bien
    echo ("<script> alert ('verificado correctamente') </script>");
    
    //una vez verificadas las inasistencias consecutivas, redireccionar a la pagina de seleccion de cursos
    print("<script>window.location='../presentacion/registrarAsistencia.php';</script>"); 
?>