<?php
session_start();

require_once '../functions.php';

//si está activa la sesión del usuario entramos
if (isset($_SESSION['usuario'])) {

    //nos conectamos a la base de datos
    $con = connectDB();

    $db_selected = selectDB($con);
//si vamos a eliminar a un amigo a través del formulario, cogemos el id del amigo y lo eliminamos de la base de datos.
    if (isset($_POST['eliminar'])) {
        if (isset($_POST['id_usuario_eliminar'])) {

            $rowEliminar = mysqli_query($con, "delete from `amigo` where id_usuario_amigo = " . $_POST['id_usuario_eliminar'] . ";");

            if (!$rowEliminar) {
                die("Error al ejecutar la consulta: " . mysqli_error($con));
            }

            if (mysqli_affected_rows($con) > 0) {
                ?>
                <script type="text/javascript">
                    alert("Eliminado correctamente");
                </script>
                <?PHP
            }
        } else {
            echo "no ha seleccionado ningún usuario para eliminar";
        }
    }

    //consultamos el id_usuario
    $rowUsuario = mysqli_query($con, "SELECT `id_usuario` FROM `usuario` WHERE `usuario` LIKE '" . $_SESSION['user'] . "';");

    if (!$rowUsuario) {
        die("Error al ejecutar la consulta: " . mysqli_error($con));
    }
    //consultamos los amigos del usuario activo
    $idUsuario = mysqli_fetch_array($rowUsuario);
    $sql = "select id_usuario_amigo from amigo a where id_usuario = " . $idUsuario['id_usuario'] . " ";

    $rowUsuario = mysqli_query($con, $sql);

    if (!$rowUsuario) {
        die("Error al ejecutar la consulta: " . mysqli_error($con));
    }

    ?>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-
strict.dtd">
    <html>
        <head>
            <meta charset="UTF-8" />
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

                        if (campo.getAttribute('id') == "nombre") {
                            alert('El campo ' +
                                    campo.getAttribute('id') +
                                    ' debe tener la primera letra mayúscula y de 3 a 15 carácteres alfabéticos');
                        } else if (campo.getAttribute('id') == "apellidos") {
                            alert('El campo ' +
                                    campo.getAttribute('id') +
                                    ' debe tener de 1 a 15 carácteres alfabéticos');
                        } else if (campo.getAttribute('id') == "usuario") {
                            alert('El campo ' +
                                    campo.getAttribute('id') +
                                    ' debe tener de 3 a 15 carácteres alfanuméricos');

                        } else if (campo.getAttribute('id') == "localidad") {
                            alert('El campo ' +
                                    campo.getAttribute('id') +
                                    ' debe tener de 1 a 15 carácteres alfabéticos');
                        } else if (campo.getAttribute('id') == "email") {
                            alert('El campo ' +
                                    campo.getAttribute('id') +
                                    ' no se ha introducido correctamente.Ej:ejemplo@ejemplo.com');
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

                        <h2>Eliminar amigos</h2>

                        <?PHP
                        //sin no tiene amigos, se muestra el mensaje en pantalla.
                        if (mysqli_num_rows($rowUsuario) == 0) {
                            echo "<p>No tienes amigos actualmente</p>";
                        } 
                        //si tiene amigos se muestran por pantalla.
                        else {
                            ?>
                            <form method="POST">
                                <table class="eliminarAmigos">
                                    <tr><th></th><th>Usuario</th><th>Nombre</th><th>Apellidos</th><th>Email</th><th>localidad</th></tr>
                                    <?PHP
                                    while ($usuarios = mysqli_fetch_array($rowUsuario)) {
                                        $rowIdAmigo = mysqli_query($con, "select * from usuario where id_usuario = " . $usuarios['id_usuario_amigo'] . ";");
                                        if (!$rowIdAmigo) {
                                            die("Error al ejecutar la consulta: " . mysqli_error($con));
                                        }

                                        $idAmigo = mysqli_fetch_array($rowIdAmigo);
                                        ?>
                                    <tr><td><input type="radio" name="id_usuario_eliminar" value="<?PHP echo $idAmigo['id_usuario'] ?>"/></td><td><i class="fa fa-user-o" style="color:#ef8d17;"></i>&nbsp;<?PHP echo $idAmigo['usuario'] ?></td><td><?PHP echo $idAmigo['nombre'] ?></td><td><?PHP echo $idAmigo['apellidos'] ?></td><td><?PHP echo $idAmigo['email'] ?></td><td><?PHP echo $idAmigo['localidad'] ?></td></tr>
                                        
                                        <?PHP
                                    }
                                    ?>
                                </table>
                                <input type="submit" name="eliminar" value="Eliminar" />
                            </form>

                            <?PHP
                        }
                        disconnectDB($con);
                        ?>

                </section>


                <?php
                include_once '../aside.php';
                ?>
            </div>

            <?php
            include_once '../footer.php';
        } else {
            //guardamos la url para volver a esta pagína en una variable de sesión y el tipo de usuario
            $_SESSION['url'] = "usuario/eliminarAmigos.php";
            $_SESSION['tipo'] = 'usuario';
            header("location:../login.php");
        }
        ?>
    </body>
</html>









