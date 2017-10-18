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

    function imprimirMatrix($matrix, $escalar) {
        if (comprobarSumaDiag($matrix, $escalar) == true) {
            imprimirMatrixIni($matrix);
            return true;
        }else{
            
            return false;
            
        }
    }
    
    function imprimirMatrixIni($matrix){
        echo "<table border=1>";
            foreach ($matrix as $fila) {
                echo "<tr>";
                foreach($fila as $valor){

                    echo "<td>$valor</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        
    }

    function multDiag($matrix, $escalar) {
        $cont = 0;
        for ($i = 0; $i < sizeof($matrix); $i++) {
            for ($j = 0; $j < sizeof($matrix); $j++) {
                if ($i == $j) {
                    $diag[$cont] = $matrix[$i][$j] * $escalar;
                    echo "$diag[$cont] ";
                    $cont++;
                }
            }
        }
        return $diag;
    }

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
$matrix = inicializarMatrix();
$escalar = 4;
$triang = array();
echo "Matriz Inicial: <br />";
$comprobacion = imprimirMatrix($matrix,$escalar);
echo "Valor del escalado: $escalar <br />";
if($comprobacion == false){
    
    echo "El valor del escalar es mayor que al de la suma de la diagonal";
    
}else{
    
    TriangMatrix($matrix, $triang, $escalar);
    echo "Matriz Triangular superior: <br />";
    imprimirMatrix($triang,$escalar);
    echo "Diagonal por el escalado: ";
    multDiag($matrix, $escalar);
    
}

?>

        </article>
        <footer>
            <h2>Realizado por Gonzalo del Rio Alaez | Juan Antonio López Cano | Susana Mercedes de la Calle Iglesias</h2>
        </footer>
    </body>
</html>
