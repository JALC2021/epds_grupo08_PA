<div class='admin'>
    <?php
    include("conexion.php");

    $tabla = "libros";

    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $editorial = $_POST['editorial'];
    $genero = $_POST['genero'];
    $anoedicion = $_POST['edicion'];
    $isbn = $_POST['isbn'];
    $precio = $_POST['precio'];
    $flag = TRUE;

    if ($_FILES['file']['type'] == "image/jpeg") {
        $consulta = "SELECT * FROM $tabla";
        $resultado = mysql_query($consulta, $conexion);
        if (!$resultado) {
            echo "<p class='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde. Disculpen las molestias.</p>";
        } else {

            while ($fila = mysql_fetch_array($resultado)) {
                if ($fila[6] == $isbn or $fila[1] == $titulo) {
                    echo "<p class='center'>El libro ya existe</p>";
                    echo "<p class='center'><a href='agregarlibro.php'>Probar otro libro</a></p>";
                    echo "<p class='center'><a href='administracion.php'>Volver a opciones</a></p>";
                    $flag = FALSE;
                    break;
                }
            }

            if ($flag) {
                $resultado = copy($_FILES['file']['tmp_name'], 'imagenes/' . $_FILES['file']['name']);
                if (!$resultado) {
                    echo "<p class='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde. Disculpen las molestias.</p>";
                } else {
                    $fechahora = date("Y-m-d H:i:s");
                    $imagen = $_FILES['file']['name'];
                    $sql_insertar = "INSERT INTO $tabla VALUES (0,'$titulo','$autor','$editorial','$genero',$anoedicion,'$isbn','$imagen',$precio,0,'$fechahora');";
                    $resultado = mysql_query($sql_insertar, $conexion);
                    if (!$resultado) {
                        echo "<p class='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde. Disculpen las molestias.</p>";
                    } else {
                        echo "<p class='center'>El libro $titulo se ha a&ntilde;adido correctamente</p>";
                        echo "<p class='center'><a href='agregarlibro.php'>A&ntilde;adir otro libro</a></p>";
                        echo "<p class='center'><a href='administracion.php'>Volver a opciones</a></p>";
                    }
                }
            }
        }
        mysql_close($conexion);
    } else {
        echo "<p class='center'>El formato no es v&aacute;lido para la portada, por favor inserte una imagen .jpg</p>";
        echo "<p class='center'><a href='agregarlibro.php'>Volver a intentarlo</a></p>";
    }
    ?>
</div>