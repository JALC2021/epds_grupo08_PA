<?php
/*$mysql_host = "mysql6.000webhost.com";
$mysql_database = "a5935875_tletras";
$mysql_user = "a5935875_tletras";
$mysql_password = "@todoletras@";
*/

$mysql_host = "127.0.0.1";
$mysql_database = "todoletras";
$mysql_user = "root";
$mysql_password = "";

if(!$conexion=mysql_connect($mysql_host,$mysql_user,$mysql_password)){
	echo "<p align='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br>Disculpen las molestias.</p>";
	exit();
}

$base=mysql_select_db($mysql_database,$conexion);
if(!$base){
	echo "<p align='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br>Disculpen las molestias.</p>";
	mysql_close($conexion);
	exit();
}
?>