<div class='admin'>
    <?php
    include("conexion.php");
    $tabla = "libros";
    if (isset($_POST['borrar']) && isset($_POST['id'])) {
        if (is_array($_POST['id'])) {
            $id = $_POST['id'];
            foreach ($id as $value) {
                $consulta = "SELECT * FROM $tabla where idlibro='$value';";
                $resultado = mysql_query($consulta, $conexion);
                if (!$resultado || (mysql_numrows($resultado) < 1)) {
                    echo "<p class='center'>El libro no existe, por favor pruebelo de nuevo.<br/><br/><a href='borrarlibro.php'>Borrar otro libro</a><br><a href='administracion.php'>Volver a opciones</a><br></p>;</p>";
                } else {
                    $fila = mysql_fetch_array($resultado);
                    $imagen = $fila[7];

                    //ver carpeta para borrar imagen del libro
                    $dir = 'imagenes/';
                    $directorio = opendir($dir);
                    $borra = $dir . $imagen;
                    if (!unlink($borra)) {
                        echo "<p align='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br>Disculpen las molestias.</p>";
                        exit();
                    }
                    closedir($directorio);
                    $consulta = "DELETE FROM $tabla where idlibro='$value';";
                    $resultado = mysql_query($consulta, $conexion);
                    if (!$resultado) {
                        echo "<p align='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br>Disculpen las molestias.</p>";
                    } else {
                        echo "<p class='center'>El libro <strong>$fila[1]</strong> se ha borrado correctamente</p>";
                    }
                }
            }
            mysql_close($conexion);
        }
        echo "<p class='center'><a href='borrarlibro.php'>Borrar mas libros</a></p>";
        echo "<p class='center'><a href='administracion.php'>Volver a opciones</a></p>";
    }
    ?>
</div>