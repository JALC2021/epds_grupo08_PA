<div class="iniciar-sesion">
    <?php
// SE BUSCARÁ, EL TIPO DEL USUARIO QUE INTRODUJO SU NOMBRE DE USUARIO Y SU CLAVE EN EL FORMULARIO, SÓLO SI ES NECESARIO.
    if (isset($_POST['user']) and isset($_POST['pass'])) { // Si se recibieron los valores POST "usuario" y "clave" (campos del formulario de index.php)...
        // Si se escribió algo en los cuadros de texto del formulario de index.php... (si no están vacíos).
        if ($_POST['user'] != "" and $_POST['pass'] != "") {
            // Datos generales para la aplicación web:
            include("conexion.php");
            $tabla1 = "usuarios";

            // Por comodidad...
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $pass = hash("sha256", $pass);

            // Instrucción SQL que selecciona los registros de la tabla de usuarios cuyos valores en las columnas usuario y clave coinciden con los introducidos en el formulario.
            $sql = "SELECT * FROM $tabla1 WHERE (usuario='$user' and contrasena='$pass');";

            $resultado = mysql_query($sql, $conexion);
            // Si no pudo realizarse la consulta...
            if (!$resultado) {
                echo "ERROR: No pudo realizarse la consulta en la tabla $tabla1.<br>\n";
            } else {
                // Si el número de filas (registros) de la consulta resultante es 0, o lo que es lo mismo:
                // Si no se encontró ningún registro en la tabla usuarios con ese nombre de usuario y esa clave...
                if (mysql_numrows($resultado) <= 0) {
                    echo "<p class='center'><strong>ERROR:</strong> Usuario no encontrado, no registrado o clave incorrecta.</p>";
                    echo "<p class='center'><a href='login.php'>Volver a intentarlo</a></p>";
                    echo "<p class='center'><a href='registro.php'>Registrarse</a></p>";
                } else {
                    $fila = mysql_fetch_array($resultado); // Obtener la primera fila (primer registro) de la consulta.
                    if (!$fila) {
                        echo "<p class='center'>Usuario incorrecto";
                        echo "<p class='center'><a href='login.php'>Volver a intentarlo</a></p>";
                        echo "<p class='center'><a href='../registro.php'>Registrarse</a></p>";
                    } else {
                        // Asignamos el valor del campo "tipo" del registro a la variable de sesión "tipo".
                        $_SESSION['tipo'] = $fila['tipo'];
                        $_SESSION['user'] = $fila['usuario'];
                        $_SESSION['pass'] = $fila['contrasena'];
                        echo "<p align='center'>Sesi&oacute;n iniciada con el usuario " . $_SESSION['user'] . ".<br><br><a href='index.php'>Seguir navegando></a>";
                        mysql_close($conexion);
                        header("Location: index.php");
                    }
                }
            }
            mysql_close($conexion);
            //header("Location: index.php");
        }
    }
    ?>
</div>

