<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>EPD3_P4</title>
    </head>
    <body>
        <p>Cree una función PHP a la que se le pase como argumento una matriz con los tiempos de actividad física de varias
            personas medidos mediante una pulsera inteligente. Existen tres tipos de tiempos: reposo, caminando y corriendo. Esta matriz
            contendrá en cada fila los tiempos de una persona y en cada columna el tiempo (medido en minutos) en el que ha estado en
            reposo, caminando y corriendo (tres columnas). La función deberá generar una página web que (haciendo uso de tablas) muestre
            los tiempos de todas las personas, así como el porcentaje del tiempo total que supone el tiempo en el que cada persona ha estado
            en reposo. Por último, deberá añadirse una última fila con la media de tiempo por cada tipo de tiempo (reposo, caminando y
            corriendo) teniendo en cuenta el tiempo de todas las personas. Para comprobar el funcionamiento de la función desarrollada, cree
            una página PHP que llame a ésta usando una matriz predefinida por usted.</p>
        <p>***********************************************************************************************************************</p>
        <?php

        function matrizInicial($m) {
            echo "<table border=1>";
            echo "<caption>Tabla de Datos</caption>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Reposo'</th>";
            echo "<th>Caminando'</th>";
            echo "<th>Corriendo'</th>";
            echo "</tr>";
            echo "</thead>";


            foreach ($m as $fila) {
                echo "<tr>";
                echo"<tbody>";
                echo "<tr>";

                foreach ($fila as $columna) {
                    echo "<td>$columna</td>";
                }

                echo "</tr>";
            }
            echo "</tr>";
            echo "</tbody>";
            echo "</table>";
        }
        ?>
        <?php

        function porcentaje_media($m, $numPersonas) {
            $minutos_Fil = 0;
            $minutos_Col = 0;
            $porcent = 0;
            $media = 0;


            for ($nfil = 0; $nfil < count($m); $nfil++) {

                for ($ncol_valor = 0; $ncol_valor < count($m[$nfil]); $ncol_valor++) {

                    $minutos_Fil += $m[$nfil][$ncol_valor];
                    $minutos_Col += $m[$ncol_valor][$nfil];
                }
                round($m[$nfil][] = $minutos_Fil, 2);
                round($m[$nfil][] = $porcent = ($m[$nfil][0]) * 100 / $minutos_Fil, 2);
                number_format($m[$ncol_valor][$nfil] = $media = $minutos_Col / $numPersonas, 2);

                $minutos_Fil = 0;
                $minutos_Col = 0;
                $porcent = 0;
                $media = 0;
            }


            echo "<table border=1>";
            echo "<caption>Tabla de Datos Total</caption>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Reposo'</th>";
            echo "<th>Caminando'</th>";
            echo "<th>Corriendo'</th>";
            echo "<th>Total Persona'</th>";
            echo "<th>% Reposo</th>";
            echo "</tr>";
            echo "</thead>";


            foreach ($m as $fila) {
                echo "<tr>";
                echo"<tbody>";
                echo "<tr>";

                foreach ($fila as $columna) {
                    echo "<td>$columna</td>";
                }
                echo "</tr>";
            }
            echo "</tr>";
            echo "</tbody>";
            echo "</table>";
        }
        ?>

        <?php
        $p1 = array(3, 10, 5);
        $p2 = array(8, 20, 14);
        $p3 = array(10, 15, 30);
        $matriz = array($p1, $p2, $p3);
        $numPersonas = count($matriz);
        ?>

        <?php
        matrizInicial($matriz);
        echo "<br/>";
        porcentaje_media($matriz, $numPersonas);
        ?>

    </body>
</html>
