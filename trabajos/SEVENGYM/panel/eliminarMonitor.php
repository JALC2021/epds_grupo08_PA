<?php 
session_start();

if(isset($_POST['delete'])){
	$id = $_POST['idMonitor'];
	include 'conexion.php';
	$sql = "delete from usuarios where id = '".$id."' ";
	
	
	mysql_query($sql,$conexion);
	
	mysql_close($conexion);
	header("Location:listarMonitores.php");

}
?>