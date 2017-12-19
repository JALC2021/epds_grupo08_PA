<?php

session_start();
include 'consultasSql.php';

if (isset($_POST['enviarLogin'])) {
    $password = filter_var($_POST['password'], FILTER_SANITIZE_MAGIC_QUOTES);
    $user = filter_var($_POST['user'], FILTER_SANITIZE_MAGIC_QUOTES);

    $sql = 'SELECT * FROM usuarios WHERE user like "' . $user . '" and password like "' . $password . '";';

    $result = consultaSelect($sql);
    $row = mysql_fetch_array($result);
    if (mysql_num_rows($result) > 0) {
        if ($row['user'] == 'root') {
            $_SESSION['admin'] = TRUE;
        } else {
            $_SESSION['admin'] = FALSE;
        }
        $_SESSION['errorLogin'] = FALSE;
        $_SESSION['logeado'] = TRUE;
        $_SESSION['user'] = $user;
        $_SESSION['idUser'] = $row['id'];
        header('Location: index.php');
    } else {
        $_SESSION['errorLogin'] = TRUE;
        header('Location: login.php');
    }
}