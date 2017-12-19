<div class="admin">
    <?php
// Si es un administrador o un usuario registrado...
    if ($_SESSION['tipo'] == "admin") {
        ?>

        <h2 align="center">INSERTE EL TITULO DEL LIBRO A BORRAR:</h2> 

        <form action="borrarlibrodelete.php" enctype="multipart/form-data" method="post" id="formulario">
            <?php
            include("conexion.php");
            $tabla = "libros";

            $sql = "SELECT * FROM $tabla;";
            $resultado = mysql_query($sql, $conexion);

            if (!$resultado || (mysql_numrows($resultado) < 1)) {
                echo "<p class='center'>No hay libros en este momento</p>";
            } else {
                echo "<table class='tabla-usuarios'>";
                echo "<tr><td><strong>TITULO</strong></td>"
                . "<td><strong>AUTOR</strong></td><td><strong>BORRAR</strong></td></tr>";
                while ($fila = mysql_fetch_row($resultado)) {
                    echo "<tr>"
                    . "<td>$fila[1]</td>"
                    . "<td>$fila[2]</td>"
                    . "<td><input type='checkbox' name='id[]' value='$fila[0]' />"
                    . "</td></tr>";
                }
                echo "</table>";
                echo "<p class='center'><input type='submit' name='borrar' value='Borrar' class='input-button' /></p>";
            }
            mysql_close($conexion);
            ?>
        </form>
        <p class="center"><a href="administracion.php">Volver a opciones</a></p>
        <?php
    } else {
        echo "<p class='center'><strong>ERROR:</strong> Acceso restringido. &Uacute;nicamente los administradores pueden acceder a esta p&aacute;gina.</p>";
    }
    ?>
</div>