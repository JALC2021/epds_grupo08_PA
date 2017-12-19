<!DOCTYPE html>
<html lang="es-ES">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>Gamerstation</title>
        <link rel="stylesheet" href="style.css" />
        <script type="text/javascript">
            function cabecera() {
                var matriz = new Array('cabecera1.png', 'cabecera2.png', 'cabecera3.png', 'cabecera4.png');
                var aleatorio = Math.floor(Math.random() * (matriz.length));
                document.write('<a href="index.php"><img src="imagenes/' + matriz[aleatorio] + '"/></a>');
            }
        </script>
    </head>
    <body>
        <header>
            <script type="text/javascript">
                cabecera();
            </script>
        </header>
