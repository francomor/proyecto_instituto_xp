<?php
		session_start();
		session_destroy();
		header("location: ../presentacion/login.php");
		exit();
?>