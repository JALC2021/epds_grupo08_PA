<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0
    Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-
    strict.dtd">
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
    $pass = mysqli_real_escape_string($con, $_POST['password']);


    $result = mysqli_query($con, "SELECT * FROM usuario WHERE usuario like '" . $name . "';");

    if (!$result) {
    die("Error al ejecutar la consulta: " . mysqli_error($con));
    }

    if (mysqli_num_rows($result) < 1) {
    ?>
<script type="text/javascript">
    alert("Usuario y/o contraseña no válido.Vuelva a probar nuevamente");
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
setcookie("user", $name, time() + 30 * 60 * 60);
$_SESSION['estado'] = TRUE;
$_SESSION['user'] = $name;
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
    alert("Usuario y/o contraseña no válido.Vuelva a probar nuevamente");
</script>
<?PHP
}
}
} else if (isset($_POST['registro'])) {

if (preg_match("/^[[:upper:]][[:lower:]]{3,15}$/", $_POST['nombre']) && preg_match("/^[[:alnum:]]{6,15}$/", $_POST['password']) &&
preg_match("/^[[:alnum:]]{3,15}$/", $_POST['usuario']) && preg_match("/^[[:alnum:]]+@[[:lower:]]+\.[[:lower:]]+/", $_POST['email']) && preg_match("/^[[:alpha:]]{3,15}$/", $_POST['apellidos']) && preg_match("/^[[:alpha:]]{3,15}$/", $_POST['localidad'])) {
$con = connectDB();

if (!$con) {
die("Conexión fallida");
}

$db_selected = mysqli_select_db($con, "healthysocial");

if (!$db_selected) {
die("Conexión a basde de datos fallida");
}

//saneamos la entrada a la bbdd
$name = mysqli_real_escape_string($con, $_POST['nombre']);
$apellidos = mysqli_real_escape_string($con, $_POST['apellidos']);
$localidad = mysqli_real_escape_string($con, $_POST['localidad']);
$user = mysqli_real_escape_string($con, $_POST['usuario']);

$email = mysqli_real_escape_string($con, $_POST['email']);
$sexo = mysqli_real_escape_string($con, $_POST['sexo']);
//usamos el hash para insertarlo en la bbdd
$pass = password_hash(mysqli_real_escape_string($con, $_POST['password']), PASSWORD_DEFAULT);

$result = mysqli_query($con, "INSERT INTO `usuario` (`id_usuario`, `usuario`, `password`, `tipo`, `nombre`, `email`, `sexo`,`apellidos`, `localidad`)
            VALUES (NULL, '" . $user . "', '" . $pass . "', 'cliente', '" . $name . "', '" . $email . "', '" . $sexo . "', '" . $apellidos . "', '" . $localidad . "');");
if (!$result) {
die("Error al ejecutar la consulta: " . mysqli_error($con));
}
?>
<script type="text/javascript">
    alert("El usuario <?PHP echo $user ?> se ha registrado correctamente");
</script>
<?PHP
disconnectDB($con);
} else {

if (!preg_match('/^[[:alnum:]]{3,15}$/', $_POST['usuario'])) {
?>
}
<script type="text/javascript">
    alert("Usuario incorrecto. De 3 a 15 carácteres alfanuméricos");
</script>
<?PHP
}
if (!preg_match("/^[[:alnum:]]{6,15}$/", $_POST['password'])) {
?>

<script type="text/javascript">
    alert("La contraseña incorrecta. De 6 a 15 carácteres alfanuméricos");
</script>
<?PHP
}
if (!preg_match("/^[[:upper:]][[:lower:]]{3,15}$/", $_POST['nombre'])) {
?>

<script type="text/javascript">
    alert("No se ha introducido el nombre correctamente. La primera letra mayúscula y de 3 a 15 minúsculas");
</script>
<?PHP
}

if (!preg_match("/^[[:alnum:]]+@[[:lower:]]+\.[[:lower:]]+/", $_POST['email'])) {
?>

<script type="text/javascript">
    alert("No se ha introducido el email correctamente");
</script>
<?PHP
}
if (!preg_match("/^[[:alpha:]]{3,15}$/", $_POST['apellidos'])) {
?>

<script type="text/javascript">
    alert("No se ha introducido el apellido correctamente");
</script>
<?PHP
}
if (!preg_match("/^[[:alpha:]]{3,15}$/", $_POST['localidad'])) {
?>

<script type="text/javascript">
    alert("No se ha introducido la localizacion correctamente");
</script>
<?PHP
}
}
}
?>


<html xmlns="http://www.w3.org/1999/xhtml" >
    <head>
        <meta charset="UTF-8" />
        <title>SocialHealthy</title>
        <meta name="viewport" content="width=device-width, user-scalabe=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="css/style_log.css" />
        <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
        <script type="text/javascript" src="js/login.js" ></script>
    </head>
    <body>
        <div class="container"

             <div id="login">
                <div class="form-head">
                    <h1>Acceder</h1>
                </div>
                <div class="form">
                    <h2>SocialHealthy</h2>
                    <form action="#" method="post">

                        <div class="input-group">
                            <?PHP if (isset($_COOKIE['user'])) { ?>

                            <label >Usuario:</label>
                            <input type="text" name="usuario" value="<?PHP echo $_COOKIE['user']; ?>"class="form-control" autofocus required />

                            <?PHP } else {
                            ?>

                            <label >Usuario:</label>
                            <input type="text" name="usuario" class="form-control" autofocus="autofocus" required />

                            <?PHP }
                            ?>
                        </div>
                        <div class="input-group">
                            <label >Password:</label>
                            <input type="password" name="password" class="form-control" required />
                        </div>
                        <div id="buttonsContainer">
                            <input type="submit" name="login" class="button" id="btn-register-now"  value="Login" />

                            <div class="button" id="btn-register">
                                Registro
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div id="register" class="displayNone">
                <div class="form-head">
                    <h1>Registro</h1>
                </div>
                <div class="form">
                    <form action="#" method="POST">
                        <div class="input-group">
                            <label >Usuario:</label>
                            <input type="text" name="usuario" class="form-control" required />

                            <label >Password:</label>
                            <input type="password" name="password" class="form-control" required />
                        </div>
                        <div class="input-group">
                            <label >Nombre:</label>
                            <input type="text" name="nombre" class="form-control" required />
                            <span></span>
                            <label >Apellidos:</label>
                            <input type="text" name="apellidos" class="form-control" required />
                        </div>
                        <div class="input-group">
                            <label >Localidad:</label>
                            <input type="text" name="localidad" class="form-control" required />

                            <label >E-mail:</label>
                            <input type="text" name="email" class="form-control" required />
                        </div>
                        <div class="input-group">

                            <label >Hombre:</label><input type="radio" name="sexo" value="hombre"  required/>

                            <label >Mujer:</label><input type="radio" name="sexo" value="mujer"  required/>

                        </div>
                        <div id="buttonsContainer">
                            <input type="submit" name="registro" class="button" id="btn-register-now" value="Enviar"  />

                            <div class="button" id="btn-back">
                                < Login
                            </div>
                        </div>

                </div>
            </div>

            </form>

        </div>

        <?php
        include_once './footer.php';
        ?>

    </body>
</html>