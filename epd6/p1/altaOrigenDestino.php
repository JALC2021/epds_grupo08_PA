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
        if (isset($_POST['altaVuelo'])) {

            $origen = $_POST['ciudadOrigen'];
            $pos = array(explode(";", $origen));
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

            for ($i = 0; $i < count($vectorResIdyNombre[0]); $i++) {
                if ($vectorResIdyNombre[0][$i] == $pos[0][0]) {
                    //imprimo el nombre de la aerolinea selecionoada en el origen
                    $nombreAerolineaSeleccionada = $vectorResIdyNombre[1][$i];
                    ?> <h1> Aerol&iacute;nea Seleccionada: <?php echo $vectorResIdyNombre[1][$i]; ?></h1><?php
                }
            }

            $vOrigenes = array();
            ?><h3>Origen: <?php echo $pos[0][1]; ?> </h3> 
            <?php
            for ($k = 0; $k < count($vectorResIdyOrigen[0]); $k++) {
                if ($vectorResIdyOrigen[0][$k] == $pos[0][0]) {
                    $vOrigenes[] = $vectorResIdyOrigen[1][$k];
                }
            }
            ?>
            <form method="post" action="vueloCompleto.php">
                <?php
                $busquedaPos = array_search($pos[0][1], $vOrigenes);
                unset($vOrigenes[$busquedaPos]);
                if (empty($vOrigenes)) {
                    echo "Esta aerolínea esta completa";
                } else {
                    ?>
                    Destino:<br />
                    <select name="cDestino">
                        <?php foreach ($vOrigenes as $value) {
                            ?><option value="<?php echo $value; ?>"><?php echo $value; ?></option>  <?php
                        }
                    }
                    ?>
                </select>
                <br />Introduzca ti&eacute;mpo de vuelo: <br /><input type="time" name="tiempoVuelo" value="Siguiente"><br />
                <br />Comprobar: <br /><input type="submit" name="vueloCompleto" value="Enviar">
                <input type="hidden" name="nombreAerolinea" value="<?php echo $nombreAerolineaSeleccionada; ?>">
                <input type="hidden" name="id_aerolinea" value="<?php echo $pos[0][0]; ?>">
                <input type="hidden" name="cOrigen" value="<?php echo $pos[0][1]; ?>">

            </form>
            <?php
        }
        ?>


    </body>
</html>
