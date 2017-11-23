<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="estilo.css">
        <title>Epd_6_p1</title>
    </head>
    <body>
        <?php
        if (!isset($_POST['altaVuelo'])) {
            ?><h2>Elige Aerol&iacute;nea</h2><?php
//            $vectorCiudades = array();
            $conexion = mysqli_connect("localhost", "user", "user");
            if (!$conexion) {
                die('No puedo conectar:' . mysqli_error($conexion));
            }
            $db_selected = mysqli_select_db($conexion, "epd6Aerolineas");
            if (!$db_selected) {
                die('No puedo usar la base de datos: ' . mysqli_error($conexion));
            }
//            $queryIdAerolineas = "SELECT id, nombrFROM aerolineas WHERE nombre='$nombreAerolinea'";
            $queryIdyNombreAerolineas = "SELECT * FROM aerolineas";
            $resultIdyNombreAerolinea = mysqli_query($conexion, $queryIdyNombreAerolineas);             //devuelve el valor en un vector de posiciones segun campos
            //leemos las aerolineas campo id, nombre
            while ($resIdyNombre = mysqli_fetch_array($resultIdyNombreAerolinea)) {

                $vectorResIdyNombre[0][] = $resIdyNombre[0];    //[0]id
                $vectorResIdyNombre[1][] = $resIdyNombre[1];    //[0]nombre
            }

            $queryIdyOrigen = "SELECT * FROM destinos";
            $resultIdyOrigen = mysqli_query($conexion, $queryIdyOrigen);             //devuelve el valor en un vector de posiciones segun campos
            //leemos las ciudades destino campo id, origen
            while ($resIdyOrigen = mysqli_fetch_array($resultIdyOrigen)) {

                $vectorResIdyOrigen[0][] = $resIdyOrigen[0];    //[0]id
                $vectorResIdyOrigen[1][] = $resIdyOrigen[1];    //[0]origen
            }

//            $queryCiudades = "SELECT * FROM `ciudades`";
//            $result = mysqli_query($conexion, $queryCiudades);

            if (!$resultIdyNombreAerolinea || !$resultIdyOrigen) {
                die('Error al ejecutar la consulta: ' . mysqli_error($conexion));
            }
            mysqli_close($conexion);
        }
        ?>
        <form method = "post" action = "altaOrigenDestino.php">
            <?php
            for ($ind = 0; $ind < count($vectorResIdyNombre[0]); $ind++) {
                echo "<article>";
                echo "<h2>" . $vectorResIdyNombre[1][$ind] . "</h2>";

                for ($inde = 0; $inde < count($vectorResIdyOrigen[0]); $inde++) {

                    if ($vectorResIdyNombre[0][$ind] == $vectorResIdyOrigen[0][$inde]) {
                        ?><input type="radio" name="ciudadOrigen" value="<?php echo $vectorResIdyOrigen[0][$inde] . ";" . $vectorResIdyOrigen[1][$inde]; ?>">
                        <?php
                        echo $vectorResIdyOrigen[1][$inde];
                    }
                }
                echo "</article>";
            }
            ?>

            <h4>Seleccione Origen:</h4> <input type="submit" name="altaVuelo" value="Siguiente" />

        </form>

    </body>
</html>
