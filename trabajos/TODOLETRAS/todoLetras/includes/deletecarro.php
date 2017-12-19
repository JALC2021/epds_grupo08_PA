<div class="borrar-carro">
    <?php
    include("conexion.php");
    $tabla = "libros";
    $tabla2 = "carro";

    if (isset($_SESSION['user'])) {
        $usuario = $_SESSION['user'];
        $consulta = "DELETE FROM $tabla2 WHERE usuario='$usuario';";
        $borrar = mysql_query($consulta, $conexion);
        if (!$borrar) {
            echo "<p align='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br>Disculpen las molestias.</p>";
        } else {
            echo "<p class='center'><strong>Su carro se ha borrado correctamente, puede ver mas libros en nuestro cat&aacute;logo</strong></p>";
            echo "<p class='center'><a href='libros.php'>Ver mas libros</a></p>";
        }
    } else {
        echo "<p class='center'><strong>Su sesi&oacute;n ha caducado. Vuelva a iniciar sesi&oacute;n.</strong></p>";
    }
    ?>
</div>