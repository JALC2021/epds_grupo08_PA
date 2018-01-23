<?php

// Conexión BBDD

function connectDB() {

    $conexion = mysqli_connect("localhost", "root", "");
    if ($conexion) {
        
    } else {
        echo 'Ha sucedido un error inexperado en la conexion de la base de datos<br>';
    }
    return $conexion;
}

//desconexión BBDD
function disconnectDB($conexion) {
    $close = mysqli_close($conexion);
    if ($close) {
        
    } else {
        echo 'Ha sucedido un error inexperado en la desconexion de la base de datos<br>';
    }
    return $close;
}

//selección de la base de datos
function selectDB($conexion) {
    $db = mysqli_select_db($conexion, "healthysocial");
    if (!$db) {
        die("Conexión a basde de datos fallida");
    }
    return $db;
}

?>