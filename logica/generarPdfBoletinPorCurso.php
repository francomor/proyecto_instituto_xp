<?php

require '../recursos/html2pdf/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
include("../logica/clases.php");


$pdf="<html><head><style>  
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
    }
    #firma{
        width: 20%;
    }
    </style></head><body>";


 if(isset($_POST["generarPdfPorCurso"])){


        date_default_timezone_set('UTC');
        $curso = $_POST['idCurso']; //se obtiene el id del curso seleccionado desde el archivo cursos.php
        $alumnos = AlumnoxCurso::obtener_alumnoxCurso($curso, (int) date("Y")); //se obtienen los alumnos del curso seleccionado del a�o actual
        $cantfilas = count($alumnos); //se cuentan los registros obtenidos de la consulta anterior

 }   





$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($pdf);
$html2pdf->output('Boletin.pdf');


?>