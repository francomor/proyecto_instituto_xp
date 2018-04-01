<?php
require_once "../logica/Curso.php";
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

/**
 * En este archivo, mediante una llamada de ajax,
 * se cargan todos los cursos de la bdd al archivo cursos.php
 * se hace en forma de lista.
 * @author 
 * @version 1.0
 */

$c = new Curso();
$cursos = $c->obtenerCursos();
$registros = $c->cantRegistros();
if ($_REQUEST['funcion'] == 'imprimirCurso') {
    echo ("<form action=tablaCurso.php>");
} else {
    echo ("<form action=tabla.php>");
}
echo (" <div class='col-xs-3'>");
echo ("<div class='box'>");
echo (" <select class='form-control' id='sel' name='sel' onchange='this.form.submit()'> <option value=seleccionar...> seleccione un curso </option>");
for ($i = 0; $i < $registros; $i++) {
    print('<option value="' . $cursos[$i]["idcurso"] . '"> ' . $cursos[$i]["anio"] . '&deg' . $cursos[$i]["nombre"] . '</option>');
}
echo ("</select>");
echo ("</form>");

?>