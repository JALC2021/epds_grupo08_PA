<?php
session_start();
require 'Bbdd.php';
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<head>
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
       <h1 class="logo">Work<em>2</em>Community</h1> 
        <nav>
            <ul>
                <li><a href="PagPrincipal.php">Inicio</a></li>
                <li><a href="grupos.php">Grupos</a></li>
                <li><a href="#">Calendario</a></li>
            </ul>
        </nav>        
    </header>

    <?php
    if (isset($_POST['crear_grupo'])) {
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $tipo = $_POST['tipo'];
        $id_usuario = $_SESSION['id_usuario'];
        $titulo = crear_grupo($titulo, $descripcion, $tipo, $id_usuario);
    }
    ?>

    <?php
    if (isset($_SESSION['id_usuario'])) {
        ?>
        <form action="#" method="post">
            Titulo<input type="text" name="titulo">
            Descripcion<textarea style="resize: none;" name="descripcion" rows="3" cols="70"></textarea>
            Tipo<select name="tipo">
                <option value="0">Público</option>
                <option value="1">Privado</option>
            </select>
            <button type="submit" name="crear_grupo">Crear</button>
        </form>
        <?php
    }
    ?>
    <?php
    if (!isset($_SESSION['usuario'])) {
        ?>
        <aside>
            <form action="#" method="post">
                <input type="text" name="usuario" value="Nombre de usuario"><br>
                <input type="password" name="pwd" value="Contraseña"><br>
                <button type="submit" name="login">Entrar</button><br>
                ¿Todavia no eres usuario? <a href="Registrarte.php">Únete ahora</a>
            </form>
        </aside>
        <?php
    } else {
        ?> 
        <aside>
            <ul>
                <li><a class="active" href="nueva_publicacion.php">Nueva Publicación</a></li>
                <li><a class="active" href="nueva_grupo.php">Nuevo Grupo</a></li>
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