<div class='admin'>
    <?php
    include("conexion.php");

    $tabla = "usuarios";
    if (isset($_POST['user'])) {
        if (is_array($_POST['user'])) {
            $user = $_POST['user'];
            foreach ($user as $value) {
                $sql = "SELECT * FROM $tabla WHERE usuario='$value';";
                $resultado = mysql_query($sql, $conexion);

                if (!$resultado || (mysql_numrows($resultado) < 1)) {
                    echo "<p class='center'>El usuario introducido no existe</p>";
                    echo "<p class='center'><a href='borrarusuario.php'>Volver a intentarlo</a></p>";
                } else {
                    $sql = "DELETE FROM $tabla WHERE usuario='$value';";
                    $resultado = mysql_query($sql, $conexion);
                    if (!$resultado) {
                        echo "<p class='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br/>Disculpen las molestias.</p>";
                        echo "<p class='center'><a href='borrarusuario.php'>Volver a intentarlo</a></p>";
                    } else {
                        echo "<p class='center'>Usuario <strong>$value</strong> borrado correctamente</p>";
                    }
                }
            }
            mysql_close($conexion);
        }
        echo "<p class='center'><a href='borrarusuario.php'>Borrar mas usuarios</a></p>";
        echo "<p class='center'><a href='administracion.php'>Volver a opciones</a></p></p>";
    } else {
        echo "<p class='center'>Introduzca un usuario<br>";
        echo "<p class='center'><a href='borrarusuario.php'>Borrar usuario</a></p>";
        echo "<p class='center'><a href='administracion.php'>Volver a opciones</a></p></p>";
    }
    ?>
</div>