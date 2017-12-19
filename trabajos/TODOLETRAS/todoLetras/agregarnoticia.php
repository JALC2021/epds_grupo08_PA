<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <?php
    session_start();
    ?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
    <script type="text/javascript" src="js/comprobarlibro.js"></script>
    <head>
        <title>TodoLetras</title>
        <?php
        include('./includes/cabecera.php');
        ?>
        <script type="text/javascript" src="js/comprobarnoticia.js"></script>
    </head>
    <body>
        <div class="container">
            <?php
            include('./includes/header.php');
            include('./includes/nav.php');
            ?>
            <div class="publicar-mensaje">
                <?php
                if ($_SESSION['tipo'] == "admin") {
                    ?>
                <h2>ESCRIBA LA NOTICIA AQUI:</h2>
                <form method="post" action="confirmacionnoticia.php" name="formularionoticia" onsubmit="return comprobarnoticia();">
                        <label>Titulo:</label>
                        <input type="text" name="titulo" id="titulo"/><br/>
                        <label>Cuerpo de la noticia</label><br/>
                        <textarea name="noticia" cols="30" rows="5"></textarea><br/>
                        <input type="submit" name="publicar" value='Publicar' class="input-button"/>
                    </form>

                    <?php
                } else {
                    echo "<p class='center'><strong>ERROR:</strong> Acceso restringido. &Uacute;nicamente los administradores pueden acceder a esta p&aacute;gina.</p>";
                }
                ?>
                <p class='center'><a href='administracion.php'>Volver a opciones</a></p>
            </div>
            <?php
            include('./includes/novedades.php');
            include('./includes/aside.php');
            include('./includes/footer.php');
            ?>   
        </div>
    </body>
</html>