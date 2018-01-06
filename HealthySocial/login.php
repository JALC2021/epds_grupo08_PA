<!DOCTYPE html>
<?php
session_start();

require_once './functions.php';

if (isset($_POST['login'])) {

    $con = connectDB();

    $db_selected = mysqli_select_db($con, "healthysocial");

    if (!$db_selected) {
        die("Conexión a basde de datos fallida");
    }

    //sanear la entrada
    $name = mysqli_real_escape_string($con, $_POST['usuario']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);


    $result = mysqli_query($con, "SELECT * FROM usuario WHERE usuario like '" . $name . "';");

    if (!$result) {
        die("Error al ejecutar la consulta: " . mysqli_error($con));
    }

    if (mysqli_num_rows($result) < 1) {
        ?>
        <script type="text/javascript">
            alert("El usuario <?PHP echo $name ?> no existe. Puede registrarse si lo desea");
        </script>
        <?PHP
    } else {
        $fila = mysqli_fetch_array($result);

        //comprobamos si el hash de la contraseña del formulario coincide con la almacenada en la bbdd
        if (password_verify($pass, $fila['password'])) {

            //actualizamos la última hora del acceso.
            $result2 = mysqli_query($con, "UPDATE usuario SET ultimo_acceso=now() WHERE usuario like '" . $name . "';");
            if (!$result2) {
                die("Error al ejecutar la consulta: " . mysqli_error($con));
            }

            disconnectDB($con);
            //guardamos la cookie con el nombre del usuario durante 30 días
            setcookie("user", $name, time() + 30*60*60);
            $_SESSION['estado'] = TRUE;
            echo $_SESSION['url'];
            if (!isset($_SESSION['url'])) {
                $_SESSION['url'] = "index.php";
            }
            echo $_SESSION['url'];
            header("location:" . $_SESSION['url']);
            //si no coincide vuelve a mostrar la página de login.
        } else {
            ?>
            <script type="text/javascript">
                alert("Contraseña no válida. Vuelva a introducirla nuevamente");
            </script>
            <?PHP
        }
    }
} else if (isset($_POST['registro'])) {

    $con = mysqli_connect("localhost", "user1", "user1");

    if (!$con) {
        die("Conexión fallida");
    }

    $db_selected = mysqli_select_db($con, "healthysocial");

    if (!$db_selected) {
        die("Conexión a basde de datos fallida");
    }

    //saneamos la entrada a la bbdd
    $name = mysqli_real_escape_string($con, $_POST['nombre']);
    $user = mysqli_real_escape_string($con, $_POST['usuario']);
    //usamos el hash para insertarlo en la bbdd
    $pass = password_hash(mysqli_real_escape_string($con, $_POST['pass']), PASSWORD_DEFAULT);

    $result = mysqli_query($con, "INSERT INTO `usuario` (`id_usuario`, `usuario`, `password`, `tipo`, `nombre`, `email`, `sexo`)
            VALUES (NULL, '" . $user . "', '" . $pass . "', 'cliente', '" . $name . "', '" . $_POST['email'] . "', '" . $_POST['sexo'] . "');");
    if (!$result) {
        die("Error al ejecutar la consulta: " . mysqli_error($con));
    }
    ?>
    <script type="text/javascript">
        alert("El usuario <?PHP echo $user ?> se ha registrado correctamente");
    </script>
    <?PHP
    disconnectDB($con);
    $_SESSION['registrado'] = TRUE;
    // header("location:login.php");
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, minimum-scale=0.25, maximum-scale=1.6, initial-scale=1.0" />
        <title>SocialHealthy</title>

        <link href="https://fonts.googleapis.com/css?family=Comfortaa|Lobster" rel="stylesheet"> 
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/d5eb75cec9.css">
        <script type="text/javascript" src="js/functions.js"></script>
        <link rel="stylesheet" href="css/style.css">
        <style>
            body{
                background-image: url(images/background.jpg);
                background-repeat: not-repeat;
                background-attachment: fixed;
                background-size: cover;
            }
        </style>



    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-md-4 col-sm-2 col-xs-1"></div>
                <div class="col-xl-4 col-md-4 col-sm-8 col-xs-10" id="container-form">
                    <div id="login">
                        <div id="loginHead" class="form-head">
                            <h1>Acceder</h1>
                        </div>
                        <div id="loginForm" class="form">
                            <h2>SocialHealthy</h2>
                            <form action="#" method="POST">
                                <div class="input-group">
                                    <span class="input-group-addon" aria-hidden="true" id="user"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
                                    <?PHP if(isset($_COOKIE['user'])) { ?>
                                    <input type="text" name="usuario" value="<?PHP echo $_COOKIE['user']; ?>" class="form-control" aria-describedby="basic-addon1" autofocus required>
                                        <?PHP } else{
                                        ?>
                                        <input type="text" name="usuario" class="form-control" aria-describedby="basic-addon1" autofocus required>
                                        <?PHP }
                                    ?>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon" aria-hidden="true" id="pass"><i class="fa fa-unlock" aria-hidden="true"></i></span>
                                    <input type="password" name="pass" class="form-control" aria-describedby="basic-addon1" required>
                                </div>
                                <div id="buttonsContainer">
                                    <input type="submit" name="login" value="Login" class="button" id="btn-register-now" />
                                    <div class="button" id="btn-register">Registro</div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div id="register">
                        <div id="registerHead" class="form-head">
                            <h1>Registro</h1>
                        </div>
                        <div id="registerForm" class="form">
                            <!--<h2>Are you new?</h2>-->
                            <form action="#" method="POST">
                                <div class="input-group">
                                    <label >Usuario:</label>
                                    <input type="text" name="usuario" class="form-control" aria-describedby="basic-addon1" required>
                                </div>
                                <div class="input-group">
                                    <label >Password:</label>
                                    <input type="password" name="pass" class="form-control" aria-describedby="basic-addon1" required>
                                </div>
                                <div class="input-group">
                                    <label >Nombre:</label>
                                    <input type="text" name="nombre" class="form-control" aria-describedby="basic-addon1" required>
                                </div>
                                <div class="input-group">
                                    <label >E-mail:</label>
                                    <input type="text" name="email" class="form-control" aria-describedby="basic-addon1" required>
                                </div>
                                <div class="input-group">
                                    <label >Sexo:</label>

                                    <label >Hombre:</label><input type="radio" name="sexo" value="hombre" required/>

                                    <label >Mujer:</label><input type="radio" name="sexo" value="mujer"  required/>
                                </div>

                                <div id="buttonsContainer">
                                    <div class="button" id="btn-back">< Login</div>

                                    <input type="submit" name="registro" value="Enviar" class="button" id="btn-register-now" />

                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-xl-4 col-md-4 col-sm-2 col-xs-1"></div>
            </div>
        </div>
    </body>
</html>