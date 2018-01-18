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

    if (!$db_selected) {
        die("Conexión a base de datos fallida");
    }

    //consultamos el id_usuario
    $id_usuario = mysqli_query($con, "SELECT `id_usuario` FROM `usuario` WHERE `usuario` LIKE '" . $user . "';");

    if (!$id_usuario) {
        die("Error al ejecutar la consulta: " . mysqli_error($con));
    }

    $row = mysqli_fetch_array($id_usuario);

    if (!$row) {
        die("Error al ejecutar la consulta: " . mysqli_error($con));
    }

    //si queremos borrar un contenido
    if (isset($_POST['like']) || isset($_POST['unlike']) || isset($_POST['comentario']) || isset($_POST['borrar'])) {

        if (isset($_POST['borrar'])) {
            $row1 = mysqli_query($con, "DELETE FROM `contenido` WHERE `id_contenido` = '" . $_POST['borrar'] . "';");

            if (!$row1) {
                die("Error al ejecutar la consulta: " . mysqli_error($con));
            }
        } else if (isset($_POST['like'])) {
            $row2 = mysqli_query($con, "SELECT * FROM `voto` WHERE `id_contenido` = " . $_POST['like'] . " and id_usuario = " . $row['id_usuario'] . ";");

            if (!$row2) {
                die("Error al ejecutar la consulta: " . mysqli_error($con));
            }
            if (mysqli_num_rows($row2) == 0) {
                $row1 = mysqli_query($con, "INSERT INTO `voto` (`id_voto`, `id_contenido`, `id_usuario`) VALUES (NULL, '" . $_POST['like'] . "', '" . $row['id_usuario'] . "');");
                if (!$row1) {
                    die("Error al ejecutar la consulta: " . mysqli_error($con));
                }
            }
        } else if (isset($_POST['unlike'])) {
            $row1 = mysqli_query($con, "DELETE FROM `voto` WHERE `id_contenido` = " . $_POST['unlike'] . " and id_usuario = " . $row['id_usuario'] . ";");

            if (!$row1) {
                die("Error al ejecutar la consulta: " . mysqli_error($con));
            }
        } else if (isset($_POST['comentario'])) {

            $row1 = mysqli_query($con, "INSERT INTO `comentario` (`id_comentario`, `id_usuario`, `id_contenido`, `texto`) VALUES (NULL, '" . $row['id_usuario'] . "', '" . $_POST['comentario'] . "', '" . $_POST['comment'] . "');");

            if (!$row1) {
                die("Error al ejecutar la consulta: " . mysqli_error($con));
            }
        }
    }



    //obtenemos el contenido del usuario
    $rowContenido = mysqli_query($con, "SELECT * FROM `contenido` WHERE `id_usuario` = " . $row['id_usuario'] . " ORDER BY `id_contenido` DESC");

    if (!$rowContenido) {
        die("Error al ejecutar la consulta: " . mysqli_error($con));
    }
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
                        while ($contenido = mysqli_fetch_array($rowContenido)) {

                            //realizamo una consulta para ver si el contenido tiene una foto asociada
                            $rowFoto = mysqli_query($con, "SELECT url FROM `foto` WHERE `id_contenido` = " . $contenido['id_contenido'] . ";");

                            if (!$rowFoto) {
                                die("Error al ejecutar la consulta: " . mysqli_error($con));
                            }

                            //si hay 1 fila de una foto, se mostrará por pantalla
                            if (mysqli_num_rows($rowFoto) == 1) {
                                $foto = mysqli_fetch_array($rowFoto);
                                ?> <img  class="imagenesArticulos" src="<?php echo $foto['url']; ?>">
                                <?PHP
                            }
                            ?>
                            <p><b>Descripci&oacute;n: </b><?PHP echo $contenido['descripcion']; ?></p>
                            <?PHP
                            //comprobamos si el contenido es de deportes,alimentación o suplementos
                            $rowAlimentacion = mysqli_query($con, "SELECT * FROM `contenido` NATURAL JOIN `alimentacion` WHERE `id_contenido` = " . $contenido['id_contenido'] . ";");
                            $rowDeportes = mysqli_query($con, "SELECT * FROM `contenido` NATURAL JOIN `deportes` WHERE `id_contenido` = " . $contenido['id_contenido'] . ";");
                            $rowSuplemento = mysqli_query($con, "SELECT * FROM `contenido` NATURAL JOIN `suplemento` WHERE `id_contenido` = " . $contenido['id_contenido'] . ";");

                            if (mysqli_num_rows($rowAlimentacion) == 1) {
                                $alimentacion = mysqli_fetch_array($rowAlimentacion);
                                ?><p><b>Dieta o estudio: </b><?PHP echo $alimentacion['dieta_estudio']; ?></p>
                                <p><b>Tipo: </b><?PHP echo $alimentacion['tipo']; ?></p>
                                <p><b>Duraci&oacute;n: </b><?PHP echo $alimentacion['duracion']; ?></p><?PHP
                            } else if (mysqli_num_rows($rowDeportes) == 1) {
                                $deportes = mysqli_fetch_array($rowDeportes);
                                ?><p><b>Nivel: </b><?PHP echo $deportes['nivel']; ?></p>
                                <p><b>Localicaci&oacute;n: </b><?PHP echo $deportes['localizacion']; ?></p>
                                <p><b>Tipo: </b><?PHP echo $deportes['tipo']; ?></p>
                                <p><b>Duraci&oacute;n: </b><?PHP echo $deportes['duracion']; ?></p><?PHP
                            } else if (mysqli_num_rows($rowSuplemento) == 1) {
                                $suplemento = mysqli_fetch_array($rowSuplemento);
                                ?><p><b>Dosis: </b><?PHP echo $suplemento['dosis']; ?></p>
                                <p><b>Tipo: </b><?PHP echo $suplemento['tipo']; ?></p>
                                <p><b>Duraci&oacute;n: </b><?PHP echo $suplemento['duracion']; ?></p><?PHP
                            }
                            //consultamos el total de votos
                            $rowVoto = mysqli_query($con, "select count(*) as \"totalVotos\" from voto where id_contenido = " . $contenido['id_contenido'] . ";");
                            if (!$rowVoto) {
                                die("Error al ejecutar la consulta: " . mysqli_error($con));
                            }

                            $votos = mysqli_fetch_array($rowVoto);


                            $p = $contenido['id_contenido'];
                            ?>
                            <form method="post">
                                <button type="submit" value="<?PHP echo $p; ?>"  name="like" class="botonesSection" style="font-size:24px"><i class="fa fa-thumbs-o-up" ></i></button>
                                <button class="botonesSection" style="font-size:24px">Total <?PHP echo $votos['totalVotos']; ?><i class="fa fa-heart"></i></button>
                                <button type="submit" value="<?PHP echo $p; ?>" name="unlike" class="botonesSection"  style="font-size:24px"><i class="fa fa-thumbs-o-down"></i></button>
                                <button  type="submit" value="<?PHP echo $p; ?>"  name="borrar"  class="botonesSection"  style="font-size:24px" /><i class="fa fa-trash"></i></button>
                            </form>
                            <?PHP
                            $rowComentario = mysqli_query($con, "SELECT * FROM `comentario` WHERE `id_contenido` = " . $p . ";");

                            if (!$rowComentario) {
                                die("Error al ejecutar la consulta: " . mysqli_error($con));
                            }

                            if (mysqli_num_rows($rowComentario) > 0) {

                                while ($comentario = mysqli_fetch_array($rowComentario)) {
                                    
                                    $rowUser = mysqli_query($con, "SELECT usuario FROM `usuario` WHERE `id_usuario` = " . $comentario['id_usuario'] . ";");

                                    if (!$rowUser) {
                                        die("Error al ejecutar la consulta: " . mysqli_error($con));
                                    }
                                    $usuario = mysqli_fetch_array($rowUser);
                                    ?><p><b>Usuario: </b><?PHP echo $usuario['usuario'];; ?></p>
                                    <p><b>Escribi&oacute;: </b><?PHP echo $comentario['texto'] ?></p><?PHP
                                }
                            }
                            ?>
                            <form method="post">
                                <input type="text" name="comment" />
                                <button type="submit" value="<?PHP echo $p; ?>" name="comentario" class="botonesSection"  style="font-size:24px" ><i class="fa fa-commenting-o"></i></button>
                            </form>
                                    <hr />
                            <?PHP
                        }
                        ?>
                    </article>

                </section>

                <?Php
                disconnectDB($con);
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
