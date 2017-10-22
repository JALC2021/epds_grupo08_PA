<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="estilo.css" />
        <title>EJERCICIO 1-EPD3</title>
    </head>
    <body>
        <h1>N&Uacute;MEROS PRIMOS QUE ALBERGA<br /> LA SUCESI&Oacute;N DE FIBONACCI <br /> MENORES A 10.000</h1>
        <?php

        //FUNCIONES
        function primos($numero) {
            $salida = 0;
            $veces = 0;
            if ($numero >= 2) {/* Comprobamos que el número no sea 0 ni 1 porque dichos números no son primos,
              dividiremos entre 2 y el nº anterior, al número dado */
                for ($contP = 2; $contP < $numero; $contP++) {

                    if ($numero % $contP == 0) {
                        $veces++;
                    }
                }/* si el nº es primo, el resto de la división no ha debido ser 0 ninguna vez, ya que no 
                  hemos dividido ni por 1 ni por sí mismo(condición de número primo) */
                if ($veces == 0) {
                    $salida = $numero;
                }
            }
            return $salida;
        }

        function fibonacciPrimos() {
            //Necesitaremos los dos últimos números para realizar la suma del número siguiente de la sucesión
            $numAnterior = 0;
            $numActual = 1;
            //  $salida = "";
            //Almacenaremos en un array los números primos de la sucesión menores a 10.000
            $arraySalida = array();
            $suma = 0;
            //Aquel número que sea primo, será válido
            $numValido = 0;
            //Mientras el último número resultante de la sucesión sea menor a 10.000 seguimos iterando
            while ($suma < 10000) {

                $numValido = primos($suma);
            //Como primos() devuelve un 0 en caso de que el número no sea primo, lo verificamos
                if ($numValido != 0) {

                    $arraySalida[] = $numValido;
                    //$salida=$numValido;
                }
                //Actualizamos la suma, y los valores de los dos números anteriores al último calculado
                $suma = $numAnterior + $numActual;
                $numAnterior = $numActual;
                $numActual = $suma;
            }

            return $arraySalida;
            //return $salida;
        }

        $vectorSalida = fibonacciPrimos();

        echo "<table border=1>";
        echo "<tr>";
        foreach ($vectorSalida as $valor)
            echo "<td>" . $valor . "</td> ";
        //echo "<td". $salida . "</td>";
        echo "</tr>";

        echo "</table>";
        ?>


    </body>
</html>
