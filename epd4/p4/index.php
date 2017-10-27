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

    /* función que comprueba si la suma de los elementos de la diagonal es mayor
      que el número escalar intrducido */

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
    function imprimirMatrix($matrix) {
        echo "<table border=1>";
        foreach ($matrix as $fila) {
            echo "<tr>";
            foreach ($fila as $valor) {

                echo "<td>$valor</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        echo "<br />";
    }

    /* función que nos devuelve un vector con los elementos de la diagonal principal
      multiplicados por su escalado */

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

    //función principal
    function principal($matrix, $escalar) {

        //Creamos un vector para recibir la diagonal principal multiplicada por el escalar
        $triang = array();

        //imprimimos el valor del escalar elegido
        echo "Valor del escalado: $escalar <br /><br />";

        /* Comprobamos la suma de la diagonal principal. Si es false no continuamos, en caso
          contrario continuamos con el programa */
        if (!comprobarSumaDiag($matrix, $escalar)) {

            echo "El valor del escalar es mayor que al de la suma de la diagonal";
        } else {
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
    }
    ?>
    <body>
        <header>
            <h1>EPD 4 - Problema 4 </h1>
        </header>
        <article>

            <?php
            //Si se ha enviado el formulario nº1 y es numérico la dimensión y que el dígito esté comprendido entre 1 y 10
            if (isset($_POST['envio1']) && is_numeric($_POST['dimension']) && (preg_match('/^[[:digit:]]{1}0$/', $_POST['dimension']) || preg_match('/^[[:digit:]]{1}$/', $_POST['dimension'])) && !preg_match('/^0$/', $_POST['dimension'])) {
                ?>  

                <form method="POST">
                    <table border = 1>
                        <?php
                        for ($i = 0; $i < $_POST['dimension']; $i++) {
                            ?><tr><?php
                                for ($j = 0; $j < $_POST['dimension']; $j++) {
                                    ?> <td>
                                        Elemento[<?php echo $i; ?>][<?php echo $j; ?>]: 
                                        <input type="text" name="elemento<?php echo $i; ?><?php echo $j; ?>" required>
                                    </td>
                                    <?php
                                }
                                ?></tr><?php
                        }
                        ?>   
                    </table>
                    Escalar: <input type="text" name="escalar" required>
                    <input type="hidden" name="dimension" checked="checked" value ="<?php echo $_POST['dimension']; ?>" >
                    <br />
                    <input type="submit" name="envio2"  value="Enviar">


                </form>

                <?php
                //si enviamos el formulario nº2
            } else if (isset($_POST['envio2'])) {
                //comprobamos si todos los elementos de la matriz son numéricos
                $elementosCond = True;
                for ($i = 0; $i < $_POST['dimension']; $i++) {
                    for ($j = 0; $j < $_POST['dimension']; $j++) {
                        if (!is_numeric($_POST["elemento" . $i . $j])) {
                            $elementosCond = False;
                            break;
                        }
                    }
                }
                //si el escalar es numérico y todos los elementos son numéricos, añadimos a una matriz bidimensional los elementos
                if (is_numeric($_POST['escalar']) && $elementosCond) {
                    $matrix = array();
                    for ($i = 0; $i < $_POST['dimension']; $i++) {
                        for ($j = 0; $j < $_POST['dimension']; $j++) {
                            $matrix[$i][$j] = $_POST["elemento" . $i . $j];
                        }
                    }
                    //llamamos a la función principal dónde le pasamos el escalar y la matriz
                    principal($matrix, $_POST['escalar']);

                    //Si alguna de las 2 condiciones no es cierta
                } else {
                    ?>  
                    <form method="POST">
                        <!-- Comprobamos elemento por elemento si es numérico o no, en el caso que no lo sea, se mostrará el fondo rojo -->
                        <?php ?><table border="1"><?php
                            for ($i = 0; $i < $_POST['dimension']; $i++) {
                                ?><tr><?php
                                    for ($j = 0; $j < $_POST['dimension']; $j++) {

                                        if (!is_numeric($_POST["elemento" . $i . $j])) {
                                            ?> <td>
                                                Elemento[<?php echo $i; ?>][<?php echo $j; ?>]: 
                                                <input style='background-color: #ff7e7e' type="text" name="elemento<?php echo $i; ?><?php echo $j; ?>" required>
                                            </td>
                                            <?php
                                        } else {
                                            ?><td>
                                                Elemento[<?php echo $i; ?>][<?php echo $j; ?>]: 
                                                <input type="text" name="elemento<?php echo $i; ?><?php echo $j; ?>" value ="<?php echo $_POST["elemento" . $i . $j] ?>" required>
                                            </td>
                                            <?php
                                        }
                                    }
                                    ?></tr><?php
                            }
                            ?></table>
                            <?php
                            if (!is_numeric($_POST['escalar'])) {
                                ?>
                            Escalar: <input style='background-color: #ff7e7e' type="text" name="escalar" autofocus required>
                            <br />
                            <?php
                        } else {
                            ?>
                            Escalar: <input type="text" name="escalar" value = "<?php echo $_POST['escalar']; ?>" autofocus required>
                            <br />
                        <?php }
                        ?>
                        <input type="hidden" name="dimension" checked="checked" value ="<?php echo $_POST['dimension']; ?>" >
                        <input type="submit" name="envio2"  value="Enviar">
                    </form>
                    <?php
                }
            } else {
                //Si se ha introducido una dimensión y no es numérica o no está comprendida entre el 1 y el 10, se imprimirá por pantalla.
                if (isset($_POST['dimension'])) {
                    if (!is_numeric($_POST['dimension'])) {
                        echo "* Debe introducir un número en el campo 'Dimensión de la Matriz'";
                    } else if (!preg_match('/^[[:digit:]]{1}0$/', $_POST['dimension']) || !preg_match('/^[[:digit:]]{1}$/', $_POST['dimension']) || !preg_match('/^0$/', $_POST['dimension'])) {
                        echo "* Debe introducir un número entre el 1 y el 10";
                    }
                }
                ?>
                <!--formulario nº1 y principal-->
                <form method="POST">
                    Dimensi&oacute;n de la Matrix (1-10): <input type="text" name="dimension" autofocus required>

                    <br />
                    <input type="submit" name="envio1" value="Enviar">


                </form>
                <?php
            }
            ?> 
        </article>
        <footer>
            <h2>Realizado por Gonzalo del Rio Alaez | Juan Antonio López Cano | Susana Mercedes de la Calle Iglesias</h2>
        </footer>
    </body>
</html>
