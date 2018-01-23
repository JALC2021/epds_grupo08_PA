<?php
session_start();
//destuimos todas las sesiones y perdemos el valor de sus variables.
session_destroy();
//nos redirige al login para volver a logarse.
header("location:login.php");

?>

