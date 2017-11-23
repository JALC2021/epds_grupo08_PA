<?php
$mysql_host = "127.0.0.1";
$mysql_database = "articulos_cientificos";
$mysql_user = "root";
$mysql_password = "";

if(!$conexion=mysqli_connect($mysql_host,"root","",$mysql_database)){
	die("Error: no ha sido posible conectar con el Servidor de Bases de Datos. ".mysqli_error());
}

$dbase_seleccionada = mysqli_select_db($conexion,$mysql_database);
if(!$dbase_seleccionada){
    	mysqli_close($conexion);
	die("Error: no ha sido posible seleccionar la Base de Datos. ".mysqli_error($conexion));
}
?>

