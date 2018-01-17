<!DOCTYPE html>
<?PHP
session_start();
require_once '../functions.php';

if (isset($_SESSION['usuario'])) {

    $con = connectDB();

    if (!$con) {
        die("Conexión fallida");
    }

    $user = $_SESSION['user'];
    $db_selected = mysqli_select_db($con, "healthysocial");

    if (isset($_POST['borrar'])) {

        $res4 = mysqli_query($con, "DELETE FROM `contenido` WHERE `id_contenido` = '" . $_POST['borrar'] . "';");

        echo $_POST['borrar'];

        if (!$res4) {
            die("Error al ejecutar la consulta: " . mysqli_error($con));
        }
    }



    $id_usuario = mysqli_query($con, "SELECT `id_usuario` FROM `usuario` WHERE `usuario` LIKE '" . $user . "';");

    $row1 = mysqli_fetch_array($id_usuario);

    $foto = mysqli_query($con, "SELECT `id_contenido`,`url` FROM `foto` WHERE `id_usuario` = '" . $row1['id_usuario'] . "';");

    if (!$db_selected) {
        die("Conexión a base de datos fallida");
    }


    disconnectDB($con);
    ?>

    <!--
    To change this license header, choose License Headers in Project Properties.
    To change this template file, choose Tools | Templates
    and open the template in the editor.
    -->
    <html>
        <head>
            <meta charset="UTF-8" />
            <title>SocialHealthy</title>
            <meta name="viewport" content="width=device-width, user-scalabe=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
            <link rel="stylesheet" type="text/css" href="../css/style_base.css" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
            <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
            <link rel="shortcut icon" type="image/x-icon" href="../images/logo2.png" />
        </head>

        <body>

            <?PHP include_once '../header.php'; ?>

            <div class="contendioPrincipal">

                <?PHP include_once './menuPrincipal.php'; ?>

                <section class="sectionPaginaPersonal">

                    <article>
                        <?PHP
                        while ($row = mysqli_fetch_array($foto)) {
                            ?> <img  class="imagenesArticulos" src="<?php echo $row['url']; ?>">
                            <?Php
                            $p = $row['id_contenido'];
                            ?>

                            <form method="post">
                                <button id="<?php echo $row['id_contenido']; ?>" name="like" class="botonesSection" style="font-size:24px"><i class="fa fa-thumbs-o-up" ></i></button>
                                <button id="<?php echo $row['id_contenido']; ?>" name="totallike" class="botonesSection" style="font-size:24px">Total <i class="fa fa-heart"></i></button>
                                <button id="<?php echo $row['id_contenido']; ?>" name="unlike" class="botonesSection"  style="font-size:24px"><i class="fa fa-thumbs-o-down"></i></button>
                                <button id="<?php echo $row['id_contenido']; ?>" name="comentario" class="botonesSection"  style="font-size:24px"><i class="fa fa-commenting-o"></i></button>

                                <input  type="submit" name="borrar" value="<?php echo $p; ?> "class="botonesSection"  style="font-size:24px" /><i class="fa fa-commenting-o"></i>
                            </form>

                            <?Php
                        }
                        ?>
                    </article>

                </section>

                <?Php
                include_once '../aside.php';
                ?>
            </div>

            <?php
            include_once '../footer.php';
        } else {
            $_SESSION['url'] = "usuario/pulicacionAmigos.php";
            $_SESSION['tipo'] = 'usuario';
            header("location:../login.php");
        }
        ?>
    </body>
</html>
