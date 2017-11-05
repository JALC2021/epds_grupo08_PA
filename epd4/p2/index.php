<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="estilo.css" />
        <title>Epd_4_p2</title>
    </head>
    <body>
        <form method="post" action="recogidaDatos.php">
            Introduzca el Texto: <br />
            <textarea name="textarea" rows="6" cols="60" maxlength="10000" >juan.miarma y como que. hola pepe como estas hijo. yo bien y tu. que tal estas, espero que muy bien besos.</textarea>
        </textarea>
        <br /><br />
        Minimo: <input type="range" name="des1" min="1" max="10">
        <br /><br />
        Máximo: <input type="range" name="des2" min="1" max="10">
        <br /><br />
        <input type="submit" name="submit" value="Enviar">  
        <input type="reset" name="borrar" value="borrar">
    </form>
</body>
</html>
