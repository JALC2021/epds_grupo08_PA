<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <?php
    session_start();
    ?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
    <head>
        <title>TodoLetras</title>
        <?php
        include('./includes/cabecera.php');
        ?>
    </head>
    <body>
        <div class="container">
            <?php
            include('./includes/header.php');
            include('./includes/nav.php');
            ?>

            <div class="mi-cuenta">
                <?php
                if (isset($_SESSION['user'])) {
                    if ($_SESSION['tipo'] != 'admin') {
                        ?>
                        <div class='mi-cuenta-opc'>
                            <h2>Mi Cuenta</h2>
                            <img src='imagenes/mi-cuenta.png' class='mi-cuenta-img'/>                    
                            <ul>
                                <li><h4><a href="misdatos.php">Consultar mis datos</a></h4></li>
                                <li><h4><a href="mipassword.php">Cambiar mi contrase&ntilde;a</a></h4></li>
                                <li><h4><a href="miscompras.php">Consultar mis compras</a></h4></li>
                                <li><h4><a href="donarebook.php">Donar un ebook</a></h4></li>
                                <li><h4><a href="misebooks.php">Ver mis ebooks</a></h4></li>
                            </ul>
                        </div>
                        <?php
                    }
                    else{
                        ?>
                        <div class='mi-cuenta-opc'>
                            <h2>Mi Cuenta</h2>
                            <img src='imagenes/mi-cuenta.png' class='mi-cuenta-img'/>                    
                            <ul>
                                <li><h4><a href="misdatos.php">Consultar mis datos</a></h4></li>
                                <li><h4><a href="mipassword.php">Cambiar mi contrase&ntilde;a</a></h4></li>
                            </ul>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p class='center'>Debe de iniciar sesi&oacute;n para acceder al contenido<br><a href='login.php'>Iniciar Sesión</a></p>";
                }
                ?>
            </div>
            <?php
            include('./includes/novedades.php');
            include('./includes/aside.php');
            include('./includes/footer.php');
            ?> 
        </div>
    </body>
</html>