<?php
/**
 * Este fichero php se utiliza para obtener un pdf de una pagina dada,
 * en este caso se genera el pdf de el bolentin de inasistencias,
 * para un alumno, buscado anteriormente.
 * Imprime solamente las faltas que se pueden visualizar en la imagen anterior.
 */

//include_once("../logica/clases.php");

require '../recursos/html2pdf/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;

//$asistencia= new Asistencia();

//este if verifica si se selecciono el boton en el formulario de listarinasistencias.php

if (isset($_POST['generarPDF'])) {

    //con ayuda del buffer, levantamos el codigo html contenido en la pagina objetivo a ser generada en pdf

    ob_start();
    include_once '../presentacion/listarInasistencias.php';
    $html = ob_get_clean();

    //se desactivan los alerts y los errores, porque la libreria utilizada 'html2pdf' utiliza una funcion para date que esta obsoleta
    //pero no presenta ningun incombeniente.

    ini_set('display_errors', 0);
    ini_set('log_errors', 1);

    //las variables que estan a continuacion son utilizadas para saber a partir de donde cortar el html contenido en listar asistencias
    //buscamos que los identificadores sean unicos y esten donde nosotros querramos cortar.

    $inicio = strrpos($html, '<div class="container">');
    $fin = strrpos($html, '</table>');

    //se inicializa la variable que va a contener el codigo html inicial para poder generar el pdf a posteriro
    //se crean los estilos que querramos que tenga la pagina, en este caso como es solo una tabla generamos el codigo para mostrar
    //lo mejor posible esta tabla.

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
    }
    #firma{
        width: 20%;
    }
    </style></head><body>";

    //se realiza el corte de la pagina html utilizando las variables que anteriormente se calcularon

    $pdf .= substr($html, $inicio, ($fin - $inicio));

    //con nuestro corte hecho en </table>, nos hace falta cerrar algunas etiquetas y las concatenamos al final del pdf

    $pdf .= '</table></div></body></html>';

    //antes que se genere el pdf necesitamos justificar las faltas para que no aparezcan para la proxima impresion
    //de boletin de inasistencias para este alumno.

    //$asistencia->justificarInassitencias($dni);

    //aqui hacemos uso de la libreria Html2pdf creando la clase a utilizar para generar el pdf y le pasamos la variable

    $html2pdf = new Html2Pdf();
    $html2pdf->writeHTML($pdf);

    //este metodo se utiliza para darle nombre al archivo en el caso que se quiera descargar el pdf.

    $html2pdf->output('Boletin.pdf');

    //se destruye la sesion actual para que se pueda volver a realizar una consulta

    //session_unset();

}


?>