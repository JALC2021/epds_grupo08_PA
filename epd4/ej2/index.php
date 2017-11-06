<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php

//FUNCIÓN QUE CONTROLA EL FORMATO DE DÍA Y MES DE LA FECHA
function controlFecha($fecha) {
    $fechacorrecta = "";
    $mes = "";
    $arrayFecha = explode('/', $fecha);
    $dia = $arrayFecha[0];
    $mes = $arrayFecha[1];

    if (strlen($dia) < 2) {//evalua si el día de la fecha entrante tiene menos de dos dígitos
        $dia = '0' . $dia; //en el caso de que tenga menos de dos dígitos, añade un 0 antes del dígito
    } else if (strlen($mes) < 2) { //misma evaluación con el mes
        $mes = '0' . $mes;
    }
    //en cualquier caso añadimos / tras el día y la fecha
    $arrayFecha[0] = $dia . '/';
    $arrayFecha[1] = $mes . '/';
    for ($i = 0; $i < sizeof($arrayFecha); $i++) {
        $fechacorrecta.=$arrayFecha[$i]; //pasamos a una cadena el array que contiene la fecha 
    }
    return $fechacorrecta;
}

//FUNCIÓN QUE BUSCA LA FECHA CORRESPONDIENTE A UN PRECIO DADO
function busquedaFecha($precio, $campo) {
    $i = 0;
    $encontrado = false;
    $fecha = "";
    while (!$encontrado && $i < sizeof($campo)) {
        $array = explode("-", $campo[$i]); //partimos la línea de tomas de precios y fechas
        if ($precio == $array[1]) { //si el precio que entra como argumento coincide con el precio de alguna toma
            $fechaFormateada=controlFecha($array[0]); //pasamos la fecha a la función control fecha para que la devuelva con un formato correcto
            $fecha = $fechaFormateada; //se guarda la fecha correspondiente a esa toma
            $encontrado = true;
        }
        $i++;
    }
    return $fecha;
}

//FUNCIÓN QUE PASA LAS FECHAS A Nº DE DÍAS
function fechasEnDias($campo) {
    for ($i = 0; $i < sizeof($campo); $i++) {
        $arrayFecha = explode('-', $campo[$i]); //se parte la cadena de las tomas de fechas y precios
        $array = explode('/', $arrayFecha[0]); //se parte la fecha 
        $dia = $array[0];
        $mes = $array[1];
        $anio = $array[2];
        $fechaDias[$i] = GregorianToJD($mes, $dia, $anio); //pasamos la fecha a un entero que equivale a dicha fecha
    }
    return $fechaDias;
}

//FUNCIÓN QUE PASA UN Nº DE DÍAS A FECHAS
function diasAFechas($fechaDias) {
    for ($i = 0; $i < sizeof($fechaDias); $i++) {
        $enteroaFecha = JDToGregorian($fechaDias[$i]); //pasamos el entero equivalente a una fecha a formato fecha
        $arrayFecha[$i] = date("d/m/Y", strtotime($enteroaFecha)); //le damos a la fecha el formato deseado
    }
    return $arrayFecha;
}

//FUNCIÓN QUE BUSCA EL PRECIO CORRESPONDIENTE A UNA FECHA DADA
function busquedaPrecio($fecha, $campo) {
    $i = 0;
    $encontrado = false;
    $precio = "";
    while (!$encontrado && $i < sizeof($campo)) {
        $array = explode("-", $campo[$i]); //partimos la línea de tomas de precios y fechas
        $fechaFormateada = controlFecha($array[0]); //pasamos cada fecha a la función control fecha para que la devuelva 
                                                    //con un formato correcto teniendo en cuenta número de días y de mes
        if (strcmp($fecha, $fechaFormateada) == 0) { //si la fecha que entra como argumento coincide con la fecha de alguna toma
            $precio = $array[1];    //se guarda el precio correspondiente a esa toma
            $encontrado = true;
        }
        $i++;
    }
    return $precio;
}
?>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>EJ 2-EPD4</title>
        <link rel="stylesheet" type="text/css" href="estilo.css">
    </head>
    <body>
        <h1>LISTA DE PRECIOS DE GASOLINA TIPO DI&Eacute;SEL</h1>
        <form action="index.php" method="POST">

            <textarea name="texto" rows="2" cols="65" placeholder="Escriba aqu&iacute;"></textarea>
            <p>Elija criterio: obtener tabla ordenada seg&uacute;n el precio o la fecha </p>

            Precio:<input type="radio" name="criterio" value="precio">
            Fecha:<input type="radio" name="criterio" value="fecha"><br /><br />
            <p>Elija el criterio de ordenaci&oacute;n:</p><br />
            <select name="ordenacion">
                <option value="mayor">Mayor a menor</option> 
                <option value="menor">Menor a mayor</option>
            </select>
            <p>Si desea obtener la media de los precios, pulse la casilla
                <input type="checkbox" name="media" value="simedia"></p>
            <input type="submit" name="envio" value="Enviar">
        </form>
        <br />
        <?php
        if (isset($_POST['envio'])) {
            // Comprobamos que los campos obligatorios estan rellenos
            if (!isset($_POST['texto']) || $_POST['texto'] == "") {
                $errores[] = 'Indique un texto en el área de texto';
            } else {
                $textarea = $_POST['texto'];
            }
            if (!isset($_POST['criterio'])) {
                $errores[] = 'Indique un criterio';
            } else {
                $radio = $_POST['criterio'];
            }
            if (!isset($_POST['ordenacion'])) {
                $errores[] = 'Indique una ordenación';
            } else {
                $select = $_POST['ordenacion'];
            }
            if (!isset($_POST['media'])) {
                $checkbox = "nomedia";
            } else {
                $checkbox = $_POST['media'];
            }

            if (!isset($errores)) { //Si no hubo errores
                $vectorTexto = explode("\n", $textarea);
                $linea1 = explode(";", $vectorTexto[0]); //Guardamos la línea1 del área de texto
                $campo1 = explode(" ", $linea1[0]);     //Guardamos las tres
                //  tomas de fecha y hora de la línea 1
                $dateTime1Toma1 = explode("-", $campo1[0]); //Guardamos la toma 1 de la línea 1. Ahora tenemos en la primera posición del vector, la fecha y en la segunda posición el precio
                $dateTime1Toma2 = explode("-", $campo1[1]); //Guardamos la toma 2 de la línea 1     
                $dateTime1Toma3 = explode("-", $campo1[2]); //Guardamos la toma 3 de la línea 1

                $numeroMedicionesMax = count($campo1);


                $linea2 = explode(";", $vectorTexto[1]); //Guardamos la línea1 del área de texto              
                $campo2 = explode(" ", $linea2[0]);      //Guardamos las tres tomas de fecha y hora de la línea 2
                $dateTime2Toma1 = explode("-", $campo2[0]); //Guardamos la toma 1 de la línea 2. Ahora tenemos en la primera posición del vector, la fecha y en la segunda posición el precio
                $dateTime2Toma2 = explode("-", $campo2[1]); //Guardamos la toma 2 de la línea 2
                $dateTime2Toma3 = explode("-", $campo2[2]); //Guardamos la toma 3 de la línea 1

                $numeroMedicionesMin = count($campo2);

                if (strcasecmp($radio, 'precio') == 0) { //comparamos si el criterio marcado coincide con precio
                    $precio1 = $dateTime1Toma1[1];
                    $precio2 = $dateTime1Toma2[1];
                    $precio3 = $dateTime1Toma3[1];
                    $precio4 = $dateTime2Toma1[1];
                    $precio5 = $dateTime2Toma2[1];
                    $precio6 = $dateTime2Toma3[1];

                    $arrayPreciosToma1 = array($precio1, $precio2, $precio3);

                    $arrayPreciosToma2 = array($precio4, $precio5, $precio6);

                    if (strcasecmp($select, 'mayor') == 0) { //comprobamos si la ordenación elegida para el criterio precio
                        rsort($arrayPreciosToma1);             //es de mayor a menor
                        rsort($arrayPreciosToma2);
                        ?>
                        <table border="1">
                            <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Precio</th>
                                <th>Gasolinera</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?php echo busquedaFecha($arrayPreciosToma1[0], $campo1) ?></td>
                                <td><?php echo "$arrayPreciosToma1[0] €" ?></td>
                                <td rowspan="3"><?php echo "$linea1[1]" ?></td>
                            </tr>
                            <tr>
                                <td><?php echo busquedaFecha($arrayPreciosToma1[1], $campo1) ?></td>
                                <td><?php echo "$arrayPreciosToma1[1] €" ?></td>
                            </tr>
                            <tr>
                                <td><?php echo busquedaFecha($arrayPreciosToma1[2], $campo1) ?></td>
                                <td><?php echo "$arrayPreciosToma1[2] €" ?></td> 
                            </tr>
                            <tr>
                                <td><?php echo busquedaFecha($arrayPreciosToma2[0], $campo2) ?></td>
                                <td><?php echo "$arrayPreciosToma2[0] €" ?></td>
                                <td rowspan="3"><?php echo "$linea2[1]" ?></td>

                            </tr>
                            <tr>
                                <td><?php echo busquedaFecha($arrayPreciosToma2[1], $campo2) ?></td>
                                <td><?php echo "$arrayPreciosToma2[1] €" ?></td>
                            </tr>
                            <tr>
                                <td><?php echo busquedaFecha($arrayPreciosToma2[2], $campo2) ?></td>
                                <td><?php echo "$arrayPreciosToma2[2] €" ?></td> 
                            </tr>
                        </tbody>
                        </table>
                        <?php
                    } else if (strcasecmp($select, 'menor') == 0) { //comprobamos si la ordenación elegida para el criterio precio
                        sort($arrayPreciosToma1);                   //es de menor a mayor
                        sort($arrayPreciosToma2);
                        ?>
                        <table border="1">
                            <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Precio</th>
                                <th>Gasolinera</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?php echo busquedaFecha($arrayPreciosToma1[0], $campo1) ?></td>
                                <td><?php echo "$arrayPreciosToma1[0] €" ?></td>
                                <td rowspan="3"><?php echo "$linea1[1]" ?></td>
                            </tr>
                            <tr>
                                <td><?php echo busquedaFecha($arrayPreciosToma1[1], $campo1) ?></td>
                                <td><?php echo "$arrayPreciosToma1[1] €" ?></td>
                            </tr>
                            <tr>
                                <td><?php echo busquedaFecha($arrayPreciosToma1[2], $campo1) ?></td>
                                <td><?php echo "$arrayPreciosToma1[2] €" ?></td> 
                            </tr>
                            <tr>
                                <td><?php echo busquedaFecha($arrayPreciosToma2[0], $campo2) ?></td>
                                <td><?php echo "$arrayPreciosToma2[0] €" ?></td>
                                <td rowspan="3"><?php echo "$linea2[1]" ?></td>

                            </tr>
                            <tr>
                                <td><?php echo busquedaFecha($arrayPreciosToma2[1], $campo2) ?></td>
                                <td><?php echo "$arrayPreciosToma2[1] €" ?></td>
                            </tr>
                            <tr>
                                <td><?php echo busquedaFecha($arrayPreciosToma2[2], $campo2) ?></td>
                                <td><?php echo "$arrayPreciosToma2[2] €" ?></td> 
                            </tr>
                            </tbody>
                        </table>
                        <?php
                    }
                } elseif (strcasecmp($radio, 'fecha') == 0) { //comprobamos si el criterio marcado es fecha
                    if (strcasecmp($select, 'mayor') == 0) { //comprobamos si la ordenación elegida para fecha es de mayor a menor
                        //PRIMERA LÍNEA DE TOMA DE DATOS
                        $arrayFechasDias1 = fechasEnDias($campo1); //paso las fechas a días
                        rsort($arrayFechasDias1); //ordeno el array de dias de mayor a menor
                        $arrayDiasaFechas1 = diasAFechas($arrayFechasDias1); //paso los dias ordenados a fechas de nuevo
                        //SEGUNDA LÍNEA DE TOMA DE DATOS
                        $arrayFechasDias2 = fechasEnDias($campo2); //paso las fechas a días
                        rsort($arrayFechasDias2); //ordeno el array de dias de mayor a menor
                        $arrayDiasaFechas2 = diasAFechas($arrayFechasDias2); //paso los dias ordenados a fechas de nuevo
                        ?>
                        <table border="1">
                            <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Precio</th>
                                <th>Gasolinera</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?php echo $arrayDiasaFechas1[0] ?></td>
                                <td><?php echo busquedaPrecio($arrayDiasaFechas1[0], $campo1) . " €" ?></td>
                                <td rowspan="3"><?php echo "$linea1[1]" ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $arrayDiasaFechas1[1] ?></td>
                                <td><?php echo busquedaPrecio($arrayDiasaFechas1[1], $campo1) . " €" ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $arrayDiasaFechas1[2] ?></td>
                                <td><?php echo busquedaPrecio($arrayDiasaFechas1[2], $campo1) . "€" ?></td> 
                            </tr>
                            <tr>
                                <td><?php echo $arrayDiasaFechas2[0] ?></td>
                                <td><?php echo busquedaPrecio($arrayDiasaFechas2[0], $campo2) . " €" ?></td>
                                <td rowspan="3"><?php echo "$linea2[1]" ?></td>

                            </tr>
                            <tr>
                                <td><?php echo $arrayDiasaFechas2[1] ?></td>
                                <td><?php echo busquedaPrecio($arrayDiasaFechas2[1], $campo2) . " €" ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $arrayDiasaFechas2[2] ?></td>
                                <td><?php echo busquedaPrecio($arrayDiasaFechas2[2], $campo2) . " €" ?></td> 
                            </tr>
                            </tbody>
                        </table>

                        <?php
                    } else if (strcmp($select, 'menor') == 0) { //comprobamos si la ordenación elegida para fecha es de menor a mayor
                        //PRIMERA LÍNEA DE TOMA DE DATOS
                        $arrayFechasDias1 = fechasEnDias($campo1); //paso las fechas a días
                        sort($arrayFechasDias1); //ordeno el array de dias de mayor a menor


                        $arrayDiasaFechas1 = diasAFechas($arrayFechasDias1); //paso los dias ordenados a fechas de nuevo
                        //SEGUNDA LÍNEA DE TOMA DE DATOS
                        $arrayFechasDias2 = fechasEnDias($campo2); //paso las fechas a días
                        sort($arrayFechasDias2); //ordeno el array de dias de mayor a menor
                        $arrayDiasaFechas2 = diasAFechas($arrayFechasDias2); //paso los dias ordenados a fechas de nuevo
                        ?>
                        <table border="1">
                            <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Precio</th>
                                <th>Gasolinera</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?php echo $arrayDiasaFechas1[0] ?></td>
                                <td><?php echo busquedaPrecio($arrayDiasaFechas1[0], $campo1) . " €" ?></td>
                                <td rowspan="3"><?php echo "$linea1[1]" ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $arrayDiasaFechas1[1] ?></td>
                                <td><?php echo busquedaPrecio($arrayDiasaFechas1[1], $campo1) . " €" ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $arrayDiasaFechas1[2] ?></td>
                                <td><?php echo busquedaPrecio($arrayDiasaFechas1[2], $campo1) . "€" ?></td> 
                            </tr>
                            <tr>
                                <td><?php echo $arrayDiasaFechas2[0] ?></td>
                                <td><?php echo busquedaPrecio($arrayDiasaFechas2[0], $campo2) . " €" ?></td>
                                <td rowspan="3"><?php echo "$linea2[1]" ?></td>

                            </tr>
                            <tr>
                                <td><?php echo $arrayDiasaFechas2[1] ?></td>
                                <td><?php echo busquedaPrecio($arrayDiasaFechas2[1], $campo2) . " €" ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $arrayDiasaFechas2[2] ?></td>
                                <td><?php echo busquedaPrecio($arrayDiasaFechas2[2], $campo2) . " €" ?></td> 
                            </tr>
                            </tbody>
                        </table>
                        <?php
                    }
                }

                if (strcasecmp($checkbox, "simedia") == 0) {//si el valor recogido en el checkbox, coincide con "media"
                    $precio1 = str_replace(',', '.', $dateTime1Toma1[1]); //sustituimos las comas por puntos en cada fecha tomada
                    $precio2 = str_replace(',', '.', $dateTime1Toma2[1]);
                    $precio3 = str_replace(',', '.', $dateTime1Toma3[1]);
                    $precio4 = str_replace(',', '.', $dateTime2Toma1[1]);
                    $precio5 = str_replace(',', '.', $dateTime2Toma2[1]);
                    $precio6 = str_replace(',', '.', $dateTime2Toma3[1]);

                    $sumaPreciosToma1 = $precio1 + $precio2 + $precio3; //realizamos la suma y posterior media de las tomas
                    $sumaPreciosToma2 = $precio4 + $precio5 + $precio6; //correspondientes a ambas línas
                    $mediaPreciosToma1 = $sumaPreciosToma1 / $numeroMedicionesMax;
                    $mediaPreciosToma2 = $sumaPreciosToma2 / $numeroMedicionesMin;

                    echo "<br />Media correspondiente a las tomas:";
                    foreach ($linea1 as $v) {
                        echo $v;
                    }
                    echo "-> $mediaPreciosToma1 €<br />Media correspondiente a las tomas";
                    foreach ($linea2 as $a) {
                        echo $a;
                    }
                    echo "->$mediaPreciosToma2 €";
                } else if (strcasecmp($checkbox, "nomedia") == 0) {
                    echo "<br />No ha solicitado la media";
                }
            } else {
                echo '<p style="color:red">Errores cometidos:</p>';
                echo '<ul style="color:red">';
                foreach ($errores as $e) {
                    echo "<li>$e</li>";
                }
                echo '</ul>';
            }
        }
        ?>
    </body>
</html>
