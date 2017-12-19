<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <?php
    session_start();
    ?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
    <head>
        <title>TodoLetras - Consultar Carrito</title>
        <?php
        include('./includes/cabecera.php');
        ?>
        <script src="js/comprobaremail.js" type="text/javascript"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="container">
            <?php
            include('./includes/header.php');
            include('./includes/nav.php');
            ?>
            <div class="contacto">                
                <h2>Contacto</h2>
                <p>Si tienes cualquier duda sobre tu compra o consulta, puedes contactar con nosotros como prefieras:</p>
                <img src='imagenes/contacto-tlf.png' alt='telefono' class='contacto'/><p>Ll&aacute;manos a nuestro tel&eacute;fono de atenci&oacute;n al cliente: <strong>902 10 25 73</strong></p>
                <p class='mini'>Horario de lunes a viernes de 9:00 a 22:00 horas; s&aacute;bados, domingos y festivos de apertura de 9:00 a 20:00 horas.
                    <br/>Coste de la llamada: establecimiento de la llamada y coste de una llamada nacional seg&uacute;n la tarifa contratada por el cliente con su operador de telefon&iacute;a.</p>
                <img src='imagenes/contacto-mail.png' alt='mail' class='contacto'/><p>O, si lo prefieres, puedes enviarnos tu consulta a trav&eacute;s de este formulario:</p>
                <form action="#" method="post" name='formulariocontacto' onsubmit="return comprobaremail();">
                    <table align="center">
                        <tr><td><label>Tema de la consulta*</label></td>
                        </tr>
                        <tr>
                            <td><select name='tema'>
                                    <option value='pedido'>Mi pedido</option>
                                    <option value='productos'>Productos y precios</option>
                                    <option value='datos'>Mis datos</option>
                                    <option value='otros'>Otros</option>
                                </select></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><label>Nombre*</label></td>
                       </tr>
                        <tr>
                            <td><input type='text' name='nombre' id='nombre' onchange="validarNombre(this)"/></td>
                            <tr><td id="nombreError"></td></tr>
                        </tr>
                        <tr>
                            <td><label>Correo electr&oacute;nico*</label></td>
                        </tr>
                        <tr>
                            <td><input type='text' name='email' id='email' onchange="validarEmail(this)"/></td>
                            <tr><td id="emailError"></td></tr>
                        </tr>
                        <tr>
                            <td><label>Tel&eacute;fono*</label></td>
                        </tr>
                        <tr>
                            <td><input type='tel' name='tlf' id='tlf' onchange="validarTelefono(this)" /></td>
                            <tr><td id="tlfError"></td></tr>
                        </tr>
                        <tr>
                            <td><label>Consulta*</label></td>
                        </tr>
                        <tr>
                            <td><textarea name="consulta" id="consulta" onchange="validarConsulta(this)"></textarea></td>
                            <tr><td id="consultaError"></td></tr>
                        </tr>

                        <tr>
                            <td><input name="btsend" id="btsend" type="submit" value='Enviar' class="input-button"/></td>
                        </tr>
                    </table>
                </form>     
                <img src='imagenes/contacto.jpg' alt='contacto' class="contacto-grand"/>
                <?php
                if (isset($_POST['btsend'])) {
                    if (isset($_POST['tema']) && $_POST['tema']!="" && isset($_POST['nombre']) && $_POST['nombre']!="" && isset($_POST['email']) && $_POST['email']!="" && isset($_POST['tlf']) && $_POST['tlf']!="" && isset($_POST['consulta']) && $_POST['consulta']!="") {
                        // email de destino
                        $email = "info@todoletras.comuv.com";

                        // asunto del email
                        $subject = "Contacto Web";

                        // Cuerpo del mensaje
                        $mensaje = "---------------------------------- \n";
                        $mensaje.= "            Contacto               \n";
                        $mensaje.= "---------------------------------- \n";
                        $mensaje.= "NOMBRE:   " . $_POST['nombre'] . "\n";
                        $mensaje.= "TEMA:  " . $_POST['tema'] . "\n";
                        $mensaje.= "EMAIL:    " . $_POST['email'] . "\n";
                        $mensaje.= "TELEFONO: " . $_POST['tlf'] . "\n";
                        $mensaje.= "FECHA:    " . date("d/m/Y") . "\n";
                        $mensaje.= "HORA:     " . date("h:i:s a") . "\n";
                        $mensaje.= "IP:       " . $_SERVER['REMOTE_ADDR'] . "\n\n";
                        $mensaje.= "---------------------------------- \n\n";
                        $mensaje.= $_POST['consulta'] . "\n\n";
                        $mensaje.= "---------------------------------- \n";

                        // headers del email
                        $headers = "From: " . $_POST['email'] . "\r\n";

                        // Enviamos el mensaje
                        if (mail($email, $subject, $mensaje, $headers)) {
                            echo "<p>Su mensaje <strong>ha sido enviado</strong>. En breve recibir&aacute; una respuesta nuestra. Muchas gracias.</p>";
                        } else {
                            echo "<p><strong>No</strong> se ha podido enviar su consulta. Por favor, intentelo de nuevo mas tarde.</p>";
                        }
                    } else {
                        echo "No ha indicado todos los campos obligatorios";
                    }
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