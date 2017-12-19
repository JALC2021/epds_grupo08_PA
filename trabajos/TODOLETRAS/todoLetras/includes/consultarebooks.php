<div class="ebooks">
<?php

include("conexion.php");

if (isset($_SESSION['user'])) {
    if ($_SESSION['tipo'] == 'autor') {

        $tabla = "usuarios";

        $sql = "SELECT * FROM $tabla WHERE tipo='autor';";
        $resultado = mysql_query($sql, $conexion);
        if (!$resultado) {
            echo "<p class='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br/>Disculpen las molestias.</p>";
            exit();
        } else {
            while ($fila = mysql_fetch_array($resultado)) {
                $usuario = $fila[0];
                echo "<p>Ebooks donados por el usuario <strong>$usuario</strong>:</p>";
                $dir = "ebooks/" . $usuario . "/";
                $directorio = opendir($dir);
                echo "<div class='ver-ebooks'>";
                while ($archivo = readdir($directorio)) {
                    if ($archivo != '.' && $archivo != '..') {
                        echo "<p class='center'><a href='$dir$archivo' target='_blank'><img src='imagenes/pdf-icon.jpg' class='pdf-icon'/>$archivo</a></p>";
                    }
                }
                closedir($directorio);
                echo "</div>";
            }
            echo "<p align='center'><a href='donarebook.php'>Donar eBook</a></p>";
        }
    } else if ($_SESSION['tipo'] == 'admin') {

        $tabla = "usuarios";

        $sql = "SELECT * FROM $tabla WHERE tipo='autor';";
        $resultado = mysql_query($sql, $conexion);
        if (!$resultado) {
            echo "<p class='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br/>Disculpen las molestias.</p>";
            exit();
        } else {
            while ($fila = mysql_fetch_array($resultado)) {
                $usuario = $fila[0];
                echo "<p>Ebooks donados por el usuario <strong>$usuario</strong>:</p>";
                $dir = "ebooks/" . $usuario . "/";
                $directorio = opendir($dir);
                echo "<div class='ver-ebooks'>";
                while ($archivo = readdir($directorio)) {
                    if ($archivo != '.' && $archivo != '..') {
                        echo "<form action='borrarebook.php' method='post'>"
                        . "<input type='hidden' name='dir' value='$dir'/>"
                                . "<input type='hidden' name='arch' value='$archivo'/>"
                                . "<p class='center'><a href='./$dir$archivo' target='_blank'>"
                                . "<img src='imagenes/pdf-icon.jpg' class='pdf-icon'/>$archivo</a>"
                                . "<input type='image' value='a' src='imagenes/x.gif' height='20px' width='20px' title='Eliminar'/>"
                                . "</p></form>";
                    }
                }
                closedir($directorio);
                echo "</div>";
            }
        }
    } else {
        echo "<p class='center'>Para acceder a todos los ebooks disponibles en la web debe de habernos donado uno previamente. "
        . "<br><a href='donarebook.php'>Donar eBook</a>.</p>";
    }
} else {
    echo "<p class='center'>Debe de iniciar sesi&oacute;n para acceder al contenido<br><a href='login.php'>Iniciar Sesión</a></p>";
}
mysql_close($conexion);
?>
</div>
