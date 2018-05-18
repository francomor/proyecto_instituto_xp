<?php
    require_once "../logica/Alumno.php";
    require_once "../logica/Tutor.php";
    require_once "../logica/Asistencia.php";
    require_once "../recursos/phpmailer/src/PHPMailer.php";
    require_once "../recursos/phpmailer/src/SMTP.php";
    require_once "../recursos/phpmailer/src/Exception.php";
    require_once "../logica/DiasHabiles.php";
    /**
 * Este archivo registra inasistencias consecutivas, y manda mail a los tutores
 * @author Dechecchi Nicolás, Martin Rodrigo
 * @version 1.0
 */
    /**
 * Se completó la idea en otra iteración.
 * @author Dechecchi Nicolás, Silvera Nicolás
 * @version 1.1
 */
    $a = new Asistencia();
    $alumno = new Alumno();
    $tutor = new Tutor();
    $dhabiles=new DiasHabiles();
    $fecha = $_GET['fecha'];
    $fechaActual = date("Y")."-".date("m")."-".date("d"); // obtenermos la fecha de hoy y le damos formato de bdd
    $curso = $_GET['curso'];
    $dias=$dhabiles->recuperarDias();
    $cantidadDias=count($dias);

    if($cantidadDias>2){
        $res = $a->inasistenciasConsecutivas($dias[0]['fecha'], $dias[1]['fecha'], $dias[2]['fecha'],$curso);   //No es recursiva, llama a un metodo de Alumno.
        foreach ($res as $row) {    
            $a = $alumno->obtenerAlumno($row['alumnoxcurso_alumno_dni']);
            $dniTutor = $a[0]['tutor_dni'];
            $t = $tutor->obtenerTutor($dniTutor);

           if($t[0]['fechaMail']!=null){
                 $inicio = strtotime($t[0]['fechaMail']);
                 $fin = strtotime($fechaActual);
                 $dif = $fin - $inicio;
                 $diasFalt = (( ( $dif / 60 ) / 60 ) / 24);
                 $interval=ceil($diasFalt);

                } else{
                $interval=4;        //trampita, si es null, quiere decir que nunca hubo mail enviado, entonces puede entrar al proximo if.
                  }

            if($interval>3){
                $emailTutor = $t[0]['email'];
                
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
                $mail->FromName = "Instituto Nuestra Sra";

                // Esta es la dirección a donde enviamos 
                $mail->addAddress($emailTutor);

                // El correo se envía como HTML 
                $mail->isHTML(true); 

                // Este es el titulo del email. 
                $mail->Subject = $titulo;

                // Mensaje a enviar.
                $mail->Body = $msn; 

                // Envía el correo.
                $exito = $mail->send();

                if ($exito){
                    $exito2 = $tutor->cambiarFechaMail($fechaActual,$dniTutor);
                    echo "<script>alert('El mensaje se ha enviado exitosamente a " .$emailTutor. "')</script>";
                } else{
                    echo "<script>alert('Falló el envio')</script>";
                }

                
                }
              }
         }
    
    //una vez verificadas las inasistencias consecutivas, redireccionar a la pagina de seleccion de cursos
    print("<script>window.location='../presentacion/registrarAsistencia.php';</script>"); 
?>