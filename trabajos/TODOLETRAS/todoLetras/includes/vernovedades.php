<?php

include("conexion.php");

$tabla = "libros";

$consulta = "SELECT * FROM $tabla ORDER BY fechahora DESC LIMIT 0,4;";
$resultado = mysql_query($consulta, $conexion);
if (!$resultado) {
    echo "<p align='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br>Disculpen las molestias.</p>";
} else {
    while ($fila = mysql_fetch_array($resultado)) {
        echo "<div class='novedad'><figure>";
        echo "<img src='imagenes/$fila[7]' alt='$fila[7]'>";
        echo "</figure></div>";
    }
}
?>
