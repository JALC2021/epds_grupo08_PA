<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
    <head>
        <link rel="stylesheet" type="text/css" href="estilo.css">
        <title>Epd_6_p1</title>
    </head>
    <body>
        <?php
        // recibo los datospara finalizar el alta de aerolinea con sus vuelos
        $idAerolinea = $_POST['id_aerolinea'];
//        $nombreAerolineaSeleccionada = $_POST['nombreAerolinea'];
        $ciudadOrigen = $_POST['cOrigen'];
        $ciudadDestino = $_POST['cDestino'];
        $duracionVuelo = $_POST['tiempoVuelo'];

        $conexion = mysqli_connect("localhost", "user", "user");
        if (!$conexion) {
            die('No puedo conectar:' . mysqli_error($conexion));
        }

        $db_selected = mysqli_select_db($conexion, "epd6Aerolineas");
        if (!$db_selected) {
            die('No puedo usar la base de datos: ' . mysqli_error($conexion));
        }


        $sql = "INSERT INTO vuelos (idAerolinea,origen,destino,duracion) VALUES ('$idAerolinea','$ciudadOrigen','$ciudadDestino','$duracionVuelo')";
        $resultSql = mysqli_query($conexion, $sql);


        if (!$resultSql) {
            die("Error al ejecutar la consulta: " . mysqli_error($conexion));
        }


        $queryIdyNombreAerolineas = "SELECT * FROM aerolineas";
        $resultIdyNombreAerolinea = mysqli_query($conexion, $queryIdyNombreAerolineas);             //devuelve el valor en un vector de posiciones segun campos
        //leemos las aerolineas campo id, nombre
        while ($resIdyNombre = mysqli_fetch_array($resultIdyNombreAerolinea)) {

            $vectorResIdyNombre[0][] = $resIdyNombre[0];    //[0]id
            $vectorResIdyNombre[1][] = $resIdyNombre[1];    //[0]nombre
        }

        mysqli_close($conexion);
        ?>
        <h1>Elija Aerol&iacute;nea</h1>
        <form method = "post" action = "informeResumen.php"><?php
            for ($ind = 0; $ind < count($vectorResIdyNombre[1]); $ind++) {
                echo "<article>";
                ?><input type="radio" name="aerolineaSelec" value="<?php echo $vectorResIdyNombre[0][$ind] ?>">
                <?php
                echo $vectorResIdyNombre[1][$ind];
                echo "</article>";
            }
            ?>
            <h4>Mostrar Resumen:</h4> <input type="submit" name="resumenAerolinea" value="Enviar">
        </form>

</html>
