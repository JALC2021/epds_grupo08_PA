<?php
session_start();

//añadimos la librería de funciones
require_once '../functions.php';

//si la variable de sessión de usuario está activa, entramos en la página
if (isset($_SESSION['usuario'])) {

    //nos conectamos a la base de datos
    $con = connectDB();

    $db_selected = selectDB($con);

    //al enviar el formulario de baja
    if (isset($_POST['enviar'])) {

//Validamos la nota

        if (preg_match("/^[0-9]$|^10$/", $_POST['nota'])) {

//saneamos la entrada a la bbdd
            $url = filter_input(INPUT_POST, "nota", FILTER_SANITIZE_NUMBER_INT);

//Se recogen los datos de interés y se insertan en la tabla estadísticas. Luego se elimina el usuario
            $datos = mysqli_query($con, "SELECT `id_usuario`,`nombre`, `apellidos`, `email`, `sexo`, `fecha_alta` FROM usuario WHERE `usuario` LIKE '" . $_SESSION['user'] . "';");
            if (!$datos) {
                die("Error al ejecutar la consulta: " . mysqli_error($con));
            }
            $datosUsu = mysqli_fetch_array($datos);
            $motivo = $_POST['motivo'];
            //añadimos a las estadísticas el motivo elegido por el usuario
            $sql = "INSERT INTO `estadisticasapp` (`id_usuario`, `nombre`, `apellidos`, `email`, `sexo`, `id_baja`, `num_motivo`, `nota`, `fecha_alta`, `fecha_baja`) "
                    . "               VALUES ('" . $datosUsu['id_usuario'] . "', '" . $datosUsu['nombre'] . "', '" . $datosUsu['apellidos'] . "', '" . $datosUsu['email'] . "', '" . $datosUsu['sexo'] . "', NULL, ".$motivo.", '" . $_POST['nota'] . "', '" . $datosUsu['fecha_alta'] . "', CURRENT_TIMESTAMP);";
//            $sql = INSERT INTO `estadisticasapp`(`id_usuario`, `nombre`, `apellidos`, `email`, `sexo`, `num_motivo`, nota, `fecha_alta`) VALUES ('" . $datosUsu['id_usuario'] . "','" . $datosUsu['nombre'] . "','" . $datosUsu['apellidos'] . "','" . $datosUsu['email'] . "','" . $datosUsu['sexo'] . "'," . $motivo . "," . $_POST['nota'] . ",'" . $datosUsu['fecha_alta'] . "';
            $estadisticas = mysqli_query($con, $sql);

            if (!$estadisticas) {
                die("Error al ejecutar la consulta: " . mysqli_error($con));
            }
            //eliminamos al usuario
            $usuario = mysqli_query($con, "DELETE FROM `usuario` WHERE `id_usuario`=" . $datosUsu['id_usuario'] . ";");
            if (!$usuario) {
                die("Error al ejecutar la consulta: " . mysqli_error($con));
            }
            ?>
            <script type="text/javascript">
                alert("Su valoración se ha enviado correctamente");
            </script>
            <?php
            header("location:despedida.php");
        } else {


            if (!preg_match('/^[0-9]$|^10$/', $_POST['nota'])) {
                ?>
                <script type="text/javascript">
                    alert("Formato de nota incorrecto. La calificación debe ser un número entero de una sóla cifra comprendido entre 0 y 10");
                </script>-->
                <?PHP
            }
        }
    }
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-
        strict.dtd">
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>SocialHealthy</title>
            <meta name="viewport" content="width=device-width, user-scalabe=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
            <link rel="stylesheet" type="text/css" href="../css/style_base.css" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
            <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
            <link rel="shortcut icon" type="image/x-icon" href="../images/logo2.png" />
            <script type="text/javascript">
                function comprobar(campo, expr) {
                    if (!expr.test(campo.value)) {
                        campo.value = "";

                        if (campo.getAttribute('id') == "nota") {
                            alert('El campo ' +
                                    campo.getAttribute('id') +
                                    ' debe tener el formato que se indica: 9');
                        }
                    }
                }

            </script>
        </head>
        <body>

            <?PHP include_once '../header.php'; ?>

            <div class="contendioPrincipal">

                <?PHP include_once './menuPrincipal.php'; ?>

                <section class="sectionModificar">

                    <div class="container">
                        <h2>Baja&nbsp;usuario</h2>
                        <!--formulario de baja-->
                        <form method="POST" action="#">

                            <div class="row">
                                <div class="col-25">
                                    <label>Motivo de la baja<span id="requerido">&nbsp;(*)</span></label>
                                </div>

                                <div class="col-75">

                                    <?php
                                    //mostramos los motivos
                                    for ($i = 1; $i < 4; $i++) {
                                        $motivo = mysqli_query($con, "SELECT `descripcion` FROM `motivo` WHERE `id_motivo`=" . $i . ";");
                                        if (!$motivo) {
                                            die("Error al ejecutar la consulta: " . mysqli_error($con));
                                        } else {
                                            $mot = mysqli_fetch_array($motivo);
                                        }
                                        ?>
                                        <div class="tipoBaja">
                                            <p><label><?php echo utf8_encode($mot['descripcion']) ?></label><input type="radio" name="motivo" value="<?php echo $i ?>" required /></p>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-25">
                                    <label>Nota<span id="requerido">&nbsp;(*)</span></label>
                                </div>
                                <div class="col-75">
                                    <input  type="number" id="nota"  name="nota" class="form-control"  min="0" max="10" placeholder="Introduzca un n&uacute;mero entre el 1 y 10" required />
                                </div>
                            </div>

                            <div id="buttonsContainer">
                                <input type="submit" name="enviar" class="button" id="btn-register-now" value="Enviar"  />
                            </div>

                            <div>
                                <div class="row">
                                    <div class="col-25" id="requerido">
                                        (*) Campo requerido
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>


                <?php
                include_once '../aside.php';
                ?>
            </div>

            <?php
            include_once '../footer.php';
        } else {
            //guardamos la url para volver a esta pagína en una variable de sesión y el tipo de usuario
            $_SESSION['url'] = "usuario/baja.php";
            $_SESSION['tipo'] = 'usuario';
            header("location:../login.php");
        }
        ?>
    </body>
</html>
