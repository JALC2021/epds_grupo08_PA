<?php

session_start();

include 'funciones\conexion.php';

if (isset($_POST['registroEnvio']) && filter_has_var(INPUT_POST, 'registroEnvio')) {

    $errores = "";
    $res = false;

    if (isset($_POST['registroUsuario']) && $_POST['registroUsuario'] != "" && filter_has_var(INPUT_POST, 'registroUsuario')) {
        $registroUsuario = filter_input(INPUT_POST, 'registroUsuario', FILTER_SANITIZE_STRING);

        if (!isset($_SESSION["registroUsuario"])) {
            $_SESSION["registroUsuario"] = $registroUsuario;
        } else {
            $_SESSION["registroUsuario"] = $registroUsuario;
        }
        
    } else {
        $registroUsuario = "";
        $errores .= '<p>Error. No ha introducido un usuario en el campo correspondiente</p>';
    }
    if (isset($_POST['registroContrasenia']) && $_POST['registroContrasenia'] != "" && filter_has_var(INPUT_POST, 'registroContrasenia')) {
        $registroContrasenia = md5(filter_input(INPUT_POST, 'registroContrasenia', FILTER_SANITIZE_STRING));
    } else {
        $registroContrasenia = "";
        $errores .= '<p>Error. No se ha introducido una contrase&ntilde;a en el campo correspondiente</p>';
    }
    if (isset($_POST['registroEmail']) && $_POST['registroEmail'] != "" && filter_has_var(INPUT_POST, 'registroEmail') && filter_input(INPUT_POST, 'registroEmail', FILTER_VALIDATE_EMAIL)) {
        $registroEmail = filter_input(INPUT_POST, 'registroEmail', FILTER_SANITIZE_EMAIL);
    } else {
        $registroEmail = "";
        $errores .= '<p>Error. No se ha introducido un email en el campo correspondiente</p>';
    }
    if (isset($_POST['registroUniversidad']) && $_POST['registroUniversidad'] != "" && filter_has_var(INPUT_POST, 'registroUniversidad')) {
        $registroUniversidad = filter_input(INPUT_POST, 'registroUniversidad', FILTER_SANITIZE_STRING);
        
       
        
       
    } else {
        $registroUniversidad = "";
        $errores .= '<p>Error. No se ha seleccionado una universidad en el desplegable</p>';
    }

    if ((strlen($errores)) == 0) {//si no hay errores de validación

        $queryUsuario = "SELECT * FROM usuarios";
        $resultado = mysqli_query($conexion, $queryUsuario);
        
        while ($row = mysqli_fetch_array($resultado)) {

            if ($row['nom_usuario'] == $registroUsuario) {
                $res = true;
            }
        }
        if (!$res) { //si el conjunto de $resultado es falso..
           
            //Introduzco los datos del usuario en la Base de datos
            $query = "INSERT INTO `usuarios`(`nom_usuario`, `clave`, `email`, `universidad`) VALUES ('$registroUsuario','$registroContrasenia','$registroEmail','$registroUniversidad')";
            $result = mysqli_query($conexion, $query);
            mysqli_close($conexion);
            if (!$result) {
                echo 'Error. El usuario no se ha podido añadir a la Base de Datos';
            } else {
                echo 'Usuario añadido a la Base de datos satisfactoriamente. Inicie sesi&oacute;n por favor';
                require_once 'index.php';
            }
        }
    } else {
        echo 'Error. Ya existe el usuario en la base de datos ';
    }
}

if (!isset($_POST['registroEnvio']) || strlen($errores) > 0) { //si hay errores
    if (strlen($errores) > 0) {
        echo '<h1>Se han producido los siguientes errores:</h1>';
        echo $errores;
    }
}


