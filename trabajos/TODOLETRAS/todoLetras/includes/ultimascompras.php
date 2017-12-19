<?php

include("conexion.php");

$tabla = "ventas";

$consulta = "SELECT * FROM $tabla ORDER BY anio,mes,dia DESC LIMIT 0,4;";
$resultado = mysql_query($consulta, $conexion);
if (!$resultado) {
    echo "<p align='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br>Disculpen las molestias.</p>";
} else {
    while ($fila = mysql_fetch_array($resultado)) {
        echo "<li><a href='detallarlibro.php?id=$fila[0]'><img src='imagenes/$fila[7]' alt='$fila[7]'></a></li>";
    }
}
?>