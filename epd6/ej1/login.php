<!DOCTYPE html>
<?php
session_start();

//si el usuario se pulsa el submit de login
if (isset($_POST['login'])) {

    //realizamos la conexión a la bbdd con el usuario user1
    $con = mysqli_connect("localhost", "user1", "user1");

    if (!$con) {
        die("Conexión fallida");
    }

    //nos conectamos a la bbdd epd6ej1
    $db_selected = mysqli_select_db($con, "epd6ej1");

    if (!$db_selected) {
        die("Conexión a basde de datos fallida");
    }

    //realizamos una consulta con el mismo nombre y password recibido del formulario
    $result = mysqli_query($con, "SELECT * FROM usuarios WHERE usuario like '" . $_POST['usuario'] . "' AND password like '" . $_POST['password'] . "';");

    if (!$result) {
        die("Error al ejecutar la consulta: " . mysqli_error($con));
    }
    //si la consulta nos ha devuelto menor a 1 fila, no ha encontrado nada y les mostraremos nuevamente el formulario.
    if (mysqli_num_rows($result) < 1) {
        echo "El usuario no existe. Puede registrarse si lo desea.";
    } else {
        //actualizamos la última hora del acceso.
        $result2 = mysqli_query($con, "UPDATE usuarios SET last_access=now() WHERE usuario like '" . $_POST['usuario']  . "';");
        if (!$result2) {
            die("Error al ejecutar la consulta: " . mysqli_error($con));
        }
        //cerramos la conexión a la base de datos.
        mysqli_close($con);
        //variable superglobal que nos infica si estamos conectados.
        $_SESSION['estado'] = TRUE;
        
        //si no hay url almacenada, se almacenará la página principal.
        if (!isset($_SESSION['url'])) {
            $_SESSION['url'] = "index.php";
        }
        //nos dirigimos a la dirección almacenada en la variable superglobal
        header("location:" . $_SESSION['url']);
    }
}
?>

<html>
    <head>

    </head>

    <body>
        <?PHP
        //si el usuario se ha registrado se mostrará un mensaje por pantalla
        if (isset($_SESSION['registrado'])) {
            if ($_SESSION['registrado'] == TRUE) {
                echo "<p><strong>Se ha registrado con éxito. Puede logarse a continuarción</strong></p>";
                $_SESSION['registrado'] == FALSE;
            }
        }
        ?>
        <!-- formulario -->
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

