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
        <title>PROBLEMA 1-EPD3</title>
    </head>
    <body>
     
        <h1>SECUENCIA DE N N&Uacute;MEROS COMPUESTOS</h1>
        <?php
        define('EVALUACION_NUMERO',5);
        function compuestos($numero) {
            $salida = 0;
            $veces = 0;
            if ($numero >= 2) {/* Comprobamos que el número no sea 0 ni 1 porque dichos números no son compuestos,
              dividiremos desde 2 hasta el nº anterior, al número dado */
                for ($divisor = 2; $divisor < $numero; $divisor++) {

                    if ($numero % $divisor == 0) {
                        $veces++;
                    }
                }/* si el nº es compuesto, el resto de la división ha debido ser 0 al menos una vez, 
                 lo que quiere decir, que dicho nº tendrá al menos 3 divisores, y por tanto, será compuesto  */
                if ($veces != 0) {
                    $salida = 1;
                }
            }
            return $salida;
        }

        // echo compuestos(25);


        function vectorNumCompuestos($n) {
            $cont = 0;
            $i = 2;
            $vector = array();//array donde guardaremos la secuencia de n numeros compuestos
            while ($cont < 2 * $n) {//mientras no hayamos obtenido 2*n números compuestos, seguimos iterando
               if(($recogida = compuestos($i))==1){ //recogemos lo que devuelve compuestos y lo evaluamos
                    $vector[] = $i; //en el caso de que devuelva 1(nº compuesto), lo guardamos en el vector
                    $cont++;
                }
                $i++;
            }
            sort($vector); //¿Hace falta sort()?ya sale ordenado..//sort() ordena el vector de menor a mayor
            return $vector;
        }

        $resultado = vectorNumCompuestos(EVALUACION_NUMERO);
        echo "<table border=1>";
        echo "<tr>";
        foreach ($resultado as $valor)
            echo "<td>".$valor . "</td>";
        echo "</tr>";
        echo "</table>";
        ?>

    </body>
</html>
