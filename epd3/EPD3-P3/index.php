<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>PA-EPD3-P3-Grupo8</title>
        <style>
            body{
                background-color:#cfcfcf
                
            }
            h1,h2{
                text-align: center;
                border: solid red 1px;
            }
            h1{         
                font-size: 20px;
                background-color:  #a7f5f1; 
            }
            h2{
                font-size: 12px;
                background-color:  #a7f5f1; 
            }
            strong{
                
                color: #f25e5e
            }
            ol{
                
                padding: 2% 5% 2% 5%;
                border: double 3px white;
                
            }
        </style>
    </head>
    <?php

    //la función recibe como argumento un número
    function sumNumPares($numero) {
        $indice = 0;
        $sum = 0;
        for ($i = 1; $i <= $numero; $i++) {

            if ($i % 2 == 0) {
                //añadimos los factores que intervienen en la suma;
                $factores[$indice] = $i;
                $sum += $i;
                $indice++;
            }
        }

        /* La función devuelve un vector que contenga el número dado (1er argumento), 
          el resultado de la suma(2º argumento) y otro vector que será los factores
          que intervienen en la suma (3er argumento) */
        $res = array($numero, $sum, $factores);

        return $res;
    }
    ?>
    <body>
        <header>
            <h1>EPD 3-Problema 3: Calcular el sumatorio de los primeros <em>n</em> números pares del 1 al 200 </h1>
        </header>
        <article>
            <p>A continuación, calcularemos el sumatorio de los primeros números pares de la secuencia 
                numérica hasta el número 200.<br /><br />
            
            Los factores que intervienen en la resolución son los siguientes:<br /><br />
            <ol>
            <?php
            $res = sumNumPares(200);
            echo "<li>Número: <strong>$res[0]</strong><br /><li>Suma total: <strong>$res[1]</strong><br /><li>Factores: | ";
            foreach($res[2] as $factor){
                
                echo "<strong>$factor</strong>".' | ';
                
            }
            echo '<br />';
            ?>
            </ol>
            </p>
        </article>
        <footer>
            <h2>Realizado por Gonzalo del Rio Alaez | Juan Antonio López Cano | Susana Mercedes de la Calle Iglesias</h2>
        </footer>
    </body>
</html>
