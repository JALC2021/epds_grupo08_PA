<!DOCTYPE html>
<?php
session_start();

if (isset($_POST['login'])) {

    $con = mysqli_connect("localhost", "user1", "user1");

    if (!$con) {
        die("Conexión fallida");
    }

    $db_selected = mysqli_select_db($con, "epd6ej1");

    if (!$db_selected) {
        die("Conexión a basde de datos fallida");
    }

    $result = mysqli_query($con, "SELECT * FROM usuarios WHERE usuario like '" . $_POST['usuario'] . "' AND password like '" . $_POST['password'] . "';");

    if (!$result) {
        die("Error al ejecutar la consulta: " . mysqli_error($con));
    }
    if (mysqli_num_rows($result) < 1) {
        echo "El usuario no existe. Puede registrarse si lo desea.";
    } else {
        //actualizamos la última hora del acceso.
        $result2 = mysqli_query($con, "UPDATE usuarios SET last_access=now() WHERE usuario like '" . $_POST['usuario']  . "';");
        if (!$result2) {
            die("Error al ejecutar la consulta: " . mysqli_error($con));
        }
        $_SESSION['estado'] = TRUE;
        echo $_SESSION['url'];
        if (!isset($_SESSION['url'])) {
            $_SESSION['url'] = "index.php";
        }
        echo $_SESSION['url'];
        header("location:" . $_SESSION['url']);
    }
}
?>

<html>
    <head>

    </head>

    <body>
        <?PHP
        if (isset($_SESSION['registrado'])) {
            if ($_SESSION['registrado'] == TRUE) {
                echo "<h2>Se ha registrado con éxito. Puede logarse a continuarción</h2>";
                $_SESSION['registrado'] == FALSE;
            }
        }
        ?>
        <form method="POST" action="">
            <table>
                <tr><td>Usuario</td><td><input type="text" name="usuario" required autofocus /></td></tr>
                <tr><td>Password</td><td><input type="password" name="password" required /></td></tr>
                <tr><td><input type="submit" name="login" value="Login" /></td>
                    <td></td></tr>
            </table>
        </form>
        <form method="POST" action="./registro.php">
            <input type="submit" name="registro" value="Registro" />
        </form>
    </body>
</html>

