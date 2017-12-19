<div class="consultar-ebooks">
<?php
if (isset($_SESSION['user'])) {
    if ($_SESSION['tipo'] == 'autor') {
        $usuario = $_SESSION['user'];
        echo "<h2>Tus ebooks subidos:</h2>";
        $dir = "ebooks/" . $usuario . "/";
        $directorio = opendir($dir);
        echo "<div class='ver-ebooks'>";
        while ($archivo = readdir($directorio)) {
            if ($archivo != '.' && $archivo != '..') {
                echo "<p class='center'><a href='$dir$archivo' target='_blank'><img src='imagenes/pdf-icon.jpg' class='pdf-icon'/>$archivo</a></p>";
            }
        }
        echo "</div>";
        echo "<p class='center'><a href='micuenta.php'>Volver a mi cuenta</a><br><a href='donarebook.php'>Donar eBook</a></p>";
        closedir($directorio);
    } else {
        echo "<p class='center'>A&uacute;n no ha donado ning&uacute;n ebook a nuestra web.</p>";
        echo "<p class='center'><a href='micuenta.php'>Volver a mi cuenta</a></p>";
    }
} else {
    echo "<p class='center'>Su sesi&oacute;n ha caducado<br><a href='iniciarsesion.php'>Iniciar Sesion</a></p>";
}
?>
</div>
