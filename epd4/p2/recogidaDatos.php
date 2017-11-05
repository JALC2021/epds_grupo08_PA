<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="estilo.css" />
        <title>Epd_4_p2</title>
    </head>
    <?PHP

    function autocompletar($sep, $vector, $contPAlabras, $i) {
        $pos = 0;
        $sepArray = explode(" ", $sep[$i]);
        while ($contPAlabras < $_POST["des1"]) {
            $finalArray = array();

            for ($cont = 0; $cont < count($sepArray); $cont++) {

                array_push($finalArray, $sepArray[$cont]);
                $final = false;
                if ($cont <= $pos) {
                    array_push($finalArray, $vector[$cont]);
                    $final = true;
                    $contPAlabras++;
                }
            }
            $pos++;
            if ($final === true) {
                while ($contPAlabras < $_POST["des1"]) {

                    array_push($finalArray, $vector[$pos]);
                    $contPAlabras++;
                    $pos++;
                    if ($pos == count($vector)) {
                        $pos = 0;
                    }
                }
            }
        }
        return $finalArray;
    }
    ?>
    <body>
        <?php
        if (isset($_POST['submit'])) {
            $pos = 0;
            $contPAlabras = 0;
            $encontrado = true;
            $vector = ["autoCompl1", "autoCompl2", "autoCompl3", "autoCompl4"];
            $diccionario = array(
                "espero" => "xro",
                "bien" => ":)",
                "besos" => "muak",
                "que" => "q",
            );

            $sep = explode('.', $_POST["textarea"]);

            $unir = "";
            if ($_POST["des1"] < $_POST["des2"]) {
                for ($i = 0; $i < count($sep) - 1; $i++) {
                    $contPAlabras = str_word_count($sep[$i]);

                    if (($contPAlabras >= $_POST["des1"]) && ($contPAlabras <= $_POST["des2"])) {
                        $unir .= "$sep[$i].";
                    } else if ($contPAlabras < $_POST["des1"]) {
                        $finalArray = autocompletar($sep, $vector, $contPAlabras, $i);
                        $encontrado = false;

                        $unir .= "<em><b>" . implode(" ", $finalArray) . "</b></em>.";
                    } else if ($contPAlabras > $_POST["des2"]) {

                        $encontrado = false;
                        $sepArray = explode(" ", $sep[$i]);

                        for ($m = 0; $m < count($sepArray); $m++) {

                            if (array_key_exists($sepArray[$m], $diccionario)) {

                                $sepArray[$m] = $diccionario[$sepArray[$m]];
                            }
                        }

                        while ($contPAlabras > $_POST["des2"]) {

                            unset($sepArray[count($sepArray) - 1]);
                            $contPAlabras--;
                        }
                        array_push($sepArray, "...");
                        $unir .= "<strong id='grande'>" . implode(" ", $sepArray) . "</strong>.";
                        echo $unir;
                    }
                }
            } else {
                echo "error en el deslizador<br />";
            }

            if ($encontrado == true) {
                echo "<h3>El texto es correcto</h3>";
            } else {
                echo "<h3>El texto contiene errores</h3>";
            }
        }
        ?>
    </body>
</html>