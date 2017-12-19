<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <?php
    session_start();
    ?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
    <head>
        <title>TodoLetras - Consultar Carrito</title>
        <?php
        include('./includes/cabecera.php');
        ?>
    </head>
    <body>
        <div class="container">
            <?php
            include('./includes/header.php');
            include('./includes/nav.php');
            ?>
            <div class = "publicar-mensaje">
                <?php
                if (isset($_SESSION['user']) and ($_SESSION['tipo'] == 'admin')) {
                    $idnot = $_POST['idnot'];
                    include("includes/conexion.php");

                    $tabla = "noticias";

                    $idnot = $_POST['idnot'];

                    // Instrucción SQL que inserta un nuevo registro en la tabla.
                    $sql = "DELETE FROM $tabla WHERE idnot=$idnot;"; // Como el campo id es numérico, no necesita comillas simples en la cláusula WHERE.

                    $resultado = mysql_query($sql, $conexion);
                    // Si no pudo realizarse la operación...
                    if (!$resultado) {
                        echo "<p align='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br>Disculpen las molestias.</p>";
                    } else {
                        echo "<p>CORRECTO: Operaci&oacute;n realizada satisfactoriamente sobre la tabla $tabla.</p>";
                        echo "<a href='noticias.php'>Volver</a>";
                    }
                } else {
                    echo "<p align='center'>Debe ser administrador para acceder al contenido de esta p&aacute;gina.</p>";
                }
                ?>
            </div>
            <?php
            include('./includes/novedades.php');
            include('./includes/aside.php');
            include('./includes/footer.php');
            ?>
        </div>
    </body>
</html>