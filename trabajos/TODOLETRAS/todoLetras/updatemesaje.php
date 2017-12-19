<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <?php
    session_start();
    ?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
    <head>
        <title>TodoLetras - Publicar Mensaje</title>
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

            <div class="publicar-mensaje">
                <?php
                if ($_SESSION['tipo'] == "admin") {
                    // Si se recibieron los campos id y mensaje por el método POST desde el formulario en editar.php...
                    if (isset($_POST['id']) and isset($_POST['mensaje'])) {
                        // Datos generales para la aplicación web:
                        include("includes/conexion.php");
                        $tabla2 = "mensajes";

                        // Por comodidad...
                        $idmensa = $_POST['id'];
                        $mensaje = $_POST['mensaje'];

                        // Instrucción SQL que modifica el valor de un campo en un registro en la tabla.
                        $sql = "UPDATE $tabla2 SET mensaje='$mensaje' WHERE idmensa=$idmensa;"; // Como el campo id es numérico, no necesita comillas simples en la cláusula WHERE.

                        $resultado = mysql_query($sql, $conexion);
                        // Si no pudo realizarse la operación...
                        if (!$resultado) {
                            echo "<p class='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br/>Disculpen las molestias.</p>";
                        } else {
                            echo "<p class='center'><strong>CORRECTO:</strong> Operaci&oacute;n realizada satisfactoriamente sobre la tabla $tabla2.</p>";
                        }

                        mysql_close($conexion);
                    } else {
                        echo "<p class='center'><strong>ERROR:</strong> Necesita cargar esta p&aacute;gina desde el formulario de edici&oacute;n de un mensaje.</p>";
                    }
                } else {
                    echo "<p class='center'><strong>ERROR:</strong> Acceso restringido. &Uacute;nicamente los administradores pueden acceder a esta p&aacute;gina.</p>";
                }
                ?>
                <p class='center'><a href='comunidad.php'>Volver al Foro</a></p>
            </div>                
                <?php
                include('./includes/novedades.php');
                include('./includes/aside.php');
                include('./includes/footer.php');
                ?> 
        </div>
    </body>
</html>