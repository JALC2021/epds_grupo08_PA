<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>EJ 1-EPD4</title>
        <link rel="stylesheet" type="text/css" href="estilo.css">
    </head>
    <body>

        <h1>LISTA DE PRECIOS DE GASOLINA TIPO DI&Eacute;SEL</h1>


        <form action="index.php" method="POST">

            <textarea name="texto" rows="4" cols="65" placeholder="Escriba aqu&iacute;.."></textarea>

            <input type="submit" name="envio" value="Enviar" />

        </form>

        <h2>RESUMEN CONSULTA</h2>
        <?php
        if (isset($_POST['envio'])) { //Evaluamnos si se ha pulsado el botón Enviar
            $texto = "";
            $envio = "";
            // Comprobamos que los campos obligatorios estan rellenos
            if ($_POST['texto'] == "") {
                $errores[] = 'Error. El &aacute;rea de texto est&aacute; vac&iacute;a<br/>';
            } else {
                $texto = $_POST['texto'];
            }




            if (!isset($errores)) {

                $vectorTexto = explode("\n", $texto);
                $linea1 = explode(";", $vectorTexto[0]); //Guardamos la línea1 del área de texto
                $campo1 = explode(" ", $linea1[0]);     //Guardamos las tres tomas de fecha y hora de la línea 1
                $dateTime1Toma1 = explode("-", $campo1[0]); //Guardamos la toma 1 de la línea 1. Ahora tenemos en la primera posición del vector, la fecha y en la segunda posición la hora
                $dateTime1Toma2 = explode("-", $campo1[1]); //Guardamos la toma 2 de la línea 1     
                $dateTime1Toma3 = explode("-", $campo1[2]); //Guardamos la toma 3 de la línea 1  

                $linea2 = explode(";", $vectorTexto[1]); //Guardamos la línea1 del área de texto
                $campo2 = explode(" ", $linea2[0]);      //Guardamos las tres tomas de fecha y hora de la línea 2
                $dateTime2Toma1 = explode("-", $campo2[0]); //Guardamos la toma 1 de la línea 2. Ahora tenemos en la primera posición del vector, la fecha y en la segunda posición
                $dateTime2Toma2 = explode("-", $campo2[1]); //Guardamos la toma 2 de la línea 2
                $dateTime2Toma3 = explode("-", $campo2[2]); //Guardamos la toma 3 de la línea 1
                //ordenamos los precios de las tomas máximas
                $vectorPreciosMax[0] = $dateTime1Toma1[1];
                $vectorPreciosMax[1] = $dateTime1Toma2[1];
                $vectorPreciosMax[2] = $dateTime1Toma3[1];

                rsort($vectorPreciosMax);

                if ($vectorPreciosMax[0] == $dateTime1Toma1[1]) {//si precio máximo coincide con el precio de la primera toma
                    $fecha = $dateTime1Toma1[0]; //la hora correspondiente a ese precio, es la hora de la primera toma
                } elseif ($vectorPreciosMax[0] == $dateTime1Toma2[1]) {
                    $fecha = $dateTime1Toma2[0];
                } else {
                    $fecha = $dateTime1Toma3[0];
                }

                //ordenamos los precios de las tomas mínimas
                $vectorPreciosMin[0] = $dateTime2Toma1[1];
                $vectorPreciosMin[1] = $dateTime2Toma2[1];
                $vectorPreciosMin[2] = $dateTime2Toma3[1];

                sort($vectorPreciosMin);

                if ($vectorPreciosMin[0] == $dateTime2Toma1[1]) {//si precio mínimo coincide con el precio de la primera toma
                    $fechaMin = $dateTime2Toma1[0]; //la hora correspondiente a ese precio, es la hora de la primera toma
                } elseif ($vectorPreciosMin[0] == $dateTime2Toma2[1]) {
                    $fechaMin = $dateTime2Toma2[0];
                } else {
                    $fechaMin = $dateTime2Toma3[0];
                }
                ?>
                <table border="1">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Precio</th>
                            <th>Gasolinera</th>
                            <th>M&Aacute;X/M&Iacute;N</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td><?php echo "$fecha" ?></td>
                            <td><?php echo "$vectorPreciosMax[0] €" ?></td>
                            <td ><?php echo "$linea1[1]" ?></td>
                            <td ><?php echo "$linea1[2]" ?></td>
                        </tr>
                        <tr>
                            <td><?php echo "$fechaMin" ?></td>
                            <td><?php echo "$vectorPreciosMin[0] €" ?></td>
                            <td ><?php echo "$linea2[1]" ?></td>
                            <td ><?php echo "$linea2[2]" ?></td>
                        </tr>
                    </tbody>

                </table>
                <?php
            } else {
                foreach ($errores as $e) {
                    echo "$e";
                }
            }
        }
        ?>

    </body>
</html>
