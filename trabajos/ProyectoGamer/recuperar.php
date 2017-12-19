<?php

require 'class.phpmailer.php';
include 'consultasSql.php';
include 'seguridad.php';
$_SESSION['currentPage'] = 'login';
include 'cabecera.php';
include 'navegador.php';
include 'menu.php';

if (isset($_POST['enviar'])) {
    $toEmail = filter_var($_POST['email'], FILTER_SANITIZE_MAGIC_QUOTES);
    $sql = 'SELECT * FROM usuarios WHERE correo like "' . $toEmail . '"';
    $result = consultaSelect($sql);
    if (mysql_num_rows($result) > 0) {
        $row = mysql_fetch_array($result);

        $email = new PHPMailer();
        $mensaje = 'Recuperacion de password\r\n Su usuario es: ' . $row['user'] . '.\r\n Su password es: ' . $toEmail . '\r\n No conteste a este correo.';
        $email->From = 'recover@gamerstation.com';
        $email->AddAddress($toEmail);
        $email->Subject = 'Recuperacion password';
        $email->Body = $mensaje;

        if (!$email->Send()) {
            echo '<h3>Ha habído un error, pruebe más tarde</h3>';
        } else {
            echo '<h3>Enviado correctamente, compruebe su bandeja de entradas</h3>';
        }
    } else {
        echo '<h3>El correo no existe</h3>';
    }
} else {
    ?>
    <section id="content">
        <form method="POST" action="#">
            <h3>Introduzca su correo y le enviaremos su contrase&ntilde;a</h3>
            <input type="text" name="email" placeholder="sucorreo@gmail.com" />
            <input type="submit" name="enviar" value="Enviar"/>
        </form>
    </section>

    <?php

}
include 'pie.php';
?>