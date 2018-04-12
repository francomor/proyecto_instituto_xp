<?php
require '../recursos/html2pdf/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
require "../logica/AlumnoxCurso.php";
require "../logica/Asistencia.php";
require "../logica/Alumno.php";
require "../logica/Curso.php";

/**
 * Genera el pdf del boletin por curso
 * @author Rodrigo Martin Vazquez Mauricio
 * @version 1.0
 */

$pdf = "<style>
    table {
        width: 100%;
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
        width: 10%;
        text-align: center;
        border: 2px solid black;

    }
    #justificar{
        width: 30%;
        text-align: center;
    }
    #firma{
        width: 20%;
    }
    #cabeceraTabla{

        height: 40px;
        padding: 15px;
        text-align: center;
    }
    </style>
    ";

if (isset($_POST["generarPdfPorCurso"])) {
    date_default_timezone_set('UTC');
    $curso = $_POST['idCurso']; //se obtiene el id del curso seleccionado desde el archivo cursos.php
    $alumnos = AlumnoxCurso::obtenerAlumnoxCurso($curso, (int) date("Y")); //se obtienen los alumnos del curso seleccionado del a�o actual
    $cantfilas = count($alumnos); //se cuentan los registros obtenidos de la consulta anterior
    $asistencia = New Asistencia();

    foreach($alumnos as $alumno){

        $inasistencias= $asistencia->listarInasistencia($alumno['dni']);
        $nombreAlumno = $alumno['apellido'].' '.$alumno['nombre'];

        //Si el nombre contiene acentos, permite hacer visible los caracteres
        if (mb_detect_encoding($nombreAlumno, 'utf-8', true) === false) {
            $nombreAlumno = mb_convert_encoding($nombreAlumno, 'utf-8', 'iso-8859-1');
        }
        $primeraPagina=true; 
        $cantInasistencias=count($inasistencias);
        if($cantInasistencias != 0 ){

          if($primeraPagina==false){
            $pdf.="<page pageset='new'>";
            }else{

            $pdf.="<page pageset='old'>";    
            }    
        $pdf.="<table class='table table-bordered'>
            <thead>
            <tr>
              <th colspan='7' id='cabeceraTabla'>Boletin de inasistencias de ".$nombreAlumno."</th>
              </tr>
              <tr>
                <th>Fecha</th>
                <th>Falto a</th>
                <th>Falta</th>
                <th style='width: 30%;text-align: center;'>Causas de inasistencia</th>
                <th>Firma</th>
                <th>Total</th>
                <th>V°B°</th>
              </tr>
            </thead>
            <tbody>";
            $acumulado = 0;
            foreach ($inasistencias as $inasistencia) {
                $auxFecha = $inasistencia["fecha"];
                $partes = explode('-', $auxFecha);
                $fecha = "{$partes[2]}-{$partes[1]}-{$partes[0]}";
                $faltoA = $inasistencia["tipo"];
                if($faltoA == 'clase+edFisica'){
                  $faltoA = 'clase y ef';
                }
                if ($inasistencia["valor"] == '1/2') {
                    $falta = 0.5;
                } else if ($inasistencia["valor"] == '1') {
                    $falta = 1;
                }
                $acumulado = $acumulado + $falta;
                $pdf.= "<tr><td>" . $fecha . "</td>";
                $pdf.= "<td>" . $faltoA . "</td>";
                $pdf.= "<td>" . $inasistencia["valor"] . "</td>";
                $pdf.= "<td id='justificar' ></td> <td id='firma'></td>";
                $pdf.= "<td>" . $acumulado . "</td>";
                $pdf.= "<td> </td>";
                $pdf.= "</tr>";
            }
            $pdf.="</tbody></table></page>";



            $primeraPagina=false;
            $d = $asistencia->justificarFaltas($alumno['dni']);
        }  
             
    }
        
        //var_dump($_POST);
        //echo $curso;
        $c= new Curso();
        $nombreCurso= $c->obtenerCurso($curso);
        //var_dump($nombreCurso);
        $html2pdf = new Html2Pdf('P', 'A4');
        $html2pdf->writeHTML($pdf);
        $html2pdf->output('Boletin-Curso'.$nombreCurso[0]["anio"].$nombreCurso[0]["nombre"].'-'.date('d-m-Y').'.pdf');
}
if (isset($_POST["generarPDF"])) {
    date_default_timezone_set('UTC');
    $asistencia = new Asistencia();
    $alumno = new Alumno();
    $dniAlumno = $_POST['dni'];
    $resultadoNombre = $alumno->obtenerNombre($dniAlumno);
    $nombreAlumno = $resultadoNombre[0]['apellido'] . " " . $resultadoNombre[0]['nombre'];
    //Si el nombre contiene acentos, permite hacer visible los caracteres
    if (mb_detect_encoding($nombreAlumno, 'utf-8', true) === false) {
        $nombreAlumno = mb_convert_encoding($nombreAlumno, 'utf-8', 'iso-8859-1');
    }
    $inasistencias= $asistencia->listarInasistencia($dniAlumno);
    $cantInasistencias=count($inasistencias);
    if($cantInasistencias != 0 ){
    $pdf.="
    <table class='table table-bordered'>
      
        <tr>
          <th colspan='7' id='cabeceraTabla'>Boletin de inasistencias de ".$nombreAlumno."</th>
          </tr>
          <tr>
            <th>Fecha</th>
            <th>Falto a</th>
            <th>Falta</th>
            <th style='width: 30%;text-align: center;'>Causas de inasistencia</th>
            <th>Firma</th>
            <th>Total</th>
            <th>V°B°</th>
          </tr>
        
        <tbody>";
        $acumulado = 0;
        foreach ($inasistencias as $inasistencia) {
            $auxFecha = $inasistencia["fecha"];
            $partes = explode('-', $auxFecha);
            $fecha = "{$partes[2]}-{$partes[1]}-{$partes[0]}";
            $faltoA = $inasistencia["tipo"];
            if($faltoA == 'clase+edFisica'){
              $faltoA = 'clase y ef';
            }
            if ($inasistencia["valor"] == '1/2') {
                $falta = 0.5;
            } else if ($inasistencia["valor"] == '1') {
                $falta = 1;
            }
            $acumulado = $acumulado + $falta;
            $pdf.= "<tr><td>" . $fecha . "</td>";
            $pdf.= "<td>" . $faltoA . "</td>";
            $pdf.= "<td>" . $inasistencia["valor"] . "</td>";
            $pdf.= "<td id='justificar' ></td> <td id='firma'></td>";
            $pdf.= "<td>" . $acumulado . "</td>";
            $pdf.= "<td> </td>";
            $pdf.= "</tr>";
        }
        $pdf.="</tbody></table>";   
    }
    
    //var_dump($_POST);
    //echo $curso;

    $html2pdf = new Html2Pdf('P', 'A4');
    $html2pdf->writeHTML($pdf);
    $html2pdf->output('Boletin-'.$nombreAlumno.'-'.date('d-m-Y').'.pdf');
    $d = $asistencia->justificarFaltas($dniAlumno);
    //echo $pdf;
}        

    
    
    

?>