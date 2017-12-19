<div class="libro-detallado">
    <div class="padding-center">
    <?php
    include("conexion.php");

    $tabla = "libros";
    $id = $_GET['id'];
    $consulta = "SELECT * FROM $tabla WHERE idlibro='$id';";
    $resultado = mysql_query($consulta, $conexion);
    if (!$resultado) {
        echo "<p align='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br>Disculpen las molestias.</p>";
    } else {
        while ($fila = mysql_fetch_array($resultado)) {

            echo "<img src='imagenes/$fila[7]' class='libro-explicito'>"
            . "<strong>Titulo:</strong> $fila[1] <br><br> "
            . "<strong>Autor:</strong> $fila[2] <br/><br/> "
            . "<strong>Editorial:</strong> $fila[3] <br/><br/> "
            . "<strong>Genero:</strong> $fila[4] <br/><br/> "
            . "<strong>A&ntildeo edicion:</strong> $fila[5] <br/><br/> "
            . "<strong>ISBN:</strong> $fila[6]<br/><br/> "
            . "<strong>Precio:</strong> $fila[8]<br/><br/>";
            $_SESSION['isbn'] = $fila[6];
            echo "<form action='carro.php' method='post'><input type='hidden' name='isbn' id='isbn' value=" . $_SESSION['isbn'] . "><input type='submit' name='enviar' value='A&ntilde;adir a mi cesta' class='input-button'/></form><br><br><br>";
        }
    }
    ?>
    </div>
</div>