<?php 
session_start();

if(isset($_POST['delete'])){
	$id = $_POST['idTarifa'];
	include 'conexion.php';
	$sql = "delete from tarifa where id = '".$id."' ";
	
	
	mysql_query($sql,$conexion);
	
	mysql_close($conexion);
	header("Location:listarTarifa.php");

}
?>