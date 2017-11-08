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
        <h2>ALTA AEROLINEA: OK</h2>
        <?php
        $vectorCiudadesDestino = $_POST['vectorCiudadesDestino'];
        $id_aerolinea = $_POST['id_aerolinea'];
        $nombreAerolinea = $_POST['nombreAerolinea'];
        $escritura_txt_altaCompleta = fopen("altaCompleta.txt", 'a');    //modo escritura
        $lectura_txt_altaCompleta = fopen("altaCompleta.txt", 'r');   //modo lectura
        $lectura_txt_id_nombreAerolinea = fopen("id_nombreAerolinea.txt", 'r');    //modo lectura

        flock($escritura_txt_altaCompleta, LOCK_EX);  //bloqueo escritura

        for ($c = 0; $c < count($vectorCiudadesDestino); $c++) {

            fwrite($escritura_txt_altaCompleta, $id_aerolinea . ";" . $vectorCiudadesDestino[$c] . "\n");
        }
        flock($escritura_txt_altaCompleta, LOCK_UN);
        fclose($escritura_txt_altaCompleta);
        ?>
        <h2>Aerol&iacute;neas registradas</h2>


        <?php
        //Leemos las aerolineas
        $nombreAero = array();
        flock($lectura_txt_id_nombreAerolinea, LOCK_SH);  //bloqueo lectura
        $leerNomAero = fgetcsv($lectura_txt_id_nombreAerolinea, 999, ";");   //lee la primera linea
        while (!feof($lectura_txt_id_nombreAerolinea)) {
            $leerNomAero = fgetcsv($lectura_txt_id_nombreAerolinea, 999, ";");

            echo $nombreAero[] = $leerNomAero[0] . "<->" . $leerNomAero[1] . "<br />";
        }
        //leemos las ciudades destino para cada aerolinea
        $nombreDest = array();
        flock($lectura_txt_altaCompleta, LOCK_SH);  //bloqueo lectura
        $leerDest = fgetcsv($lectura_txt_altaCompleta, 999, ";");   //lee la primera linea
        while (!feof($lectura_txt_altaCompleta)) {
            $leerDest = fgetcsv($lectura_txt_altaCompleta, 999, ";");

//                $nombreDest[] = $leerDest[1];
            echo $nombreDest[] = $leerDest[0] . "<->" . $leerDest[1] . "<br />";
        }
        //tenemos que mostrar en la web el nombre de las aerolineas. y los destinos de cada aerolinea en un radio boton 
        //imprimo las aerolineas y sus destinos
        for ($ind = 0; $ind < count($nombreAero); $ind++) {
//                echo "<article>";
//                echo "<h4>" . $nombreAero[$ind] . "</h4>";

            for ($inde = 0; $inde < count($nombreDest); $inde++) {

                if ($nombreAero[0] == $nombreDest[0]) {
                    echo "-->" . $nombreDest[$inde];
                }
//                    echo"<input type='radio' name='destinos'>" . $nombreDest[$inde];
//                    echo "</article>";
            }
        }
        ?>
        <form method="post" action="altaVuelos.php">
            <br />
            Seleccione Origen y pulse: <input type="submit" name="enviarDestino" value="Enviar">
            
        </form>
    </body>
</html>
