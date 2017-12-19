<?php 
session_start();

if(isset($_POST['delete'])){
	$id = $_POST['idSocio'];
	include 'conexion.php';
	$sql = "delete from usuarios where id = '".$id."' ";
	$foto=$_POST['fotoUsuario'];
	
	mysql_query($sql,$conexion);
	
	mysql_close($conexion);
	header("Location:listaSocioAdmin.php");

}
?>