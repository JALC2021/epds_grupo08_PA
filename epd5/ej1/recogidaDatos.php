<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>EPD_5_ej1</title>
    </head>
    <body>
        <?php
        $textArea = $_POST['textarea'];
        $deslizadorMin = $_POST['des1'];
        $deslizadorMax = $_POST['des2'];
        $enviar = $_POST['submit'];
        $comprobar_ip = '/^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/';
        $comprobar_puerto = '/^(1[0-4][0-9][0-9]|1500)$/';

        if (isset($enviar) || isset($textArea)) {

            $encontrado = false;
            $sepTexPunto = explode('.', $textArea);    //recore el texto y cuando hay un (.) para e introduce la frase sin punto en un vector
            $sepTextEspacio = explode(' ', $textArea);
            $unir = " ";

            if ($deslizadorMin < $deslizadorMax) {
                $contMin = 0;
                $contMax = 0;

                for ($i = 0; $i < count($sepTexPunto); $i++) {

                    $contPAlabras = str_word_count($sepTexPunto[$i]);   //cuento las palabras

                    if ($contPAlabras == $deslizadorMin) {

                        $contMin++;
                    } elseif ($contPAlabras == $deslizadorMax) {

                        $contMax++;
                    }

                    if ($contPAlabras < $deslizadorMin) {

                        echo "<font color='red'>" . $unir = $sepTexPunto[$i] . "." . "</font>";
                    } else if ($contPAlabras > $deslizadorMax) {

                        echo "<font color='green'>" . $unir = $sepTexPunto[$i] . "." . "</font>";
                    } else if (($contPAlabras == $deslizadorMin) || ($contPAlabras == $deslizadorMax )) {
                        echo "<font>" . $unir = $sepTexPunto[$i] . "." . "</font>";
                    }
                }
                if ($contMin == $contMax) {
                    echo "<h3>El texto contiene errores</h3>";
                } else {
                    echo "<h3>El texto no contiene errores</h3>";
                }
                
                echo "<br><h3>El texto contiene Ip y Puerto</h3>";
                echo "<p>$textArea</p>";

                for ($j = 0; $j < count($sepTextEspacio); $j++) {

                    if (preg_match($comprobar_ip, $sepTextEspacio[$j])) {

                        echo "IP: " . $sepTextEspacio[$j] . "<br>";
                    }
                    if (preg_match($comprobar_puerto, $sepTextEspacio[$j])) {
                        echo "PUERTO: " . $sepTextEspacio[$j] . "<br>";
                    }
                }
            } else {

                echo "error en el deslizador<br>";
            }
        } else {
            echo "revisar campo texto antes de enviar";
        }
        ?>
    </body>
</html>
