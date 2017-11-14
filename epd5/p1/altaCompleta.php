<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $vecCiudDest[] = $_POST['vectorCiudadesDestino'];
        //$nombreAerolinea = $_POST['nombreAerolinea'];
        $id_aerolinea = $_POST['id_aerolinea'];
        $f_id_nombreAerolinea_Dest = fopen("altaCompleta.txt", 'a');
        ?>
        <?php
        echo $id_aerolinea;
        flock($f_id_nombreAerolinea_Dest, LOCK_EX);
//                    fwrite($f_id_nombreAerolinea, $id_aerolinea . ";" . $nombreAerolinea . ";" . "\n");
//        fwrite($f_id_nombreAerolinea_Dest, $id_aerolinea . ";" . $nombreAerolinea . ";" . $vecCiudDest[] . "\n");
        foreach ($vecCiudDest as $ciudad) {

            fputcsv($f_id_nombreAerolinea_Dest, $id_aerolinea, $ciudad, ";");
        }
        flock($f_id_nombreAerolinea_Dest, LOCK_UN);
        fclose($f_id_nombreAerolinea_Dest);
        ?>
    </body>
</html>
