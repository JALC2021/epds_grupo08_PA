<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>Epd_4_p1</title>
    </head>
    <body>
        <?php
        $textArea = $_POST['textarea'];
        $deslizadorMin = $_POST['des1'];
        $deslizadorMax = $_POST['des2'];
        $enviar = $_POST['submit'];

        if (isset($enviar) || isset($textArea)) {

            $encontrado = false;
            $sep = explode('.', $textArea);    //recore el texto y cuando hay un (.) para e introduce la frase sin punto en un vector
//        print_r($sep); 
            $unir = " ";
            $contMin = 0;
            $contMax = 0;

            if ($deslizadorMin < $deslizadorMax) {
                $contMin = 0;
                $contMax = 0;

                for ($i = 0; $i < count($sep) - 1; $i++) {

                    $contPAlabras = str_word_count($sep[$i]);   //cuento las palabras

                    if ($contPAlabras == $deslizadorMin) {

                        $contMin++;
                    } elseif ($contPAlabras == $deslizadorMax) {

                        $contMax++;
                    }

                    if ($contPAlabras < $deslizadorMin) {

                        echo "<font color='red'>" . $unir = $sep[$i] . "." . "</font>";
                    } else if ($contPAlabras > $deslizadorMax) {

                        echo "<font color='green'>" . $unir = $sep[$i] . "." . "</font>";
                    } else if (($contPAlabras == $deslizadorMin) || ($contPAlabras == $deslizadorMax )) {
                        echo "<font>" . $unir = $sep[$i] . "." . "</font>";
                    }
                }

                if ($contMin == $contMax) {
                    echo "<h3>El texto no contiene errores</h3>";
                } else {
                    echo "<h3>El texto contiene errores</h3>";
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