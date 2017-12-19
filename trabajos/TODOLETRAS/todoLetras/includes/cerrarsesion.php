<?php
session_start();
if(isset($_SESSION['user']) && isset($_SESSION['pass'])){
    session_unset();
    session_destroy();
    header("Location: ../index.php");
}
else{
    echo "No hay sesion iniciada";
}
?>
