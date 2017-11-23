<!DOCTYPE html>
<?php
session_start();

if (isset($_POST['finalizar'])) {

    $con = mysqli_connect("localhost", "user1", "user1");

    if (!$con) {
        die("Conexión fallida");
    }

    $db_selected = mysqli_select_db($con, "epd6ej1");

    if (!$db_selected) {
        die("Conexión a basde de datos fallida");
    }
    
    //saneamos la entrada a la bbdd
    $name = mysqli_real_escape_string($conn, $_POST['nombre']);
    $user = mysqli_real_escape_string($conn, $_POST['usuario']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    $result = mysqli_query($con, "INSERT INTO usuarios VALUES ('" . $name . "','" . $user . "','" . $pass . "',now());");
    if (!$result) {
        die("Error al ejecutar la consulta: " . mysqli_error($con));
    }
    
    mysqli_close($con);
    $_SESSION['registrado'] = TRUE;
    header("location:login.php");
}
?>

<html>
    <head>

    </head>

    <body>
        Registro:
        <form method="POST" action="">
            <table>
                <tr><td>Nombre</td><td><input type="text" name="nombre" required autofocus /></td></tr>
                <tr><td>Usuario</td><td><input type="text" name="usuario" required  /></td></tr>
                <tr><td>Password</td><td><input type="password" name="password" required /></td></tr>
                <tr><td><input type="submit" name="finalizar" value="Finalizar" /></td></tr>
            </table>
        </form>
        <a href=login.php ><button>Inicio</button></a>
    </body>
</html>