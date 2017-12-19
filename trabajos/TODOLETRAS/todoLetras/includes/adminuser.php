<div class="admin">
    <?php
    if ($_SESSION['tipo'] == "admin") {
        ?>

        <h2 align="center">INSERTE LOS DATOS DEL USUARIO A BORRAR:</h2>

        <!-- Formulario básico estándar HTML para enviar datos post a una página PHP -->
        <form action="borrarusuariodelete.php" method="post" id="formulario">

            <h4 align="center">LISTA DE USUARIOS:</h4>
            <?php
            include("conexion.php");
            $tabla = "usuarios";

            $sql = "SELECT * FROM $tabla;";
            $resultado = mysql_query($sql, $conexion);

            if (!$resultado || (mysql_numrows($resultado) < 1)) {
                echo "<p class='center'>No hay usuarios registrados en este momento</p>";
            } else {
                echo "<table class='tabla-usuarios'>";
                echo "<tr><td><strong>USUARIO</strong></td>"
                . "<td><strong>TIPO</strong></td><td><strong>BORRAR</strong></td></tr>";
                while ($fila = mysql_fetch_row($resultado)) {
                    echo "<tr>"
                    . "<td>$fila[0]</td>"
                    . "<td>$fila[7]</td>"
                    . "<td><input type='checkbox' name='user[]' value='$fila[0]' />"
                    . "</td></tr>";
                }
                echo "</table>";
                echo "<p class='center'><input type='submit' name='enviar' value='Borrar' class='input-button' /></p>";
            }
            mysql_close($conexion);
            ?>
        </form>
        <p class="center"><a href='administracion.php'>Volver a opciones</a></p>
        <?php
    } else {
        echo "<p class='center'><strong>ERROR:</strong> Acceso restringido. &Uacute;nicamente los administradores pueden acceder a esta p&aacute;gina.</p>";
    }
    ?>
</div>