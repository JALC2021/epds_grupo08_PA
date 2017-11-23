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
        if (isset($_POST['siguiente'])) {
            $nombreAerolinea = $_POST['nombre'];
            $numreroDestinos = $_POST['numeroDestinos'];
            $nombreCiudad = NULL;
            ?><h2>Elige Destinos</h2><?php
            $vectorCiudades = array();
            $conexion = mysqli_connect("localhost", "user", "user");
            if (!$conexion) {
                die('No puedo conectar:' . mysqli_error($conexion));
            }
            $db_selected = mysqli_select_db($conexion, "epd6Aerolineas");
            if (!$db_selected) {
                die('No puedo usar la base de datos: ' . mysqli_error($conexion));
            }
            $queryCiudades = "SELECT * FROM `ciudades`";
            $result = mysqli_query($conexion, $queryCiudades);

            while ($fila = mysqli_fetch_array($result)) {

                $vectorCiudades[] = $fila[0];
            }

            if (!$result) {
                die('Error al ejecutar la consulta: ' . mysqli_error($conexion));
            }
            mysqli_close($conexion);
            ?>


            <form method = "post" action = "">
                <?php
                for ($i = 0; $i < $numreroDestinos; $i++) {
                    ?>
                    <p>Destino <?php echo $i + 1 ?> </p>

                    <select  size="8" name="nombreCiudad[]">    
                        <?php
                        foreach ($vectorCiudades as $nombreCiudad) {
                            ?><option value="<?php echo $nombreCiudad ?>"><?php echo $nombreCiudad ?></option><?php
                        }
                        ?>
                    </select>
                    <?php
                }
                ?><br /> <input type="submit" name="enviarDestino" value="Enviar" />
                <input  type="hidden" name="nombreAerolinea" value="<?php echo $nombreAerolinea; ?>"/>
                <?php
            }

            if (isset($_POST['enviarDestino'])) {
                $nombreAerolinea = $_POST['nombreAerolinea'];
                $vectorCiudad = $_POST['nombreCiudad'];

                $conexion = mysqli_connect("localhost", "user", "user");
                if (!$conexion) {
                    die('No puedo conectar:' . mysqli_error($conexion));
                }

                $db_selected = mysqli_select_db($conexion, "epd6Aerolineas");
                if (!$db_selected) {
                    die('No puedo usar la base de datos: ' . mysqli_error($conexion));
                }
                $sqlInsertAerolineas = "INSERT INTO aerolineas (nombre) VALUES ('$nombreAerolinea')";
                $resultInsertAerolineas = mysqli_query($conexion, $sqlInsertAerolineas);

                $queryIdAerolineas = "SELECT id FROM aerolineas WHERE nombre='$nombreAerolinea'";
                $resultIdAerolinea = mysqli_query($conexion, $queryIdAerolineas);
                $resId = mysqli_fetch_array($resultIdAerolinea);    //devuelve el valor en un vector de posiciones segun campos

                foreach ($vectorCiudad as $nCiudad) {
                    $sqlInsertDestinos = "INSERT INTO destinos (idAerolinea,nombreCiudad) VALUES ('$resId[0]','$nCiudad')";
                    $resultInsertDestinos = mysqli_query($conexion, $sqlInsertDestinos);
                }

                if (!$resultInsertAerolineas || !$resultInsertDestinos) {
                    die("Error al ejecutar la consulta: " . mysqli_error($conexion));
                }
                mysqli_close($conexion);
                ?>
                <article>
                    <section>
                        <h1>Opciones</h1>
                        <a href="altaAerolinea.php">Alta Aerol&iacute;nea</a>
                        <a href="altaVuelos.php">Alta Vuelos</a>
                        <a href="informeResumen.php">Informe Resumen</a>
                    </section>
                </article>
                <?php
            }
            ?>

        </form>
    </body>
</html>
