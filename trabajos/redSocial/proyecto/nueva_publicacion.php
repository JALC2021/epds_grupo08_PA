<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require 'Bbdd.php';
session_start();

if (isset($_POST['nueva_publicacion'])) {
    $nombre_usuario = $_SESSION['usuario'];
    crear_publicacion($_POST['descripcion'], $_POST['ciudad'], $_POST['direccion'], $_POST['hora'], $_POST['titulo'], $_POST['fecha_evento'], $_SESSION['id_usuario'], $nombre_usuario, $_POST['tipo']);
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css" type="text/css"/>
        <title>Work2Community</title>
    </head>
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

        <section id="section_nuevaPublicacion">
            <form action="#" method="post">
                Titulo<br><input type="text" name="titulo"><br>               
                Ciudad<br><input type="text" name="ciudad"><br>
                Dirección<br><input type="text" name="direccion"><br>
                Hora del evento  <input type="time" name="hora" value="11:45" max="23:59" min="10:00" step="1">
                Fecha del evento <input type="date" name="fecha_evento" step="1" value="<?php echo date("Y-m-d") ?>">
                Tipo <select id="selectorTipo" name="tipo">
                    <option value="0">Pública</option>
                    <option value="1">Privada</option>
                </select><br>
                Descripción <textarea style="resize: none;" name="descripcion" rows="4" cols="20">
                </textarea>
                <button type="submit" name="nueva_publicacion">Enviar</button>
            </form>
        </section>
        <?php
        if (!isset($_SESSION['usuario'])) {
            ?>
            <aside>
                <form action="#" method="post">
                    Usuario: <input type="text" name="usuario"><br>
                    Contraseña: <input type="password" name="contraseña"><br>
                    <button type="submit" name="login">Entrar</button><br>
                    <a href="Registrarte.php">¿No estas registrado? Pincha aqui</a>
                </form>
            </aside>
            <?php
        } else {
            ?> 
            <aside id="aside_nueva_publicacion">
                <ul class="contenido_aside_nuevaPublicacion">
                    <li><a class="active" href="nueva_publicacion.php">Nueva Publicación</a></li>
                    <li><a href="perfil_usuario.php">Mi Perfil</a></li>                   
                    <li><a href="mis_mensajes.php">Mis Mensajes</a></li>
                </ul>
            </aside>
            <?php
        }
        ?>
        <footer>
            <p>Realizado por:</p>
            <a class="enlace_personal" href="#">Antonio Flores Romero - </a> <!--podemos poner nuestro twiter o nuestra pagina de la upo-->
            <a class="enlace_personal" href="#">Jose Antonio Resurrecion - </a>
            <a class="enlace_personal" href="#">Juan Antonio López Cano</a>
        </footer>
    </body>
</html>
