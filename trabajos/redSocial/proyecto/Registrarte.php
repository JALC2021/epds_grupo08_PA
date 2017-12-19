<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php require 'Bbdd.php'; ?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css" type="text/css"/>
        <title>Registro</title>
    </head>
    <?php
    if (isset($_POST['registro'])) {
        $nombre = $_POST['nombre'];
        $apellido1 = $_POST['apellido1'];
        $apellido2 = $_POST['apellido2'];
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];
        $conf_pwd = $_POST['conf_pwd'];
        $usuario = $_POST['usuario'];
        $telefono = $_POST['telefono'];
        $imagen = $_FILES['imagen']['name'];
        $tmp = $_FILES['imagen']['tmp_name'];
        $titulo = $_POST['title'];
        $local_move = "img";
        move_uploaded_file($tmp, $local_move . "/" . $imagen);
        registro($nombre, $apellido1, $apellido2, $email, $telefono, $pwd, $usuario, $conf_pwd, $imagen);
        header('Location: PagPrincipal.php');
    }
    ?>
    <body>
        <header>           
            <h1 class="logo">Work<em>2</em>Community</h1>         
            <nav>
                <ul>
                    <li><a href="PagPrincipal.php">Inicio</a></li>
                    <li><a href="#">Grupos</a></li>
                    <li><a href="#">Calendario</a></li>
                </ul>
            </nav>
        </header>

        <section id="section_registrarse">
            <form action="#" method="post" enctype="multipart/form-data">
                <p class="formularios_etiquetas">Nombre</p><input type="text" name="nombre">
                <p class="formularios_etiquetas">Primer apellido</p><input type="text" name="apellido1">
                <p class="formularios_etiquetas">Segundo apellido</p><input type="text" name="apellido2">
                <p class="formularios_etiquetas">Email</p><input type="email" name="email">
                <p class="formularios_etiquetas">Imágen</p><input type="file" name="imagen">
                <p class="formularios_etiquetas">Teléfono</p><input type="tel" name="telefono">
                <p class="formularios_etiquetas">Nombre de usuario (10 caracteres)</p><input type="text" name="usuario">
                <p class="formularios_etiquetas">Contraseña (8 caracteres)</p><input type="password" name="pwd">
                <p class="formularios_etiquetas">Confirmar contraseña</p><input type="password" name="conf_pwd">
                <button class="boton_enviar_registro" type="submit" name="registro">Enviar</button>
            </form>
        </section>
        <footer>
            <p>Realizado por:</p>
            <a class="enlace_personal" href="#">Antonio Flores Romero - </a> <!--podemos poner nuestro twiter o nuestra pagina de la upo-->
            <a class="enlace_personal" href="#">Jose Antonio Resurrecion - </a>
            <a class="enlace_personal" href="#">Juan Antonio López Cano</a>
        </footer>
    </body>
</html>
