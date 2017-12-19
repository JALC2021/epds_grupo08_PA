<div class="consultar-datos">
    <?php
    include("conexion.php");

    $tabla = "usuarios";


    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        $sql = "SELECT * FROM $tabla WHERE usuario='$user';";
        $resultado = mysql_query($sql, $conexion);

        if (!$resultado || (mysql_numrows($resultado) < 1)) {
            echo "<p class='center'>Su sesi&oacute;n ha caducado. Vuelva a iniciar sesi&oacute;n.</p>";
        } else {
            echo "<div class='mi-cuenta-opc'><h2>Mis datos</h2>";
            echo "<img src='imagenes/mi-datos.png' class='mi-cuenta-img'/> ";
            while ($fila = mysql_fetch_array($resultado)) {
                echo "<ul><li><h4>Nick de usuario: $fila[0]</h4></li>
                <li><h4>Apellidos: $fila[3]</h4></li>
                <li><h4>Sexo: $fila[4]</h4></li>
                <li><h4>Edad: $fila[5]</h4></li>
                <li><h4>DNi: $fila[6]</h4></li></ul>
                <p class='center'><a href='micuenta.php'>Volver a mi cuenta</a></p>";
            }
            echo "</div>";
        }
    } else {
        echo "<p class='center'>Su sesi&oacute;n ha caducado. Vuelva a iniciar sesi&oacute;n.</p>";
    }
    ?>
</div>