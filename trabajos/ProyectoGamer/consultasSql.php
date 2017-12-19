<?php
function fechaToBD($fecha) {
    $nuevaFecha = implode('-', array_reverse(explode("-", $fecha)));
    return $nuevaFecha;
}

function consultaSelect($sql) {
    $conexion = mysql_connect("localhost", "root", "");
    if (!$conexion) {
        die('Error al conectar a la base de datos ' . mysql_error());
    }
    $db = mysql_select_db("gamerstation", $conexion);
    if (!$db) {
        mysql_close($conexion);
        die('Error al seleccionar la base de datos ' . mysql_error());
    }

    $result = mysql_query($sql, $conexion);
    if (!$result) {
        die('Error al ejecutar la consulta ' . mysql_error());
    }

    mysql_close();

    return $result;
}

function consultaInsert($sql) {
    
    $conexion = mysql_connect("localhost", "root", "");
    if (!$conexion) {
        die('Error al conectar a la base de datos ' . mysql_error());
    }
    $db = mysql_select_db("gamerstation", $conexion);
    if (!$db) {
        mysql_close($conexion);
        die('Error al seleccionar la base de datos ' . mysql_error());
    }

    if (!mysql_query($sql, $conexion)) {
        die('Error al ejecutar la consulta ' . mysql_error());
    }

    mysql_close();
}

function getYouTubeIdFromURL($url){
  $url_string = parse_url($url, PHP_URL_QUERY);
  parse_str($url_string, $args);
  return isset($args['v']) ? $args['v'] : false;
}
?>

