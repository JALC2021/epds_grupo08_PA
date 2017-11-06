<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php

function validarFecha($valores) {
    $valida = false;
    $contadorValidaciones = 0;
    $numdias = 0;

    if (strlen($valores[1]) == 2 && $valores[1] > 00 && $valores[1] < 13) {
        switch ($valores[1]) {
            case "01": case "03": case "05": case "07": case "08": case "10": case "12":
                $numdias = "31";
                break;
            case "02":
                $numdias = "29";
                break;
            case "04": case "06": case "09": case "11":
                $numdias = "30";
                break;
        }
        $contadorValidaciones++;
    }

    if (strlen($valores[0]) == 2 && $valores[0] > 00 && $valores[1] < ($numdias + 1)) {
        $contadorValidaciones++;
    }


    if (strlen($valores[2]) == 4) {
        $contadorValidaciones++;
    }



    if ($contadorValidaciones == 3) {
        $valida = true;
    }

    return $valida;
}

function buscarMesSolicitado($fecha, $mesSolicitado) {
    $encontrado = false;
    $i = 0;

    while (!$encontrado && sizeof($fecha)) {
        $partes = explode("/", $fecha[$i]);
        if ($partes[1] == $mesSolicitado) {
            $encontrado = true;
        }
        $i++;
    }
    return $encontrado;
}

function aplicaDescuento($medicion, $descuento) {
    $descuentoTratado = (int) $descuento;
    for ($i = 0; $i < sizeof($medicion); $i++) {
        $medicionActual = (float) $medicion[$i];
        $medicionResultante [] = ($medicionActual) - (($descuentoTratado * $medicionActual) / '100');
    }
    return $medicionResultante;
}

function fechaMedicionMesEscogido($fechaMedicion, $mesMedicionRecibido) {
    for ($i = 0; $i < sizeof($fechaMedicion); $i++) {
        $partes = explode("-", $fechaMedicion[$i]);
        $partesFecha = explode("/", $partes[0]);
        if ($partesFecha[1] == $mesMedicionRecibido) {
            $fechaMedicionMes [] = $partes[0] . "-" . $partes[1];
        }
    }
    return $fechaMedicionMes;
}

function escogidosOrdenados($escogidos) {

    for ($i = 0; $i < sizeof($escogidos); $i++) {
        $partes = explode("-", $escogidos[$i]);
        $medicionesOrdenadas [] = $partes[1];
    }
    asort($medicionesOrdenadas);

    for ($i = 0; $i < sizeof($medicionesOrdenadas); $i++) {
        $partes2 = explode("-", $escogidos[$i]);
        if ($partes2[1] == $medicionesOrdenadas[$i]) {
            $medicionesOrdenadasCompleto [] = $partes2[0] . "-" . $medicionesOrdenadas[$i];
        }
    }
    return $medicionesOrdenadasCompleto;
}

?>


<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>MEDICIONES GASOLINA</h1>
        <form action="" method="POST">
            N&uacute;mero de mes de medici&oacute;n:
            <input type="text" name="mesmedicion" /><br />
            N&uacute;mero de mediciones a tomar:
            <input type="text" name="nummediciones" /><br />
            Descuento sobre el precio: 
            <input type="text" name="descuento" /> %<br />
            <input type="submit" name="enviar" value="Enviar">
        </form>
        <?php

        if (isset($_POST['enviar'])) {
            // Comprobamos que los campos obligatorios estan rellenos
            if (!isset($_POST['mesmedicion']) || $_POST['mesmedicion'] == "" || $_POST['mesmedicion'] < 01 || $_POST['mesmedicion'] > 12) {
                $errores[] = 'Indique un mes num&eacute;rico correcto.<br /> Ejs: <br />01: Enero<br /> 12: Diciembre';
            } else {
                if (strlen($_POST['mesmedicion']) == 2) {
                    $mesmedicion = $_POST['mesmedicion'];
                } else if (strlen($_POST['mesmedicion']) == 1) {
                    $mesmedicion = "0" . $_POST['mesmedicion'];
                }
            }
            if (!isset($_POST['nummediciones']) || $_POST['nummediciones'] == "" || $_POST['nummediciones'] < 0) {
                $errores[] = 'Indique un n&uacute;mero de mediciones';
            } else {
                $nummediciones = $_POST['nummediciones'];
            }
            if (!isset($_POST['descuento']) || $_POST['descuento'] == "" || $_POST['descuento'] < 0 || $_POST['descuento'] > 100) {
                $errores[] = 'Indique un descuento v&aacute;lido. Descuento m&iacute;nimo aplicable: 0%';
            } else {
                $descuento = $_POST['descuento'];
            }


            if (!isset($errores)) { //Si no hubo errores...
                echo '<br/><br />';
                echo '<form action="" method="POST">';
                echo '<table border="1">';
                echo '<tr>';
                echo '<th>Fecha</th>';
                echo '<th>Medici&oacute;n</th>';
                echo '</tr>';

                for ($i = 0; $i < $nummediciones; $i++) {

                    echo '<tr>';
                    echo '<td><input type="text" name="fecha[]" /></td>';
                    echo '<td><input type="text" name="medicion[]" /></td>';
                    echo '</tr>';
                }
                echo '</table>';
                echo '<br /><br />';
                echo '<input type="hidden" name ="mesmedicionrecibido" value="' . $mesmedicion . '" />';
                echo '<input type="hidden" name ="descuentorecibido" value="' . $descuento . '" />';
                echo '<input type="submit" name="ordenarfecha" value="Ordenar por fecha"/>';
                echo ' <input type="submit" name="ordenarprecio" value="Ordenar por precio"/>';
                echo '</form>';
            } else { //Si hubo errores...
                echo '<p style="color:red">Errores cometidos:</p>';
                echo '<ul style="color:red">';
                foreach ($errores as $e) {
                    echo "<li>$e</li>";
                }
                echo '</ul>';
            }
        }






        if (isset($_POST['ordenarfecha']) || isset($_POST['ordenarprecio'])) {
            //Se recoge la opción elegida, según el botón pulsado
            if (isset($_POST['ordenarfecha'])) {
                $opcionElegida = $_POST['ordenarfecha'];
            } else if (isset($_POST['ordenarprecio'])) {
                $opcionElegida = $_POST['ordenarprecio'];
            }

            // Comprobamos que los campos obligatorios estan rellenos
            for ($i = 0; $i < sizeof($_POST['fecha']); $i++) {
                if (!isset($_POST['fecha'][$i]) || $_POST['fecha'][$i] == "") {
                    $errores2[] = 'Indique una fecha en la l&iacute;nea ' . $i;
                } else {
                    if (strpos($_POST['fecha'][$i], "/") != false) {
                        $valores = explode('/', $_POST['fecha'][$i]);
                        $validacion = validarFecha($valores);
                        if ($validacion) {
                            $fecha[] = $_POST['fecha'][$i];
                        } else {
                            $errores2[] = 'Indique una fecha correcta en la l&iacute;nea ' . $i . '. Formato: dd/mm/yyyy';
                        }
                    } else {
                        $errores2[] = 'Indique una fecha con formato correcto en la l&iacute;nea ' . $i . '. Formato: dd/mm/yyyy';
                    }
                }



                if (!isset($_POST['medicion'][$i]) || $_POST['medicion'][$i] == "") {
                    $errores2[] = 'Indique una medici&oacute;n en la l&iacute;nea ' . $i;
                } else {
                    $medicion[] = $_POST['medicion'][$i];
                }
            }

            //Se recogen los campos ocultos
            $mesMedicionRecibido = $_POST['mesmedicionrecibido'];
            $descuentoRecibido = $_POST['descuentorecibido'];

            if (!isset($errores2)) { //Si no hubo errores...
               

                if (buscarMesSolicitado($fecha, $mesMedicionRecibido)) {
                    $medicionConDescuento = aplicaDescuento($medicion, $descuentoRecibido);
                    for ($i = 0; $i < sizeof($fecha); $i++) {
                        $fechaMedicion[] = $fecha[$i] . "-" . $medicionConDescuento[$i];
                    }

                    if (strcmp($opcionElegida, "Ordenar por precio") == 0) {
                        //ToDo
                        
                    } else if (strcmp($opcionElegida, "Ordenar por fecha") == 0) {

                        $escogidos = fechaMedicionMesEscogido($fechaMedicion, $mesMedicionRecibido);

                        $ordenadosCompletos = escogidosOrdenados($escogidos);

                        //Muestra tabla resumen
                        echo '<br /><br />';
                        echo '<table border="1">';
                        echo '<tr>';
                        echo '<th>Fecha</th>';
                        echo '<th>Medici&oacute;n</th>';
                        echo '</tr>';

                        for ($i = 0; $i < sizeof($ordenadosCompletos); $i++) {
                            $definitivo = explode("-", $ordenadosCompletos[$i]);
                            echo '<tr>';
                            echo '<td>' . $definitivo[0] . '</td>';
                            echo '<td>' . $definitivo[1] . '</td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                    }
                } else {
                    echo 'El mes solicitado no existe entre las fechas introducidas en la tabla<br />';
                }
            } else {//Si hubo errores...
                echo '<p style="color:red">Errores cometidos:</p>';
                echo '<ul style="color:red">';
                foreach ($errores2 as $e) {
                    echo "<li>$e</li>";
                }
                echo '</ul>';
            }
        }
        ?>
    </body>
</html>
