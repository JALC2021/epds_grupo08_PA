<div class="foro">
    <?php

    include("conexion.php");

    $tabla = "mensajes";

    $sql = "SELECT * FROM $tabla ORDER BY fechahora DESC;";

    $resultado = mysql_query($sql, $conexion);
    if (!$resultado) {
        echo "<p>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br/>Disculpen las molestias.</p>";
    } else {
        $numero_registros = mysql_numrows($resultado);
        if ($numero_registros == 0) {
            echo "<h2>COMUNIDAD</h2>";
            echo "<h4>Total de mensajes: (0) <a href='comunidad.php'><img src='imagenes/update.png' class='update'/></a></h4>";
            echo "<h4>MENSAJES DE LA COMUNIDAD:</h4>";
            echo "<p class='center'>- - Sin ning&uacute;n mensaje todav&iacute;a - -</p><hr/>";
        } else {
            echo "<h2>COMUNIDAD</h2>";
            echo "<h4>Total de mensajes: ($numero_registros) <a href='comunidad.php'><img src='imagenes/update.png' class='update'/></a></h4>";
            echo "<h4>MENSAJES DE LA COMUNIDAD:</h4>";while ($fila = mysql_fetch_array($resultado)) {
                $idmensa = $fila['idmensa'];
                $usuario = $fila['usuario'];
                $fechahora = $fila['fechahora'];
                $mensaje = $fila['mensaje'];

                echo "<div class='mensaje'><strong>$usuario - $fechahora</strong><hr/><p>" . nl2br($fila['mensaje']) . "</p>";

                if (isset($_SESSION['tipo']) and ($_SESSION['tipo'] == 'admin')) {
                    echo "<p><a href='eliminarmensaje.php?id=$idmensa'>Eliminar</a> <a href='editarmensaje.php?id=$idmensa'>Editar</a></p>";
                }
                echo "</div>";
            }
            echo "<p class='center'>- - Fin de los mensajes - -</p><hr/>";
        }
    }
    mysql_close($conexion);

    echo "<h4>MEN&Uacute; DE OPCIONES:</h4>";
    if (isset($_SESSION['tipo']) and ($_SESSION['tipo'] == "admin" || $_SESSION['tipo'] == "user" || $_SESSION['tipo'] == "autor")) {
        echo "<p class='center'><a href='publicarmensaje.php'>Insertar mensaje</a></p>";
    } else {
        echo "<p class='center'>Debes iniciar sesi&oacute;n para comentar en nuestro foro<br/>";
        echo "<a href='login.php'>Iniciar sesi&oacute;n</a></p>";
    }
    echo "<hr>";
    ?>
</div>