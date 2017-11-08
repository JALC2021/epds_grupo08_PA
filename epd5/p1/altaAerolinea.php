<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Epd_5_p1</title>
    </head>
    <body>
        <?php
        $nombreAerolinea = $_POST['nombreAerolinea'];
        $nDestinos = $_POST = ['nDestinos'];
        $escritura_txt_id_nombreAerolinea = fopen("id_nombreAerolinea.txt", 'a');
        $lectura_txt_id_nombreAerolinea = fopen("id_nombreAerolinea.txt", 'r');
        $lectura_txt_ciudades = fopen("ciudades.txt", 'r');
        $id_aerolinea = NULL;
        $vectorIds = array();
//
        if (!isset($_POST['siguiente'])) {
            if (!isset($nombreAerolinea)) {
                $errores[] = 'Debe indicar el nombre de la erol&iacute;neaianea';
            }
            if (!isset($errores)) {

                if (filesize("id_nombreAerolinea.txt") <= 0) {

                    $id_aerolinea = 0;

                    flock($escritura_txt_id_nombreAerolinea, LOCK_EX);  //bloqueo escritura
                    fwrite($escritura_txt_id_nombreAerolinea, $id_aerolinea . ";" . $nombreAerolinea . "\n");
                    flock($escritura_txt_id_nombreAerolinea, LOCK_UN);
                    fclose($escritura_txt_id_nombreAerolinea);
                } else {
                    //lectura del fichero para comprobar id
//                  
                    flock($lectura_txt_id_nombreAerolinea, LOCK_SH);  //bloqueo lectura
                    $leerIdAero = fgetcsv($lectura_txt_id_nombreAerolinea, 999, ";");   //lee la primera linea

                    while (!feof($lectura_txt_id_nombreAerolinea)) {
                        $leerIdAero = fgetcsv($lectura_txt_id_nombreAerolinea, 999, ";");
                        $vectorIds[] = $leerIdAero[0];
                    }

                    $maxIds = max($vectorIds);
                    $id_aerolinea = $maxIds + 1;

                    flock($lectura_txt_id_nombreAerolinea, LOCK_UN);
                    fclose($lectura_txt_id_nombreAerolinea);

                    flock($escritura_txt_id_nombreAerolinea, LOCK_EX);
                    fwrite($escritura_txt_id_nombreAerolinea, $id_aerolinea . ";" . $nombreAerolinea . "\n");
                    flock($escritura_txt_id_nombreAerolinea, LOCK_UN);
                    fclose($escritura_txt_id_nombreAerolinea);
                }
            }
        }
        ?>
        <h2>Seleccione Destino</h2>

        <form method="post" action ="altaCompleta.php" name="alta">
            <!-- si nDestinos = 3 por ejemplo debe mostrar 3 selec y selecionar uno de cada uno sin que se repita la ciudad para eso debemos eliminar el atributo multiple-->
            <select multiple size="8" name="vectorCiudadesDestino[]">   
            <!--<select  size="8" name="vectorCiudadesDestino[]">-->    
                <?php
//                $lectura_txt_ciudades = fopen("ciudades.txt", 'r');

                if ($lectura_txt_ciudades) {
                    flock($lectura_txt_ciudades, LOCK_SH);
                    $ciudades = fgetcsv($lectura_txt_ciudades, 999, ",");
                    while (!feof($lectura_txt_ciudades)) {
                        $ciudades = fgetcsv($lectura_txt_ciudades, 999, ",");
                        ?>
                        <option value="Roma"><?php echo $ciudades[0] ?></option>
                        <option value="Paris"><?php echo $ciudades[1] ?></option>
                        <option value="Londres"><?php echo $ciudades[2] ?></option>
                        <option value="Dublin"><?php echo $ciudades[3] ?></option>
                        <option value="Sevilla"><?php echo $ciudades[4] ?></option>
                        <option value="Madrid"><?php echo $ciudades[5] ?></option>
                        <option value="Barcelona"><?php echo $ciudades[6] ?></option>
                        <option value="Amsterdam"><?php echo $ciudades[7] ?></option>
                        <?php
                    }

                    flock($lectura_txt_ciudades, LOCK_UN);
                    fclose($lectura_txt_ciudades);
                } else {
                    echo "error en el fichero";
                }
                ?>

            </select>

            <input type="hidden" name="id_aerolinea" value="<?php echo $id_aerolinea; ?>">
            <input type="hidden" name="nombreAerolinea" value="<?php echo $_POST['nombreAerolinea']; ?>">
            <input type="submit" name="enviarDestino" value="Enviar">
        </form>
    </body>
</html>

