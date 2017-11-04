<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>Epd_4_p2</title>
    </head>
    <body>
        <p>Mejore el sistema de detección de frases cortas/largas desarrollado en el ejercicio anterior de tal forma que solvente
            automáticamente las frases que exceden los límites. Para ello, por una parte, dispondremos de un vector de palabras que servirá
            para rellenar texto en las frases cortas. En concreto, las palabras del vector se irán intercalando entre palabra y palabra en las
            frases cortas hasta que éstas alcancen el umbral mínimo. Para las frases largas, se dispondrá de un vector asociativo de
            abreviaturas (palabra → abreviatura), de manera que habrá que buscar en las frases largas las palabras que estén en el vector de
            abreviaturas y sustituirlas por éstas. Si, tras esta sustitución, la frase sigue sobrepasando el límite, se eliminarán todos los
            caracteres que sobren (desde el final de la frase) e introducir puntos suspensivos (...) al final de la frase. El sistema deberá mostrar
            el texto original y el texto al que se le han aplicado las correcciones automáticas, marcando éstas con un formato de énfasis
            (distinto al empleado en el ejercicio anterior).</p>
        <form method="post" action="recogidaDatos.php">
            Introduzca el Texto: <br>
            <textarea name="textarea" rows="6" cols="60" required="on" maxlength="10000" minlength="1" >hola.Dos palabras.cinco ya es demasiado.</textarea>
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
<!--Amplíe la página desarrollada en el problema 2 del guión de la EPD anterior de tal forma que permita considerar
textos dirigidos a un servicio de soporte técnico de redes. En concreto, el texto deberá contener una dirección IP origen: 142.40.14.32, una
dirección IP destino: 127.0.0.1  y dos números de puertos TCP en el rango 1000-1500. Para ello, verifique que en el texto aparecen al menos
dos direcciones IP y dos números comprendidos en el intervalo [1000, 1500]. Use la función filter_var() de PHP, o bien expresiones-->
<!--regulares, para detectar este tipo de contenidos en el texto.-->