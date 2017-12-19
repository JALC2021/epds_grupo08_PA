<?php
session_start();
require 'Bbdd.php';
?><!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Work2Community</title>
    </head>
    <body>

        <?php
        if (isset($_POST['enviar_mensaje'])) {
            
        }

        $id_usuario_destino = $_POST['id_usuario_destino'];
        $id_usuario_origen = $_POST['id_usuario_origen'];
        $id_pub = $_POST['id_pub'];

        $result = consultar_publicacion_con_id_publicacion($id_pub);
        $row = mysqli_fetch_array($result);
        ?>
   
        <article style = "background-color: rgb(215, 250, 205); width: 100%; padding: 0%; margin: 5%;"><?php
            echo '<br>';
            ?>
            <img style="margin-bottom: 2%; margin-top:1.5%; margin-right: 3%; margin-left: 3%;width: 12%; height: 12%; float: left;" src="img/<?php echo $row2['imagen']; ?>">
            <?php
            echo '<b>Usuario - </b>' . $row['nombre_usuario'] . '<br>';
            echo '<b>Titulo - </b>' . $row['titulo'] . '<br>';
            echo '<b>Descripcion - </b>' . $row['descripcion'] . '<br>';
            echo '<b>Ciudad - </b>' . $row['ciudad'] . '<br>';
            echo '<b>Hora - </b>' . $row['hora'] . '<br>';
            echo '<b>Fecha del evento - </b>' . $row['fecha_evento'] . '<br>';
            echo '<b>Creado el - </b>' . $row['fecha_creacion'] . '<br><br>';
            ?>
            <form action="#" method="post">
                <textarea style="resize: none;min-width: 50%;max-width: 50%">Escriba aqui su mensaje...</textarea>
                <button type="submit" name="enviar_mensaje">Enviar mensaje</button>
            </form>
        </article>


        <footer>
            <p>Realizado por:</p>
            <a class="enlace_personal" href="#">Antonio Flores Romero - </a> <!--podemos poner nuestro twiter o nuestra pagina de la upo-->
            <a class="enlace_personal" href="#">Jose Antonio Resurrecion - </a>
            <a class="enlace_personal" href="#">Juan Antonio López Cano</a>
        </footer>
    </body>
</html>
