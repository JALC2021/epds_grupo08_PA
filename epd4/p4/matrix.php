<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if (isset($_POST['envio'])) {
            echo "Recibido el valor: " . $_POST['escalar'];
            ?>
            <form action = "." method="POST">
                Escalar<input type="text" name="escalar" autofocus required>
                <br />
                <input type="submit" name="envio" value="Enviar">
            </form>
            <?php
        } else {
            header("Location: index.php");
        }
        ?>

    </body>
</html>
