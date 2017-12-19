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

if (isset($_POST['unirme_publico_logueado'])) {
    $id_grupo = $_POST['hidden_idgrupo'];
    $id_usuario = $_SESSION['id_usuario'];
    unirse_grupo($id_grupo, $id_usuario);
}

if (isset($_POST['unirme_publico_no_logueado'])) {
    header('Location: PagPrincipal.php');
}

if (isset($_POST['unirme_privado_logueado'])) {
    $id_usuario_destino = $_POST['hidden_id_usuario_destino'];
    $id_usuario_origen = $_SESSION['id_usuario'];
    $id_grupo = $_POST['hidden_idgrupo'];
    crear_solicitud($id_usuario_destino, $id_usuario_origen, $id_grupo);
    header('Location: PagPrincipal.php');
}

if (isset($_POST['unirme_privado_no_logueado'])) {
    header('Location: PagPrincipal.php');
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

    <section id="aside_grupos">
        <article class="grupos_publicos">
            <?php
            $result = consultar_grupo(0);
            while ($row = mysqli_fetch_array($result)) {
                if (!isset($_SESSION['id_usuario'])) {
                    ?>
                    <form action="#" method="post">
                        <?php
                        echo '<b>Titulo - </b>' . $row['titulo'] . '<br>';
                        echo '<b>Descripcion - </b>' . $row['descripcion'] . '<br><br>';
                        ?>
                        <input type="hidden" name="hidden_idgrupo" value="<?php echo $row['id_grupo']; ?>">
                        <button type="submit" name="unirme_publico_no_logueado">Inicia sesion o registrate para unirte a este grupo</button>
                    </form>
                    <?php
                    echo '<hr>';
                    ?>
                    <?php
                } else if ($_SESSION['id_usuario'] == $row['id_usuario_propietario']) {
                    ?>
                    <form action="#" method="post">
                        <?php
                        echo '<b>Titulo - </b>' . $row['titulo'] . '<br>';
                        echo '<b>Descripcion - </b>' . $row['descripcion'] . '<br><br>';
                        ?>
                        <h4>Ya perteneces a este grupo</h4>
                    </form>
                    <?php
                    echo '<hr>';
                    ?>
                    <?php
                } else {
                    ?>
                    <form action="#" method="post">
                        <?php
                        echo '<b>Titulo - </b>' . $row['titulo'] . '<br>';
                        echo '<b>Descripcion - </b>' . $row['descripcion'] . '<br><br>';
                        ?>
                        <input type="hidden" name="hidden_idgrupo" value="<?php echo $row['id_grupo']; ?>">
                        <button type="submit" name="unirme_publico_logueado">Unirme</button>
                    </form>
                    <?php
                    echo '<hr>';
                    ?>
                    <?php
                }
            }
            ?>
        </article>
        <article class="grupos_privados">
            <?php
            $result = consultar_grupo(1);
            while ($row = mysqli_fetch_array($result)) {
                if (!isset($_SESSION['id_usuario'])) {
                    ?>
                    <form action="#" method="post">
                        <?php
                        echo '<b>Titulo - </b>' . $row['titulo'] . '<br>';
                        echo '<b>Descripcion - </b>' . $row['descripcion'] . '<br><br>';
                        ?>
                        <input type="hidden" name="hidden_idgrupo" value="<?php echo $row['id_grupo']; ?>">
                        <button type="submit" name="unirme_privado_no_logueado">Inicia sesion o registrate para unirte a este grupo</button>
                    </form>
                    <?php
                    echo '<hr>';
                    ?>
                    <?php
                } else if (isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'] == $row['id_usuario']) {
                    ?>
                    <form action="#" method="post">
                        <?php
                        echo '<b>Titulo - </b>' . $row['titulo'] . '<br>';
                        echo '<b>Descripcion - </b>' . $row['descripcion'] . '<br><br>';
                        ?>
                        <h6>Ya perteneces a este grupo</h6>
                    </form>
                    <?php
                    echo '<hr>';
                    ?>
                    <?php
                } else {
                    ?>
                    <form action="#" method="post">
                        <?php
                        echo '<b>Titulo - </b>' . $row['titulo'] . '<br>';
                        echo '<b>Descripcion - </b>' . $row['descripcion'] . '<br><br>';
                        $_SESSION['id_grupo'] = $row['id_grupo'];
                        $_SESSION['id_usuario_destino'] = $row['id_usuario'];
                        $_SESSION['id_usuario_origen'] = $_SESSION['id_usuario'];
                        ?>
                        <input type="hidden" name="hidden_idgrupo" value="<?php echo $row['id_grupo']; ?>">
                        <input type="hidden" name="hidden_id_usuario_destino" value="<?php echo $row['id_usuario']; ?>">
                        <button type="submit" name="unirme_privado_logueado">Enviar solicitud al grupo</button>
                    </form>
                    <?php
                    echo '<hr>';
                    ?>
                    <?php
                }
            }
            ?>
        </article>
    </section>
    <?php
    if (!isset($_SESSION['usuario'])) {
        ?>
        <aside id="aside_grupos">
            <form action="#" method="post">
                Usuario: <input type="text" name="usuario"><br>
                Contraseña: <input type="password" name="pwd"><br>
                <button type="submit" name="login">Entrar</button><br>
                <a href="Registrarte.php">¿No estas registrado? Pincha aqui</a>
            </form>
        </aside>
        <?php
    } else {
        ?> 
        <aside id="aside_grupos">
            <ul>
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