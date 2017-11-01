<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title></title>
    </head>
    <body>
        <?php
        $pos = 0;
        $contPAlabras = 0;
        $encontrado = false;

        echo "<br><br>";
        $sep = explode('.', $_POST["textarea"]);
        print_r($sep);
        echo "<br><br>";
        if ($_POST["des1"] < $_POST["des2"]) {
            for ($i = 0; $i < count($sep); $i++) {
                $contPAlabras = str_word_count($sep[$i]);
                echo "<br><br>";
                echo "<br><br>";

                if (($contPAlabras = $_POST["des1"]) && ($contPAlabras = $_POST["des2"])) {
                    $encontrado = TRUE;
                } else {
                    $encontrado = FALSE;
                    $unir = implode('.', $sep);
                    print_r($unir);
                }
            }
        } else {
            echo "error en el deslizador<br>";
        }
        if ($encontrado == TRUE) {
            echo "<h3>El texto es correcto</h3>";
            echo $_POST["textarea"];
//            $unir = implode('.', $sep);
//            print_r($unir);
        } else {
            
        }


        echo "<br><br>";
        echo $_POST["des1"];
        echo "<br><br>";
        echo $_POST["des2"];
        ?>
    </body>
</html>