<?php 
session_start();
if(isset($_SESSION['rol'])==NULL or $_SESSION['rol']!='admin'){
	header("Location:404.html");
}
if(isset($_POST['delete'])){
	$id = $_POST['idPago'];
	include 'conexion.php';
	$sql = "delete from pago where id = '".$id."' ";
	
	mysql_query($sql,$conexion);
	
	mysql_close($conexion);
	header("Location:PagoRealizado.php");

}
?>