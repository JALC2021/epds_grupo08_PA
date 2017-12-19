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
        <script src="js/comprobarmensaje.js" type="text/javascript"></script>
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

// Si se recibió el campo "id" por el método GET desde el enlace en foro.php...
                    if (isset($_GET['id'])) {
                        // Datos generales para la aplicación web:
                        include("includes/conexion.php");
                        $tabla2 = "mensajes";

                        // Por comodidad...
                        $idmensa = $_GET['id'];

                        // Instrucción SQL que obtiene un registro en la tabla.
                        $sql = "SELECT * FROM $tabla2 WHERE idmensa=$idmensa;"; // Como el campo id es numérico, no necesita comillas simples en la cláusula WHERE.

                        $resultado = mysql_query($sql, $conexion);
                        // Si no pudo realizarse la operación...
                        if (!$resultado) {
                            echo "<p class='center'><strong>ERROR:</strong> No pudo realizarse la operaci&oacute;n sobre la tabla $tabla2.</p>";
                        } else {
                            // Si el número de filas (registros) de la consulta resultante es 0, o lo que es lo mismo:
                            // Si no se encontró ningún registro en la tabla con ese id...
                            $numero_registros = mysql_numrows($resultado);
                            if ($numero_registros == 0) {
                                echo "<p class='center'><strong>ERROR:</strong> El mensaje ya no existe.</p>";
                            } else {
                                if ($fila = mysql_fetch_array($resultado)) { // Obtener una fila (registro) de la consulta. // Si la fila obtenida no es errónea...
                                    // Por comodidad...
                                    $idmensa = $fila['idmensa']; // Me hace falta el id para que se pueda hacer el UPDATE sobre este registro concreto
                                    //$usuario=$fila['usuario'];
                                    //$fechahora=$fila['fechahora'];
                                    $mensaje = $fila['mensaje']; // El campo mensaje es el único editable.
                                    ?>
                                    <h4>EDITE LOS DATOS DEL MENSAJE:</h4>
                                    <!-- Formulario básico estándar HTML para enviar datos POST a una página PHP -->
                                    <form method="post" action="updatemesaje.php" onsubmit="return comprobarmensaje()">
                                        Mensaje:<br/>
                                        <textarea name="mensaje" cols="80" rows="10"><?php echo "$mensaje"; ?></textarea><br/>
                                        <input type="hidden" name="id" value="<?php echo $idmensa; ?>" />
                                        <input type="submit" value="Guardar" class="input-button"/>
                                    </form>
                                    <?php
                                } else {
                                    echo "<p class='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br/>Disculpen las molestias.</p>";
                                }
                            }
                        }
                        mysql_close($conexion);
                    } else {
                        echo "<p class='center'><strong>ERROR:</strong> Necesita cargar esta p&aacute;gina desde el foro.</p>";
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