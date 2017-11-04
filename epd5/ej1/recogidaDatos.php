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
        $comprobar_puerto = '/[^.]^1[0-5]|[0-4]{1}[0-9][0-9]{2}$/';
//        '/^(6553[0-5]|655[0-2][0-9]|65[0-4][0-9]{2}|[0-9]{3}|[0-5]?([0-9]){0,3}[0-9])$/';
//        $rango_puerto_min = 1000;
//        $rango_puerto_max = 1500;
//        $comprobar_puerto = filter_var();

        if (isset($enviar) || isset($textArea)) {

            $sep = explode(' ', $textArea);


            for ($i = 0; $i < count($sep); $i++) {

                if (preg_match($comprobar_ip, $sep[$i])) {

                    echo "IP: " . $sep[$i] . "<br>";
                }
                if (preg_match($comprobar_puerto, $sep[$i])) {
                    echo "PUERTO: " . $sep[$i] . "<br>";
                }
            }
        } else {
            echo "revisar campo texto antes de enviar";
        }
        ?>
    </body>
</html>
