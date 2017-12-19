<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <?php
    session_start();
    ?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
    <head>
        <title>TodoLetras - Login</title>
        <?php
        include('./includes/cabecera.php');
        ?>
        <script type="text/javascript" src='js/comprobarlogin.js'></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="container">
            <?php
            include('./includes/header.php');
            include('./includes/nav.php');
            ?>
            <div class="login">
                <form action="signin.php" method="post" id="formulario" onsubmit="return comprobarlogin();">
                   
                        <table align="center">
                            <tr>
                                <td><label>Usuario:</label></td></tr>
                                <tr><td><input type="text" name="user" id="user" onchange="validarUsuario(this)"/></td>
                                <td id='userError'></td>
                            </tr>
                            <tr>
                                <td><label>Contrase&ntilde;a:</label></td></tr>
                                <tr><td><input type="password" name="pass" id="pass" onchange="validarPassword(this)"/></td>
                                <td id='passError'></td>
                            </tr>
                        
                            <tr><td><input type="submit" name="enviar" value="Iniciar sesion" class="input-button"/></td></tr>
                            <tr><td><a href="registro.php">Registrarse aqui</a></td></tr>
                        </table>
                    
                </form>
            </div>
            <?php
            include('./includes/novedades.php');
            include('./includes/aside.php');
            include('./includes/footer.php');
            ?> 
        </div>
    </body>
</html>