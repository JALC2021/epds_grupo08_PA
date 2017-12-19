<div class="novedades">
    <h4 class="h4novedades">Novedades<span><a href="libros.php">Ver todos</a></span></h4>
    
    <div class="novedades-aux">
        <?php
        include("conexion.php");

        $tabla = "libros";

        $consulta = "SELECT * FROM $tabla ORDER BY fechahora DESC LIMIT 0,4;";
        $resultado = mysql_query($consulta, $conexion);
        if (!$resultado) {
            echo "<p align='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br>Disculpen las molestias.</p>";
        } else {
            while ($fila = mysql_fetch_array($resultado)) {
                echo "<div class='novedad'>"
                    . "<a href='detallarlibro.php?id=$fila[0]'>"
                    . "<img src='imagenes/$fila[7]' alt='$fila[7]'>"
                    . "</a>"
                    . "<figcaption><strong>Precio:</strong> $fila[8]</figcaption></div>";
            }
        }
        ?>

    </div>
</div>
