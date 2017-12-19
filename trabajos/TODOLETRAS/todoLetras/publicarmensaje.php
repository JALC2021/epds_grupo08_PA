<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <?php
    session_start();
    ?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
    <head>
        <title>TodoLetras - Publicar Mensaje</title>
        <?php
        include('./includes/cabecera.php');
        ?>
        <script type="text/javascript" src="js/comprobarmensaje.js"></script>
    </head>
    <body>
        <div class="container">
            <?php
            include('./includes/header.php');
            include('./includes/nav.php');
            include('./includes/insertarmensaje.php');
            include('./includes/novedades.php');
            include('./includes/aside.php');
            include('./includes/footer.php');
            ?> 
        </div>
    </body>
</html>