<?php
/**
 * En este archivo, se validan el email y contraseña del usuario.
 * @author Navarro Karen y Piñero Luciana
 * @version 1.0
 */

require_once "../persistencia/conexionBD.php";

ob_start();

if (!empty($_POST)) {

    if (isset($_POST["username"]) && isset($_POST["password"])) {

        if ($_POST["username"] != "" && $_POST["password"] != "") {
            $db = conexionBD::getConexion();

            $username = $_POST["username"];
            $password = $_POST["password"];

            $consulta = "select * from user where usuario='" . $username . "' and clave='" . $password . "'";
            $resultado = $db->recuperarAsociativo($consulta);
            $cantidad = count($resultado);

            if ($cantidad == 0) {
                ?>
                <div class='alert alert-danger'>  <strong>Error!</strong> Datos incorrectos.</div>
                <?php
            } else {

                $tipo = $resultado[0]['tipo'];
                include ("realizarBackup.php");
                realizarBackup();

                session_start();

                $_SESSION["usuario"] = $username;
                $_SESSION["tipo"] = $tipo;
                $_SESSION["clave"] = $password;
                $_SESSION["login"] = true;

                ?>
home <?php

            }
        } else {
            ?>
            <div class='alert alert-danger'>  <strong>Error!</strong> Campos vacios.</div>
            <?php
        }
    }
}
ob_end_flush();
