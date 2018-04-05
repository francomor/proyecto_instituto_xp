<?php
require '../recursos/html2pdf/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
require "../logica/AlumnoxCurso.php";
require "../logica/Asistencia.php";

/**
 * Genera el pdf del boletin por curso
 * @author Rodrigo Martin Vazquez Mauricio
 * @version 1.0
 */


$pdf = "<html><head><style>
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
    </style></head><body>";

if (isset($_POST["generarPdfPorCurso"])) {
    date_default_timezone_set('UTC');
    $curso = $_POST['idCurso']; //se obtiene el id del curso seleccionado desde el archivo cursos.php
    $alumnos = AlumnoxCurso::obtenerAlumnoxCurso($curso, (int) date("Y")); //se obtienen los alumnos del curso seleccionado del a�o actual
    $cantfilas = count($alumnos); //se cuentan los registros obtenidos de la consulta anterior
    $asistencia = New Asistencia();

    foreach($alumnos as $alumno){

        $inasistencias= $asistencia->listarInasistencia($alumno['dni']);
        $nombreAlumno = $alumno['apellido'].' '.$alumno['nombre'];
        $cantInasistencias=count($inasistencias);
        if($cantInasistencias != 0 ){
        $pdf.="
        <table class='table table-bordered'>
          
            <tr>
              <th colspan='7' style='text-align: center;'>Boletin de inasistencias de ".$nombreAlumno."</th>
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
            for($i=0; $i < (61-$cantInasistencias); $i++){
                $pdf.="<br>";
            }    
        }  
             
    }
        $pdf.="</body></html>";
        //var_dump($_POST);
        //echo $curso;
        $html2pdf = new Html2Pdf('P', 'A4');
        $html2pdf->writeHTML($pdf);
        $html2pdf->output('Boletin.pdf');
}   
        ?>