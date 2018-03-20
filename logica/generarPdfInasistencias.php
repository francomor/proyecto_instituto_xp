<?php
require '../recursos/html2pdf/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;

$dni=$_POST['dni'];
         

if (isset($_POST['generarPDF'])){
    
    ob_start();
    include_once '../presentacion/listarInasistencias.php';
   
    $html= ob_get_clean();
    
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    
    $inicio=strrpos($html,'<body>');
    $fin=strrpos($html,'</table>');
    

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
    </style></head>";

    $pdf.=substr($html,$inicio,($fin-$inicio));
    $pdf.='</table></div></body></html>';
    
    //echo $pdf;
    $html2pdf = new Html2Pdf();
    $html2pdf->writeHTML($pdf);
    $html2pdf->output('prueba.pdf');

    session_destroy();
}
?>
