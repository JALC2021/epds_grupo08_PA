<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>Epd_5_ej1</title>
    </head>
    <body>
        <p> Amplíe la página desarrollada en el problema 2 del guión de la EPD anterior de tal forma que permita considerar
            textos dirigidos a un servicio de soporte técnico de redes. En concreto, el texto deberá contener una dirección IP origen, una
            dirección IP destino y dos números de puertos TCP en el rango 1000-1500. Para ello, verifique que en el texto aparecen al menos
            dos direcciones IP y dos números comprendidos en el intervalo [1000, 1500]. Use la función filter_var() de PHP, o bien expresiones
            regulares, para detectar este tipo de contenidos en el texto.</p>
        <form method="post" action="recogidaDatos.php">
            Introduzca el Texto: <br>
            <textarea name="textarea" rows="6" cols="60" required="on" maxlength="10000" minlength="1" >El puerto puede cambiar a 1501 pero el texto debe contener IP origen: 128.32.54.1 con puerto 1500 y por supuesto una IP destino: 127.0.0.1 con puerto 1342 .</textarea>
            <br><br> 
            Minimo: <input type="range" name="des1" min="1" max="10">
            <br><br>
            Máximo: <input type="range" name="des2" min="1" max="10">
            <br><br>
            <input type="submit" name="submit" value="Enviar">  
            <input type="reset" name="borrar" value="borrar">
        </form>
    </body>
</html>
