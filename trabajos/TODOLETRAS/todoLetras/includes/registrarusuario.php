<div class="registrar">
    <?php
    include("conexion.php");

    $tabla = "usuarios";

    if (isset($_POST['enviar'])) {

        if (isset($_POST['user']) && $_POST['user'] != "" && filter_has_var(INPUT_POST, "user") && preg_match('/^[[:alnum:]]+$/', $_POST['user'])) {
            $user = filter_input(INPUT_POST, "user", FILTER_SANITIZE_STRING);
        } else
            $requeridos[] = "El campo Usuario no es v&aacute;lido. Formato: usuario01";

        if (isset($_POST['pass']) && $_POST['pass'] != "" && filter_has_var(INPUT_POST, "pass") && preg_match('/^[[:alnum:]]+$/', $_POST['pass'])) {
            $pass = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_STRING);
        } else
            $requeridos[] = "El campo Contrase&ntilde;a no es v&aacute;lido. Formato: contrasena80";

        if (isset($_POST['nombre']) && $_POST['nombre'] != "" && filter_has_var(INPUT_POST, "nombre") && preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]/', $_POST['nombre'])) {
            $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_STRING);
        } else
            $requeridos[] = "El campo Nombre no es v&aacute;lido. Formato: nombre";

        if (isset($_POST['apellidos']) && $_POST['apellidos'] != "" && filter_has_var(INPUT_POST, "apellidos") && preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]/', $_POST['apellidos'])) {
            $apellidos = filter_input(INPUT_POST, "apellidos", FILTER_SANITIZE_STRING);
        } else
            $requeridos[] = "El campo Apellidos no es v&aacute;lido. Formato: apellido apellido";

        if (filter_has_var(INPUT_POST, "sexo"))
            $sexo = $_POST['sexo'];
        else
            $requeridos[] = "El campo Sexo es obligatorio.";

        if (filter_has_var(INPUT_POST, "dia"))
            $dia = $_POST['dia'];
        else
            $requeridos[] = "El campo D&iacute;a de nacimiento es obligatorio.";

        if (filter_has_var(INPUT_POST, "mes"))
            $mes = $_POST['mes'];
        else
            $requeridos[] = "El campo Mes de nacimiento es obligatorio.";

        if (filter_has_var(INPUT_POST, "ano"))
            $ano = $_POST['ano'];
        else
            $requeridos[] = "El campo A&ntilde;o de nacimiento es obligatorio.";

        if (isset($_POST['dni']) && $_POST['dni'] != "" && filter_has_var(INPUT_POST, "dni") && preg_match('/^[[:digit:]]{8}[a-zA-Z]$/', $_POST['dni'])) {
            $dni = filter_input(INPUT_POST, "dni", FILTER_SANITIZE_STRING);
        } else
            $requeridos[] = "El campo Dni no es v&aacute;lido. Formato: 12345678X";


        if (!isset($requeridos)) {
            $pass = hash("sha256", $pass);
            $fecha = $dia . $mes . $ano;

            $sql = "SELECT * FROM $tabla WHERE usuario='$user';";
            $resultado = mysql_query($sql, $conexion);

            if (!$resultado || (mysql_numrows($resultado) < 1)) {
                $sql_insertar = "INSERT INTO $tabla VALUES ('$user','$pass','$nombre','$apellidos','$sexo','$fecha','$dni','user');";
                $resultado = mysql_query($sql_insertar, $conexion);
                if (!$resultado) {
                    echo "<p class='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br/>Disculpen las molestias.</p>";
                } else {
                    echo "<p class='center'>Registro del usuario <strong>$user</strong> completado.";
                    echo "<p class='center'><a href='login.php'>Iniciar sesion</a></p>";
                }
            } else {
                echo "<p align='center'>El usuario que ha escogido ya existe. Por favor, intentelo de nuevo con otro usuario.</p>";
                echo "<p class='center'><a href='registro.php'>Volver a intentarlo</a></p>";
                echo "<p class='center'><a href='index.php'>Volver a la pagina de inicio</a></p>";
            }
            mysql_close($conexion);
        }
    }
    if (!filter_has_var(INPUT_POST, "enviar") || isset($requeridos)) {
        if (isset($requeridos)) {
            echo '<p class="center"><strong>Atenci&oacute;n:</strong></p>';
            foreach ($requeridos as $error) {
                echo '<p class="center">' . $error . '</p>';
            }
            echo "<br/><p class='center'><a href='registro.php'>Volver a intentarlo</a></p>";
            echo "<p class='center'><a href='index.php'>Volver a la pagina de inicio</a></p>";
        }
    }
    ?>
</div>