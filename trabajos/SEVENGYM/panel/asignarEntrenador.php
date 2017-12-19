<?php 
session_start();
if(isset($_SESSION['rol'])==NULL or $_SESSION['rol']!='socio'){
    header("Location:404.html");
}
if(isset($_POST['asignarMonitor']))
$idMonitor = $_POST['idMonitor'];
include 'conexion.php';
mysql_query("update socios set id_monitor = ".$idMonitor." where id_usuario = ".$_SESSION['id']."",$conexion);
mysql_close($conexion);
header("Location:seleccionarMonitor.php");
?>