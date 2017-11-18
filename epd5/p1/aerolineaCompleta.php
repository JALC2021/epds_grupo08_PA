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
        // recibo los datospara finalizar el alta de aerolinea con sus vuelos
        $idAerolinea = $_POST['id_aerolinea'];
        $nombreAerolineaSeleccionada = $_POST['nombreAerolinea'];
        $ciudadOrigen = $_POST['cOrigen'];
        $ciudadDestino = $_POST['cDestino'];
        $duracionVuelo = $_POST['tiempoVuelo'];

        //escribimos los datos del vuelo completo en vuelos.txt
        $escritura_txt_vuelos = fopen("vuelos.txt", 'a');   //abro escritura
        flock($escritura_txt_vuelos, LOCK_EX);  //bloqueo escritura
        fwrite($escritura_txt_vuelos, $idAerolinea . ";" . $nombreAerolineaSeleccionada . ";" . $ciudadOrigen . ";" . $ciudadDestino . ";" . $duracionVuelo . "\n");
        flock($escritura_txt_vuelos, LOCK_UN);
        fclose($escritura_txt_vuelos);  //cierro escritura
        //Leemos las aerolineas
        $nombreAero = array();
        $lectura_txt_id_nombreAerolinea = fopen("iDnombreAerolinea.txt", 'r');    //modo lectura
        flock($lectura_txt_id_nombreAerolinea, LOCK_SH);  //bloqueo lectura

        $leerNomAero = fgetcsv($lectura_txt_id_nombreAerolinea, 999, ";");   //lee la primera linea
        while (!feof($lectura_txt_id_nombreAerolinea)) {
            $nombreAero[0][] = $leerNomAero[0];
            $nombreAero[1][] = $leerNomAero[1];
            $leerNomAero = fgetcsv($lectura_txt_id_nombreAerolinea, 999, ";");
        }
        flock($lectura_txt_id_nombreAerolinea, LOCK_UN);
        fclose($lectura_txt_id_nombreAerolinea);
        ?>
        <h1>Elija Aerol&iacute;nea</h1>
        <form method = "post" action = "resumen.php"><?php
        for ($ind = 0; $ind < count($nombreAero[1]); $ind++) {
            echo "<article>";
            ?><input type="radio" name="aerolineaSelec" value="<?php echo $nombreAero[0][$ind] . ";" . $nombreAero[1][$ind]; ?>">
                <?php
                echo $nombreAero[1][$ind];
                echo "</article>";
            }
            ?>
            <h4>Mostrar Resumen:</h4> <input type="submit" name="resumenAerolinea" value="Enviar">
        </form>

    </body>
</html>
