<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title></title>
    </head>
    <body>
        <?php
        if (isset($_POST['submit'])) {
            $pos = 0;
            $contPAlabras = 0;
            $encontrado = true;

            $sep = explode('.', $_POST["textarea"]);
            $unir = "";
            if ($_POST["des1"] < $_POST["des2"]) {
                for ($i = 0; $i < count($sep) - 1; $i++) {
                    $contPAlabras = str_word_count($sep[$i]);

                    if (($contPAlabras >= $_POST["des1"]) && ($contPAlabras <= $_POST["des2"])) {
                        $unir .= "$sep[$i].";
                    } else if ($contPAlabras < $_POST["des1"]) {
                        $unir .= "<b>$sep[$i]</b>.";
                        $encontrado = false;
                    } else if ($contPAlabras > $_POST["des2"]) {
                        $unir .= "<b><em>$sep[$i]</em></b>.";
                        $encontrado = false;
                    }
                }
            } else {
                echo "error en el deslizador<br>";
            }

            echo $unir;

            if ($encontrado == true) {
                echo "<h3>El texto es correcto</h3>";
            } else {
                echo "<h3>El texto contiene errores</h3>";
            }
        }
        ?>
    </body>
</html>