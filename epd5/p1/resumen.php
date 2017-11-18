<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="estilo.css">
        <title>Epd_5_p1</title>
    </head>
    <body>
        <?php
        $aerolineaSeleccionada = $_POST['aerolineaSelec'];
        $pos = array(explode(";", $aerolineaSeleccionada));

        //Leemos el txt de vuelos
        $vuelos = array();
        $lectura_txt_vuelos = fopen("vuelos.txt", 'r');    //modo lectura
        flock($lectura_txt_vuelos, LOCK_SH);  //bloqueo lectura

        $leerVuelo = fgetcsv($lectura_txt_vuelos, 999, ";");   //lee la primera linea
        while (!feof($lectura_txt_vuelos)) {
            $vuelos[0][] = $leerVuelo[0];   //$idAerolinea
            $vuelos[1][] = $leerVuelo[1];   //$nombreAerolineaSeleccionada
            $vuelos[2][] = $leerVuelo[2];   //$ciudadOrigen
            $vuelos[3][] = $leerVuelo[3];   //$ciudadDestino
            $vuelos[4][] = $leerVuelo[4];   //$duracionVuelo

            $leerVuelo = fgetcsv($lectura_txt_vuelos, 999, ";");
        }
        flock($lectura_txt_vuelos, LOCK_UN);
        fclose($lectura_txt_vuelos);
        ?><h2>Conexiones:</h2><br /><?php
        for ($index = 0; $index < count($vuelos[0]); $index++) {
            echo "<article>";
            if ($vuelos[0][$index] == $pos[0][0]) {
                echo "Origen: " . $vuelos[2][$index] . "<br />";
                echo "Destino: " . $vuelos[3][$index] . "<br />";
                echo "Duracion: " . $vuelos[4][$index] . "<br />";
            }
            echo "</article>";
        }
        ?>


    </body>
</html>
