<?php

session_start();
include 'consultasSql.php';
require 'class.phpmailer.php';

if (isset($_POST['enviarRegistro'])) {
    $user = filter_var($_POST['user'], FILTER_SANITIZE_MAGIC_QUOTES);
    $toEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    $result = consultaSelect('SELECT id FROM usuarios WHERE user like "' . $user . '" OR correo LIKE "' . $toEmail . '";');

    if (mysql_num_rows($result) > 0) {
        $_SESSION['errorRegistro'] = TRUE;
        header('Location: registro.php');
    } else {
        $password = filter_var($_POST['password'], FILTER_SANITIZE_MAGIC_QUOTES);

        consultaInsert('INSERT INTO usuarios (id,user,password,correo) VALUES (NULL,"' . $user . '","' . $password . '","' . $toEmail . '")');

        $result = consultaSelect('SELECT * FROM usuarios WHERE user LIKE "' . $user . '"');
        $row = mysql_fetch_array($result);

        $email = new PHPMailer();
        $mensaje = 'Bienvenido a Gamerstation\r\n Su usuario es: ' . $row['user'] . '.\r\n Su password es: ' . $toEmail . '\r\n No conteste a este correo.';
        $email->From = 'welcome@gamerstation.com';
        $email->AddAddress($toEmail);
        $email->Subject = 'Bienvenido a Gamerstation';
        $email->Body = $mensaje;

        $_SESSION['errorRegistro'] = FALSE;
        $_SESSION['logeado'] = TRUE;
        $_SESSION['admin'] = FALSE;
        $_SESSION['user'] = $user;
        $_SESSION['idUser'] = $row['id'];
        header('Location: index.php');
    }
}
