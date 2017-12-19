<?php
	include("conexion.php");
	$tabla="usuarios";
	
	$usuario=$_SESSION['user'];

	if($_SESSION['tipo']=='user'){
		$sql="UPDATE $tabla SET tipo='autor' WHERE usuario='$usuario';";
		$resultado=mysql_query($sql,$conexion);
		if(!$resultado){
			echo "<p class='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br/>Disculpen las molestias.</p>";
			exit();
		}else{
                    $_SESSION['tipo']='autor';
                }
	}
?>

