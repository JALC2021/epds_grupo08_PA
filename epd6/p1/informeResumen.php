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
        if (isset($_POST['resumenAerolinea'])) {
            // recibo los datospara finalizar el alta de aerolinea con sus vuelos
            $aerolineaSeleccionada = $_POST['aerolineaSelec'];
            //$pos = array(explode(";", $aerolineaSeleccionada));
//            $pos = NULL;
            $conexion = mysqli_connect("localhost", "user", "user");
            if (!$conexion) {
                die('No puedo conectar:' . mysqli_error($conexion));
            }

            $db_selected = mysqli_select_db($conexion, "epd6Aerolineas");
            if (!$db_selected) {
                die('No puedo usar la base de datos: ' . mysqli_error($conexion));
            }


            $sql = "SELECT id, nombre FROM aerolineas WHERE id='$aerolineaSeleccionada'";
            $result = mysqli_query($conexion, $sql);
            $res = mysqli_fetch_array($result);    //devuelve el valor en un vector de posiciones segun campos
            ?><h2>Aerol&iacute;nea:<?php echo $res[1]; ?><h2><?php
                    $sql2 = "SELECT idAerolinea, origen, destino, duracion FROM vuelos WHERE idAerolinea='$res[0]'";
                    $result2 = mysqli_query($conexion, $sql2);
                    $res2 = mysqli_fetch_array($result2);
                    //devuelve el valor en un vector de posiciones segun campos
                    while ($res2 = mysqli_fetch_array($result2)) {
                        echo "<article>";
                        echo "Origen: " . $res2[1] . "<br />";
                        echo "Destino: " . $res2[2] . "<br />";
                        echo "Duracion: " . $res2[3] . "<br />";
                        echo "</article>";
                    }


                    if (!$res || $res2) {
                        die("Error al ejecutar la consulta: " . mysqli_error($conexion));
                    }
                    mysqli_close($conexion);
                }
                ?>

                </body>
                </html>
