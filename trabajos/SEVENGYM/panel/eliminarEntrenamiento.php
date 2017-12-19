<?php 
session_start();
if(isset($_SESSION['rol'])==NULL or $_SESSION['rol']!='monitor'){
	header("Location:404.html");
}
if(isset($_POST['delete'])){
	$id = $_POST['idEntrenamiento'];
	include 'conexion.php';
	$sql = "delete from entrenamiento where id = '".$id."' ";
	$sql2 = "delete from entrenamiento_ejercicio where id_entrenamiento ='".$id."' ";
	mysql_query($sql,$conexion);
	mysql_query($sql2,$conexion);
	mysql_close($conexion);
	header("Location:listarEntrenamientos.php");

}
?>