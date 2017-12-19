<div class="cambiar-pass">
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
            echo "<div class='mi-cuenta-opc'><h2>Cambiar contrase&ntilde;a</h2>";
            echo "<img src='imagenes/key.png' class='mi-cuenta-img'/> ";
            while ($fila = mysql_fetch_array($resultado)) {
                ?>
                <form action='#' method='post' id="formulario" onsubmit="return comprobarpassword();">
                    <label>Nueva contrase&ntilde;a:</label>
                    <input type='password' name='pass' id='pass'/>
                    <input type='submit' name='cambiar' value='Cambiar' class='input-button' />
                </form>
            </div>            
            <p class='center'><a href='micuenta.php'>Volver</a></p>
            <?php
        }
    }
    if (isset($_POST['cambiar'])) {
        if (isset($_POST['pass']) && $_POST['pass'] != "") {
            $pass = $_POST['pass'];
            $pass = hash("sha256", $pass);

            $consulta = "UPDATE $tabla SET contrasena='$pass' WHERE usuario='$user';";
            $update = mysql_query($consulta, $conexion);
            if (!$update) {
                echo "<p class='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br/>Disculpen las molestias.</p>";
            } else {
                echo "<p><strong>Contrase&ntilde;a cambiada</strong></p>";
            }
        } else {
            echo "<p><strong>Introduzca una contrase&ntilde;a</strong></p>";
        }
    }
} else {
    echo "<p class='center'>Su sesi&oacute;n ha caducado. Vuelva a iniciar sesi&oacute;n.</p>";
}
?>
</div>