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
        $comprobar_ip = '/^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/';
        $comprobar_puerto = '/^(1[0-4][0-9][0-9]|1500)$/';

        if (isset($enviar) || isset($textArea)) {

            $encontrado = false;
            $sepTexPunto = explode('.', $textArea);    //recore el texto y cuando hay un (.) para e introduce la frase sin punto en un vector
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
            } else {

                echo "error en el deslizador<br>";
            }
        } else {
            echo "revisar campo texto antes de enviar";
        }
        ?>
    </body>
</html>