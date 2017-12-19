<div class="consultar-compras">
    <div class="padding-center">
        <?php
        include("conexion.php");

        $tabla = "ventas";


        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            $sql = "SELECT * FROM $tabla WHERE usuario='$user';";
            $resultado = mysql_query($sql, $conexion);

            if (!$resultado || (mysql_numrows($resultado) < 1)) {
                echo "<div class='mi-cuenta-opc'><h4>No ha comprado ning&uacute;n libro aun. Acceda a nuestros <a href='libros.php'>libros</a></h4>";
                echo "<p><a href='micuenta.php'>Volver</a></p></div>";
            } else {
                echo "<h2>Mis compras:</h2>";
                while ($fila = mysql_fetch_array($resultado)) {
                    echo "<img src='imagenes/$fila[7]' class='libro-explicito'><b>Titulo:</b> $fila[1] <br/><br/> <b>Autor:</b> $fila[2] <br/><br/> <b>Editorial:</b> $fila[3] <br/><br/> <b>Genero:</b> $fila[4] <br/><br/> <b>A&ntildeo edicion:</b> $fila[5] <br/><br/> <b>ISBN:</b> $fila[6]<br/><br/> <b>Precio:</b> $fila[8] ";
                    echo "<br/><strong>Comprado el $fila[9]-$fila[10]-$fila[11]</strong><br/>";
                    echo "<a href='includes/generarpdf.php?titulo=$fila[1]&precio=$fila[8]&id=$fila[0]&usuario=$fila[12]&dia=$fila[9]&mes=$fila[10]&anio=$fila[11]' target='_blank'><strong>Generar factura</strong></a><br/><br/>";
                }
                echo "<p class='center'><a href='micuenta.php'>Volver</a></p>";
            }
        } else {
            echo "<p class='center>Su sesi&oacute;n ha caducado. Vuelva a iniciar sesi&oacute;n.</p>";
        }
        ?>
    </div>
</div>
