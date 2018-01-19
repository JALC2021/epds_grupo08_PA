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

?>