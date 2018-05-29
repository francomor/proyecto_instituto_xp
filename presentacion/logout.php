<?php

include("Interfaz.class.php");
session_destroy();
header("location: ../presentacion/login.php");
exit();
