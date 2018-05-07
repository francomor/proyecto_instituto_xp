<?php
    require_once "../logica/Alumno.php";
    require_once "../logica/Tutor.php";
    require_once "../logica/Asistencia.php";
    require_once "../recursos/phpmailer/src/PHPMailer.php";
    require_once "../recursos/phpmailer/src/SMTP.php";
    require_once "../recursos/phpmailer/src/Exception.php";

    $a = new Asistencia();
    $alumno = new Alumno();
    $tutor = new Tutor();
    $fecha = $_GET['fecha'];
    $curso = $_GET['curso'];
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
    $res = $a->inasistenciasConsecutivas($nuevafecha2, $nuevafecha, $fecha,$curso);
    foreach ($res as $row) {    
        $a = $alumno->obtenerAlumno($row['alumnoxcurso_alumno_dni']);
        $dniTutor = $a[0]['tutor_dni'];
        $t = $tutor->obtenerTutor($dniTutor);
        $email = $t[0]['email'];
        //mensaje
        $msn = "Sr/a " . $t[0]['nombre'] . ", se le informa que el/la alumno/a ". $a[0]['nombre'] . " " . $a[0]['apellido'] ." registra 3 faltas consecutivas";
        
        //Titulo
        $titulo = "Notificacion";
        
        //Enviamos el mensaje al tutor 
        $mail = new \PHPMailer\PHPMailer\PHPMailer();
        $mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ));
        //Luego tenemos que iniciar la validación por SMTP:
        $mail->isSMTP();

        $mail->SMTPAuth = true;
        $mail->SMTPSecure ="ssl";

        //Aquí pondremos el SMTP a utilizar. Por ej. mail.midominio.com
        $mail->Host = "smtp.gmail.com";

        //Email de la cuenta de correo.
        $mail->Username = "ins.nuestrasenora755@gmail.com"; 

        //Contraseña de la cuenta de correo
        $mail->Password = "INSins2018"; 

        // Puerto de conexión al servidor de envio.
        $mail->Port = 465;

        // Desde donde enviamos (Para mostrar).
        $mail->From = "ins.nuestrasenora755@gmail.com"; 

        //Nombre a mostrar del remitente. 
        $mail->FromName = "Administrador";

        // Esta es la dirección a donde enviamos 
        $mail->addAddress($email);

        // El correo se envía como HTML 
        $mail->isHTML(true); 

        // Este es el titulo del email. 
        $mail->Subject = $titulo;

        // Mensaje a enviar.
        $mail->Body = $msn; 

        // Envía el correo.
        $exito = $mail->send();
    }
    
    //eliminar cuando ande bien
    //echo ("<script> alert ('verificado correctamente') </script>");
    
    //una vez verificadas las inasistencias consecutivas, redireccionar a la pagina de seleccion de cursos
    print("<script>window.location='../presentacion/registrarAsistencia.php';</script>"); 
?>