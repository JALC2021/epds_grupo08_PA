<?PHP
require_once '../functions.php';

//si tenemos sesión activa entramos
if (isset($_SESSION['usuario'])) {

    //nos conectamos a la bse de datos.
    $con = connectDB();
    $db_selected = selectDB($con);
    
    
//consultamos el id_usuario
    $user = $_SESSION['user'];
    $id_usuario = mysqli_query($con, "SELECT `id_usuario` FROM `usuario` WHERE `usuario` LIKE '" . $user . "';");

    if (!$id_usuario) {
        die("Error al ejecutar la consulta: " . mysqli_error($con));
    }

    $row = mysqli_fetch_array($id_usuario);

    if (!$row) {
        die("Error al ejecutar la consulta: " . mysqli_error($con));
    }

//si queremos modificar el comentario

    if (isset($_POST['modificarDescripcion'])) {
        if (preg_match("/^([a-zA-ZÁÉÍÓÚñáéíóú?¿!!<>\*\.0-9]*[\s]*)+$/", $_POST['nuevaDescripcion'])) {
            $row1 = mysqli_query($con, "UPDATE `contenido` SET `descripcion` = '" . $_POST['nuevaDescripcion'] . "' WHERE `contenido`.`id_contenido` = " . $_POST['modificarDescripcion'] . ";");

            if (!$row1) {
                die("Error al ejecutar la consulta: " . mysqli_error($con));
            }
        } else {
            ?>  
            <script type="text/javascript">
                alert("La descripción debe contener carácteres alfanuméricos");
            </script>
            <?PHP
        }
    }

    //formulario de modificar foto
    if (isset($_POST['modificarFoto'])) {

        $row1 = mysqli_query($con, "UPDATE `foto` SET `url` = '" . $_POST['nuevaFoto'] . "' WHERE `id_foto` = " . $_POST['modificarFoto'] . ";");

        if (!$row1) {
            die("Error al ejecutar la consulta: " . mysqli_error($con));
        }
    }
    //formulario de insertar una foto
    if (isset($_POST['insertarFoto'])) {

        $row1 = mysqli_query($con, "INSERT INTO `foto` (`id_foto`, `id_usuario`, `id_contenido`, `url`) VALUES (NULL, '" . $row['id_usuario'] . "', '" . $_POST['insertarFoto'] . "', '" . $_POST['nuevaFoto'] . "');");

        if (!$row1) {
            die("Error al ejecutar la consulta: " . mysqli_error($con));
        }
    }
    
    //formulario de modificar un foto
    if (isset($_POST['modificarComentario'])) {

        if (preg_match("/^([a-zA-ZÁÉÍÓÚñáéíóú?¿!!<>\*\.0-9]*[\s]*)+$/", $_POST['nuevoComentario' . $_POST['modificarComentario']])) {
            $row1 = mysqli_query($con, "UPDATE `comentario` SET `texto` = '" . $_POST['nuevoComentario' . $_POST['modificarComentario']] . "' WHERE `comentario`.`id_comentario` = " . $_POST['modificarComentario'] . ";");

            if (!$row1) {
                die("Error al ejecutar la consulta: " . mysqli_error($con));
            }
        } else {
            ?>  
            <script type="text/javascript">
                alert("El comentario debe contener carácteres alfanuméricos");
            </script>
            <?PHP
        }
    }
    //formulario de eliminar un comentario
    if (isset($_POST['eliminarComentario'])) {
        $row1 = mysqli_query($con, "DELETE FROM `comentario` WHERE `id_comentario` = '" . $_POST['eliminarComentario'] . "';");

        if (!$row1) {
            die("Error al ejecutar la consulta: " . mysqli_error($con));
        }

        if (mysqli_affected_rows($con)) {
            ?>  
            <script type="text/javascript">
                alert("El comentario se ha eliminado correctamente");
            </script>
            <?PHP
        }
    }
    //formulario de eliminar una foto
    if (isset($_POST['eliminarFoto'])) {
        $row1 = mysqli_query($con, "DELETE FROM `foto` WHERE `id_foto` = '" . $_POST['eliminarFoto'] . "';");

        if (!$row1) {
            die("Error al ejecutar la consulta: " . mysqli_error($con));
        }

        if (mysqli_affected_rows($con)) {
            ?>  
            <script type="text/javascript">
                alert("La foto se ha eliminado correctamente");
            </script>
            <?PHP
        }
    }




//si queremos dar a me gusta o eliminar un me gusta, insertar un comentario o borrar un contenido
    if (isset($_POST['like']) || isset($_POST['unlike']) || isset($_POST['comentario']) || isset($_POST['borrar'])) {
        //eliminar un comentario
        if (isset($_POST['borrar'])) {
            $row1 = mysqli_query($con, "DELETE FROM `contenido` WHERE `id_contenido` = '" . $_POST['borrar'] . "';");

            if (!$row1) {
                die("Error al ejecutar la consulta: " . mysqli_error($con));
            }
            //insertar un me gusta
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
            //borrar un me gusta
        } else if (isset($_POST['unlike'])) {
            $row1 = mysqli_query($con, "DELETE FROM `voto` WHERE `id_contenido` = " . $_POST['unlike'] . " and id_usuario = " . $row['id_usuario'] . ";");

            if (!$row1) {
                die("Error al ejecutar la consulta: " . mysqli_error($con));
            }
            //insertar un comentario
        } else if (isset($_POST['comentario'])) {

            if (preg_match("/^([a-zA-ZÁÉÍÓÚñáéíóú?¿!!<>\*\.0-9]*[\s]*)+$/", $_POST['comentario'])) {
                $row1 = mysqli_query($con, "INSERT INTO `comentario` (`id_comentario`, `id_usuario`, `id_contenido`, `texto`) VALUES (NULL, '" . $row['id_usuario'] . "', '" . $_POST['comentario'] . "', '" . $_POST['comment'] . "');");

                if (!$row1) {
                    die("Error al ejecutar la consulta: " . mysqli_error($con));
                }
            } else {
                ?>  
                <script type="text/javascript">
                    alert("El comentario debe contener carácteres alfanuméricos");
                </script>
                <?PHP
            }
        }
    }


    if ($_SESSION['amigo'] == TRUE) {
//obtenemos el contenido del usuario amigo
        $rowContenido = mysqli_query($con, "SELECT * FROM `contenido` c , `amigo` a WHERE c.id_usuario = a.id_usuario_amigo and a.`id_usuario` = " . $row['id_usuario'] . " ORDER BY `id_contenido` DESC");
    } else {
//obtenemos el contenido del usuario
        $rowContenido = mysqli_query($con, "SELECT * FROM `contenido` WHERE `id_usuario` = " . $row['id_usuario'] . " ORDER BY `id_contenido` DESC");
    }



    if (!$rowContenido) {
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
        </head>

        <body>
            
            <script>
                <!-- mantenemos la posición actual de la página al enviar el formulario -->
                window.onload = function () {
                    var pos = window.name || 0;
                    window.scrollTo(0, pos);
                }
                window.onunload = function () {
                    window.name = self.pageYOffset || (document.documentElement.scrollTop + document.documentElement.scrollTop);
                }
                <!--mostar la descripción-->
                function mostrarDescripcion(id) {


                    if (document.getElementById("mostrarDescripcion" + id).getAttribute("style") == "display:none") {
                        document.getElementById("mostrarDescripcion" + id).setAttribute("style", "display:block");
                    } else {
                        document.getElementById("mostrarDescripcion" + id).setAttribute("style", "display:none");

                    }
                }
                <!--mostrar la foto-->
                function mostrarFoto(id) {


                    if (document.getElementById("mostrarFoto" + id).getAttribute("style") == "display:none") {
                        document.getElementById("mostrarFoto" + id).setAttribute("style", "display:block");
                    } else {
                        document.getElementById("mostrarFoto" + id).setAttribute("style", "display:none");
                    }
                }
                <!--mostar comentario-->
                function mostrarComentario(id) {

                    if (document.getElementById("mostrarComentario" + id).getAttribute("style") == "display:none") {
                        document.getElementById("mostrarComentario" + id).setAttribute("style", "display:block");
                    } else {
                        document.getElementById("mostrarComentario" + id).setAttribute("style", "display:none");
                    }
                }
<!--comprobar las entradas con expresiones regulares-->
                function comprobar(campo, expr) {
                    if (!expr.test(campo.value)) {
                        campo.value = "";

                        if (campo.getAttribute('id') === "descripcion") {
                            alert('El campo ' +
                                    campo.getAttribute('id') +
                                    ' debe tener carácteres alfanuméricos');
                        }

                        if (campo.getAttribute('id') === "comentario") {
                            alert('El campo ' +
                                    campo.getAttribute('id') +
                                    ' debe tener carácteres alfanuméricos');
                        }
                    }
                }
            </script>

            <?PHP include_once '../header.php'; ?>

            <div class="contendioPrincipal">

                <?PHP include_once './menuPrincipal.php'; ?>

                <section class="sectionPaginaPersonal">
                    <?PHP
                    if ($_SESSION['amigo'] == TRUE) {
                        ?><h2>Publicaciones Amigos</h2><?PHP
                    } else {
                        ?><h2>Publicaciones Personales</h2><?PHP
                    }
                    ?>

                    <article>
                        <?PHP
                        //si no hay contenido que mostrar
                        if (mysqli_num_rows($rowContenido) == 0) {
                            //mensaje para sesión amigo
                            if ($_SESSION['amigo'] == TRUE) {
                                ?><p>Para iniciar la actividad, debes agregar primeramente 
                                    a un amigo en la secci&oacute;n "AGREGAR" situado en el
                                    panel a la izquierda de la pantalla</p><?PHP
                                    //mensaje para sesión personal
                            } else {
                                ?><p>Para iniciar la actividad, debes publicar primeramente 
                                    un contenido en la secci&oacute;n "PUBLICAR" situado en el
                                    panel a la izquierda de la pantalla</p><?PHP
                            }
                            ?>

                            <?PHP
                            //si hay contenido que mostrar
                        } else {
                    //mientras haya resultado de contenido
                            while ($contenido = mysqli_fetch_array($rowContenido)) {
                                ?><form method="post"><?php
                                    //realizamo una consulta para ver si el contenido tiene una foto asociada
                                    $rowFoto = mysqli_query($con, "SELECT * FROM `foto` WHERE `id_contenido` = " . $contenido['id_contenido'] . ";");

                                    if (!$rowFoto) {
                                        die("Error al ejecutar la consulta: " . mysqli_error($con));
                                    }
                                    if ($_SESSION['amigo'] == TRUE) {
                                        $rowAmigo = mysqli_query($con, "SELECT usuario FROM `usuario` WHERE `id_usuario` = " . $contenido['id_usuario_amigo'] . ";");
                                        if (!$rowAmigo) {
                                            die("Error al ejecutar la consulta: " . mysqli_error($con));
                                        }
                                        $amigo = mysqli_fetch_array($rowAmigo);
                                        ?> 
                                        <p><b><i class="fa fa-user-circle" style="font-size:20px;color:#ef8d17;"></i></b>&nbsp;&nbsp;<?PHP echo $amigo['usuario']; ?></p>

                                        <?PHP
                                    }
                                    //si hay 1 fila de una foto, se mostrará por pantalla
                                    if (mysqli_num_rows($rowFoto) == 1) {
                                        $foto = mysqli_fetch_array($rowFoto);
                                        ?> 
                                        <figure>
                                            <img  class="imagenesArticulos" src="<?php echo $foto['url']; ?>">

                                            <?PHP
                                            //si la sesión es personal mostraremos mostrar o eliminar foto
                                            if ($_SESSION['amigo'] == FALSE) { ?>

                                                <label class="labelSection" onclick="mostrarFoto(<?PHP echo $foto['id_foto'] ?>)" style="font-size:20px"><i class="fa fa-picture-o"></i></label>

                                                <div class="botones" id="<?PHP echo "mostrarFoto" . $foto['id_foto'] ?>" style="display:none" >
                                                    <input id="nuevaFoto" type="url" name="nuevaFoto" placeholder="Introduzca url y pulse &#xf044;&nbsp;&#xf03e;&nbsp;para editar &oacute;&nbsp;&#xf146;&nbsp;&#xf03e;&nbsp;para eliminar." style="font-family:FontAwesome;width: 70%" /> 
                                                    <button class="botonesSection" type="submit" name="modificarFoto" value="<?PHP echo $foto['id_foto'] ?>" style="font-size:20px"><i class="fa fa-edit"></i>&nbsp;<i class="fa fa-picture-o"></i></button>
                                                    <button class="botonesSection" type="submit" name="eliminarFoto" value="<?PHP echo $foto['id_foto'] ?>" style="font-size:20px"><i class="fa fa-minus-square"></i>&nbsp;<i class="fa fa-picture-o"></i></button>
                                                </div>

                                                <?PHP
                                            }
                                        } else {
                                            //si no tiene foto podrá insertarla
                                            if ($_SESSION['amigo'] == FALSE) {
                                                ?>

                                                <label class="labelSection" onclick="mostrarFoto(<?PHP echo $contenido['id_contenido'] ?>)" style="font-size:20px"><i class="fa fa-picture-o"></i></label>
                                                <div class="botones" id="<?PHP echo "mostrarFoto" . $contenido['id_contenido'] ?>" style="display:none" >
                                                    <input id="nuevaFoto" type="url" name="nuevaFoto" placeholder="Introduzca url y pulse &#xf0fe;&nbsp;&#xf03e;" style="font-family:FontAwesome;width: 70%" /> 
                                                    <button class="botonesSection" type="submit" name="insertarFoto" value="<?PHP echo $contenido['id_contenido'] ?>" style="font-size:20px"><i class="fa fa-plus-square"></i>&nbsp;<i class="fa fa-picture-o"></i></button>
                                                </div>

                                                <?PHP
                                            }
                                        }
                                        ?>
                                        <!--parte de descripcion-->
                                        <p id="descripcion"><b><u>Descripci&oacute;n:</u>&nbsp;</b><?PHP echo $contenido['descripcion']; ?></p>
                                        <?PHP 
                                        //si la sesión es personal podrá modificar o eliminar la descripción
                                        if ($_SESSION['amigo'] == FALSE) { ?>
                                            <label class="labelSection" onclick="mostrarDescripcion(<?PHP echo $contenido['id_contenido'] ?>)" style="font-size:20px"><i class="fa fa-align-justify"></i></label>
                                            <div class="botones" id="<?PHP echo "mostrarDescripcion" . $contenido['id_contenido'] ?>" style="display:none" >
                                                <input id="descripcion" type="text" name="nuevaDescripcion" onchange="comprobar(this, /^([a-zA-ZÁÉÍÓÚñáéíóú?¿!!<>\*\.0-9]*[\s]*)+$/)" placeholder="Introduzca descripci&oacute;n y pulse &#xf044;&nbsp;&#xf039;&nbsp;para editarlo." style="font-family:FontAwesome;width: 70%" /> 
                                                <button class="botonesSection" type="submit" name="modificarDescripcion" value="<?PHP echo $contenido['id_contenido'] ?>" style="font-size:20px"><i class="fa fa-edit"></i>&nbsp;<i class="fa fa-align-justify"></i></button>
                                            </div>

                                            <?PHP
                                        }
                                        //comprobamos si el contenido es de deportes,alimentación o suplementos
                                        $rowAlimentacion = mysqli_query($con, "SELECT * FROM `contenido` NATURAL JOIN `alimentacion` WHERE `id_contenido` = " . $contenido['id_contenido'] . ";");
                                        $rowDeportes = mysqli_query($con, "SELECT * FROM `contenido` NATURAL JOIN `deportes` WHERE `id_contenido` = " . $contenido['id_contenido'] . ";");
                                        $rowSuplemento = mysqli_query($con, "SELECT * FROM `contenido` NATURAL JOIN `suplemento` WHERE `id_contenido` = " . $contenido['id_contenido'] . ";");

                                        //contenido de alimentación
                                        if (mysqli_num_rows($rowAlimentacion) == 1) {
                                            $alimentacion = mysqli_fetch_array($rowAlimentacion);
                                            ?>
                                            <p><b><u>Tipo:</u>&nbsp;&nbsp;</b><?PHP echo $alimentacion['dieta_estudio']; ?>&nbsp;&nbsp;-&nbsp;&nbsp;<b><u>Alimentaci&oacute;n:</u>&nbsp;&nbsp;&nbsp;&nbsp;</b><?PHP echo $alimentacion['tipo']; ?>&nbsp;&nbsp;-&nbsp;&nbsp;<b><u>Duraci&oacute;n:</u>&nbsp;&nbsp;&nbsp;&nbsp;</b><?PHP echo $alimentacion['duracion']; ?></p>                                      
                                            <?PHP
                                            //contenido de deportes
                                        } else if (mysqli_num_rows($rowDeportes) == 1) {
                                            $deportes = mysqli_fetch_array($rowDeportes);
                                            ?>

                                            <p><b><u>Nivel:</u>&nbsp;&nbsp;&nbsp;&nbsp;</b><?PHP echo $deportes['nivel']; ?>&nbsp;&nbsp;-&nbsp;&nbsp; <b><u>Localicaci&oacute;n:</u>&nbsp;&nbsp;&nbsp;&nbsp;</b><?PHP echo $deportes['localizacion']; ?>&nbsp;&nbsp;-&nbsp;&nbsp;<b><u>Deporte:</u>&nbsp;&nbsp;&nbsp;&nbsp;</b><?PHP echo $deportes['tipo']; ?>&nbsp;&nbsp;-&nbsp;&nbsp;<b><u>Duraci&oacute;n:</u>&nbsp;&nbsp;&nbsp;&nbsp;</b><?PHP echo $deportes['duracion']; ?></p>
                                            <?PHP
                                            //contenido de suplementos
                                        } else if (mysqli_num_rows($rowSuplemento) == 1) {
                                            $suplemento = mysqli_fetch_array($rowSuplemento);
                                            ?>
                                            <p><b><u>Dosis:</u>&nbsp;&nbsp;&nbsp;&nbsp;</b><?PHP echo $suplemento['dosis']; ?>&nbsp;&nbsp;-&nbsp;&nbsp;<b><u>Tipo suplemento:</u>&nbsp;&nbsp;&nbsp;&nbsp;</b><?PHP echo $suplemento['tipo']; ?>&nbsp;&nbsp;-&nbsp;&nbsp;<b><u>Duraci&oacute;n:</u>&nbsp;&nbsp;&nbsp;&nbsp;</b><?PHP echo $suplemento['duracion']; ?></p>
                                            <?PHP
                                        }
                                        ?>

                                    </figure>
                                    <?php
                                    //consultamos el total de votos
                                    $rowVoto = mysqli_query($con, "select count(*) as \"totalVotos\" from voto where id_contenido = " . $contenido['id_contenido'] . ";");
                                    if (!$rowVoto) {
                                        die("Error al ejecutar la consulta: " . mysqli_error($con));
                                    }

                                    $votos = mysqli_fetch_array($rowVoto);
                                    $idContenido = $contenido['id_contenido'];
                                    ?>

                                    <div class="botones">
                                        <button id="megusta" class="botonesSection" type="submit" value="<?PHP echo $idContenido; ?>"  name="like"  style="font-size:20px"><i class="fa fa-thumbs-o-up" ></i></button>
                                        <button class="botonesSection" type=button"  style="font-size:20px"><?PHP echo $votos['totalVotos']; ?> <i class="fa fa-heart"></i></button>
                                        <button class="botonesSection" type="submit" value="<?PHP echo $idContenido; ?>" name="unlike"  style="font-size:20px"><i class="fa fa-thumbs-o-down"></i></button>                     
                                        <button class="botonesSection" type="submit" value="<?PHP echo $idContenido; ?>" name="comentario"  style="font-size:20px" ><i class="fa fa-commenting"></i></button>                              
                                        <?PHP
                                        if ($_SESSION['amigo'] == FALSE) {
                                            ?> <button class="botonesSection" type="submit" value="<?PHP echo $idContenido; ?>"  name="borrar"  style="font-size:20px" /><i class="fa fa-trash"></i></button>
                                            <?PHP }
                                            ?>
                                        <input id="comentario" onchange="comprobar(this, /^([a-zA-ZÁÉÍÓÚñáéíóú?¿!!<>\*\.0-9]*[\s]*)+$/)" type="text" name="comment" class=comentarioPersonal" placeholder="Introduzca comentario y pulse &#xf27a; para insertar &oacute; &#xf0e6;&nbsp; para ver todos comentarios." style="font-family:FontAwesome;width: 70%" />
                                    </div>
                                    <?PHP
                                    $rowComentario = mysqli_query($con, "SELECT * FROM `comentario` WHERE `id_contenido` = " . $idContenido . ";");

                                    if (!$rowComentario) {
                                        die("Error al ejecutar la consulta: " . mysqli_error($con));
                                    }
                                    //si hay comentarios se muestran
                                    if (mysqli_num_rows($rowComentario) > 0) {
                                        ?><label class="labelSection"  onclick="mostrarComentario(<?PHP echo $contenido['id_contenido'] ?>)" style="font-size:20px"><i class="fa fa-comments-o"></i></label>
                                        <div class="botones" id="<?PHP echo "mostrarComentario" . $contenido['id_contenido'] ?>" style="display:none" ><?php
                                            while ($comentario = mysqli_fetch_array($rowComentario)) {

                                                $rowUser = mysqli_query($con, "SELECT usuario FROM `usuario` WHERE `id_usuario` = " . $comentario['id_usuario'] . ";");

                                                if (!$rowUser) {
                                                    die("Error al ejecutar la consulta: " . mysqli_error($con));
                                                }
                                                $usuario = mysqli_fetch_array($rowUser);
                                                ?><p><i class="fa fa-user-o">&nbsp;</i><b><u><?PHP echo $usuario['usuario']; ?>:</u> </b><?PHP echo $comentario['texto'] ?> </p>

                                                <!--Modificar comentario si eres el propietario del mismo-->
                                                <?PHP if ($row['id_usuario'] == $comentario['id_usuario']) { ?>
                                                    <label id="comentario" class="labelSection" onclick="mostrarComentario(<?PHP echo $comentario['id_comentario'] ?>)" style="font-size:20px"><i class="fa fa-cogs">&nbsp;</i><i class="fa fa-comments-o"></i></label>
                                                    <div class="botones" id="<?PHP echo "mostrarComentario" . $comentario['id_comentario'] ?>" style="display:none" >
                                                        <input id="comentario" type="text" onchange="comprobar(this, /^([a-zA-ZÁÉÍÓÚñáéíóú?¿!!<>\*\.0-9]*[\s]*)+$/)" name="<?PHP echo "nuevoComentario" . $comentario['id_comentario'] ?>" placeholder="Introduzca el comentario y pulse &#xf044;&nbsp;&#xf0e6;&nbsp;para editar &oacute;&nbsp;&#xf146;&nbsp;&#xf0e6;&nbsp;para eliminar." style="font-family:FontAwesome;width: 70%" /> 
                                                        <button class="botonesSection" type="submit" name="modificarComentario"  value="<?PHP echo $comentario['id_comentario'] ?>" style="font-size:20px"><i class="fa fa-edit"></i>&nbsp;<i class="fa fa-comments-o"></i></button>
                                                        <button class="botonesSection" type="submit" name="eliminarComentario"  value="<?PHP echo $comentario['id_comentario'] ?>" style="font-size:20px"><i class="fa fa-minus-square"></i>&nbsp;<i class="fa fa-comments-o"></i></button>
                                                    </div><?PHP
                                                }
                                            }
                                            ?></div><?php
                                    }
                                    ?>
                                </form>
                                <hr />
                                <?PHP
                            }
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
            //guardamos la url para volver a esta pagína en una variable de sesión y el tipo de usuario
            if ($_SESSION['amigo'] == TRUE) {
                $_SESSION['url'] = "usuario/publicacionAmigos.php";
            } else {
                $_SESSION['url'] = "usuario/publicacionesPersonales.php";
            }
            $_SESSION['tipo'] = 'usuario';
            header("location:../login.php");
        }
        ?>
    </body>
</html>
