<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>PA-EPD3-P5-Grupo8</title>
        <style>
            body{
                background-color:#cfcfcf;
                font-size: 20px;

            }
            h1,h2{
                text-align: center;
                border: solid red 1px;
            }
            h1{         
                font-size: 30px;
                background-color:  #a7f5f1; 
            }
            h2{
                font-size: 17px;
                background-color:  #a7f5f1; 
            }
            strong{

                color: #f25e5e
            }
            ol{

                padding: 2% 5% 2% 5%;
                border: double 3px white;

            }
            article{
                
                padding-left: 20px;
            }
        </style>
    </head>
    <?php

    //convierte los elementos de la triangular inferior en el valor del escalado elemento a elemento
    function TriangMatrix($matrix, &$triang, $escalar) {
        $diag = 0;
        for ($i = 0; $i < sizeof($matrix); $i++) {
            for ($j = 0; $j < sizeof($matrix); $j++) {
                if ($j >= $diag) {
                    $triang[$i][$j] = $matrix[$i][$j];
                } else {
                    $triang[$i][$j] = $escalar;
                }
            }
            $diag++;
        }
        return true;
    }

    /*función que comprueba si la suma de los elementos de la diagonal es mayor
    que el número escalar intrducido*/
    function comprobarSumaDiag($matrix, $escalar) {
        $sumDiag = 0;
        for ($i = 0; $i < sizeof($matrix); $i++) {
            for ($j = 0; $j < sizeof($matrix); $j++) {
                if ($i == $j) {
                    $sumDiag += $matrix[$i][$j];
                }
            }
        }
        if ($escalar <= $sumDiag) {

            return true;
        } else {

            return false;
        }
    }
    
    //imprime la matriz en una tabla sin comprobar nada anteriormente.
    function imprimirMatrix($matrix){
        echo "<table border=1>";
            foreach ($matrix as $fila) {
                echo "<tr>";
                foreach($fila as $valor){

                    echo "<td>$valor</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        echo "<br />";
    }

    /*función que nos devuelve un vector con los elementos de la diagonal principal
    multiplicados por su escalado*/
    function multDiag($matrix, $escalar) {
        $cont = 0;
        for ($i = 0; $i < sizeof($matrix); $i++) {
            for ($j = 0; $j < sizeof($matrix); $j++) {
                if ($i == $j) {
                    $diag[$cont] = $matrix[$i][$j] * $escalar;
                    echo "| $diag[$cont] ";
                    $cont++;
                }
            }
        }
        echo "|";
        return $diag;
    }

    //Inicializa la matriz 4x4
    function inicializarMatrix() {
        $matrix = array();
        for ($i = 0; $i < 4; $i++) {
            for ($j = 0; $j < 4; $j++) {

                $matrix[$i][$j] = $j;
            }
        }
        return $matrix;
    }
    ?>
    <body>
        <header>
            <h1>EPD 3 - Problema 5 </h1>
        </header>
        <article>
<?php
//Inicializamos la matriz
$matrix = inicializarMatrix();
//Elegimos un número escalar
$escalar = 4;
//Creamos un vector para recibir la diagonal principal multiplicada por el escalar
$triang = array();

//imprimimos el valor del escalar elegido
echo "Valor del escalado: $escalar <br /><br />";

/*Comprobamos la suma de la diagonal principal. Si es false no continuamos, en caso
  contrario continuamos con el programa*/
if(!comprobarSumaDiag($matrix, $escalar)){
    
    echo "El valor del escalar es mayor que al de la suma de la diagonal";
    
}else{
    echo "Matriz Inicial: <br />";
    imprimirMatrix($matrix);
    //Guardamos la nueva matriz en la variale $triang que se pasa por referencia
    TriangMatrix($matrix, $triang, $escalar);
    echo "Matriz Triangular superior: <br />";
    //imprimimos la nueva matriz
    imprimirMatrix($triang);
    echo "Diagonal principal por el escalado: ";
    //calculamos e imprimimos el vector
    multDiag($matrix, $escalar);
    
}

?>

        </article>
        <footer>
            <h2>Realizado por Gonzalo del Rio Alaez | Juan Antonio López Cano | Susana Mercedes de la Calle Iglesias</h2>
        </footer>
    </body>
</html>
