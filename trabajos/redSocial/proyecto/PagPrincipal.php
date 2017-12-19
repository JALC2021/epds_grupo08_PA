<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
require 'Bbdd.php';
?>
<html>
    <head>
        <!--ICONOS DE GOOGLE-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <!--adaptar nuestro sitio a dispositivos moviles.-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <meta name="description" content="resumen del contenido dela página">
        <link rel="stylesheet" href="style.css" type="text/css"/>
        <!--enlazamos nuestra librería Jquery.-->
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <!--contenido javaScript-->
        <script type="text/javascript">


        </script>

        <title>Work2Community</title>
    </head>
    <?php
    if (isset($_POST['login'])) {
        $usuario = $_POST['usuario'];
        $pwd = $_POST['pwd'];
        if ($usuario != null && $pwd != null) {
            $enc = login($usuario, $pwd);
            if ($enc) {
                header('Location: PagPrincipal.php');
            }
        }
    }
    ?>
    <body>  
        <header>           
            <p class="logo">Work<em>2</em>Community</p> 
            <nav>
                <ul>
                    <li><a href="PagPrincipal.php">Inicio</a></li>
                    <li><a href="#">Calendario</a></li>   
                    <li><a href="grupos.php">Grupos</a></li>

                    <!--ICONOS DE GOOGLE-->
<!--                    <li><a href="PagPrincipal.php"><i class="material-icons">home</i></a></li>
                    <li><a href="grupos.php"><i class="material-icons">groups</i></a></li>
                    <li><a href="#"><i class="material-icons">perm_contact_calendar</i></a></li>                  -->
                </ul>
            </nav>
        </header>
        <section id="section_paginaPrincipal">
            <?php
            if (!isset($_SESSION['id_usuario'])) {
                $result = consultar_publicacion_publica();
                while ($row = mysqli_fetch_array($result)) {
                    $result2 = consultar_imagen_usuario($row['id_usuario']);
                    $row2 = mysqli_fetch_array($result2);
                    if ($row2['imagen'] == "") {
                        ?>
                        <article><?php
                            echo '<br>';
                            ?>
                            <form method="post" action="usuario_publicacion.php">
                                <input type="image" src="img/perfil_global.png" name="usuario_perfil" width="120" height="120">
                                <input type="hidden" name="usuario_perfil" value="<?php echo $row['nombre_usuario']; ?>">
                                <?php
                                echo '<b>Usuario - </b>' . $row['nombre_usuario'] . '<br>';
                                echo '<b>Titulo - </b>' . $row['titulo'] . '<br>';
                                echo '<b>Descripcion - </b>' . $row['descripcion'] . '<br>';
                                echo '<b>Ciudad - </b>' . $row['ciudad'] . '<br>';
                                echo '<b>Hora - </b>' . $row['hora'] . '<br>';
                                echo '<b>Fecha del evento - </b>' . $row['fecha_evento'] . '<br>';
                                echo '<b>Creado el - </b>' . $row['fecha_creacion'] . '<br><br>';
                                ?>
                            </form>
                            <?php
                            ?>
                        </article><?php
                    } else {
                        ?>
                        <article><?php
                            echo '<br>';
                            ?>
                            <form method="post" action="usuario_publicacion.php">
                                <input type="image" src="img/<?php echo $row2['imagen']; ?>" name="usuario_perfil" width="120" height="120">
                                <input type="hidden" name="usuario_perfil" value="<?php echo $row['nombre_usuario']; ?>">
                                <?php
                                echo '<b>Usuario - </b>' . $row['nombre_usuario'] . '<br>';
                                echo '<b>Titulo - </b>' . $row['titulo'] . '<br>';
                                echo '<b>Descripcion - </b>' . $row['descripcion'] . '<br>';
                                echo '<b>Ciudad - </b>' . $row['ciudad'] . '<br>';
                                echo '<b>Hora - </b>' . $row['hora'] . '<br>';
                                echo '<b>Fecha del evento - </b>' . $row['fecha_evento'] . '<br>';
                                echo '<b>Creado el - </b>' . $row['fecha_creacion'] . '<br><br>';
                                ?>
                            </form>
                        </article><?php
                    }
                }
            } else {
                $result = consultar_publicacion_publica_y_privada();
                while ($row = mysqli_fetch_array($result)) {
                    $result2 = consultar_imagen_usuario($row['id_usuario']);
                    $row2 = mysqli_fetch_array($result2);
                    if ($row2['imagen'] == "") {
                        ?>
                        <article><?php
                            echo '<br>';
                            ?>
                            <form method="post" action="usuario_publicacion.php">
                                <input type="image" src="img/perfil_global.png" name="usuario_perfil" width="120" height="120">
                                <input type="hidden" name="usuario_perfil" value="<?php echo $row['nombre_usuario']; ?>">
                                <?php
                                echo '<b>Usuario - </b>' . $row['nombre_usuario'] . '<br>';
                                echo '<b>Titulo - </b>' . $row['titulo'] . '<br>';
                                echo '<b>Descripcion - </b>' . $row['descripcion'] . '<br>';
                                echo '<b>Ciudad - </b>' . $row['ciudad'] . '<br>';
                                echo '<b>Hora - </b>' . $row['hora'] . '<br>';
                                echo '<b>Fecha del evento - </b>' . $row['fecha_evento'] . '<br>';
                                echo '<b>Creado el - </b>' . $row['fecha_creacion'] . '<br><br>';
                                ?>
                            </form>
                            <form action="contactar_usuario.php" method="post">
                                <input type="hidden" name="id_usuario_destino" value="<?php echo $row['id_usuario']; ?>">
                                <input type="hidden" name="id_usuario_origen" value="<?php echo $_SESSION['id_usuario']; ?>">
                                <input type="hidden" name="id_pub" value="<?php echo $row['id_pub']; ?>">
                                <button name="boton_contactat">Contactar</button>
                            </form>
                            <?php
                            ?>
                        </article><?php
                    } else {
                        ?>
                        <article><?php
                            echo '<br>';
                            ?>
                            <form method="post" action="usuario_publicacion.php">
                                <input type="image" src="img/<?php echo $row2['imagen']; ?>" name="usuario_perfil" width="120" height="120">
                                <input type="hidden" name="usuario_perfil" value="<?php echo $row['nombre_usuario']; ?>">
                                <?php
                                echo '<b>Usuario - </b>' . $row['nombre_usuario'] . '<br>';
                                echo '<b>Titulo - </b>' . $row['titulo'] . '<br>';
                                echo '<b>Descripcion - </b>' . $row['descripcion'] . '<br>';
                                echo '<b>Ciudad - </b>' . $row['ciudad'] . '<br>';
                                echo '<b>Hora - </b>' . $row['hora'] . '<br>';
                                echo '<b>Fecha del evento - </b>' . $row['fecha_evento'] . '<br>';
                                echo '<b>Creado el - </b>' . $row['fecha_creacion'] . '<br><br>';
                                ?>
                            </form>
                            <form action="contactar_usuario.php" method="post">
                                <input type="hidden" name="id_usuario_destino" value="<?php echo $row['id_usuario']; ?>">
                                <input type="hidden" name="id_usuario_origen" value="<?php echo $_SESSION['id_usuario']; ?>">
                                <input type="hidden" name="id_pub" value="<?php echo $row['id_pub']; ?>">
                                <button type="submit" name="boton_contactat">Contactar</button>
                            </form>
                        </article><?php
                    }
                }
            }
            ?>
        </section>

        <?php
        if (!isset($_SESSION['usuario'])) {
            ?>
            <aside id="aside_paginaPrincipal">
                <form  action="#" method="post">
                    Usuario:<input type="text" name="usuario"><br>
                    Contraseña:<input type="password" name="pwd"><br>
                    <button class="boton_entrar_pagPrincipal" type="submit" name="login">Entrar</button>
                    <p id="pregunta_registrado">¿No estas registrado? <a class="enlace_registro" href="Registrarte.php">Pincha aqui.</p></a>
                </form>
            </aside>
            <?php
        } else {
            ?> 


            <aside id="aside_registrado">
                <ul class="contenido_aside_registrado">
                    <li><a class="active" href="nueva_publicacion.php">Nueva Publicación</a></li>
                    <li><a href="perfil_usuario.php">Mi Perfil</a></li>                   
                    <li><a href="mis_mensajes.php">Mis Mensajes</a></li>
                </ul>
            </aside>
            <?php
        }
        ?>
        <footer>

            Realizado por: <a class="enlace_personal" href="#">Antonio Flores Romero - </a> <!--podemos poner nuestro twiter o nuestra pagina de la upo-->
            <a class="enlace_personal" href="#">Jose Antonio Resurrecion - </a>
            <a class="enlace_personal" href="#">Juan Antonio López Cano</a>
        </footer>

    </body>
</html>
