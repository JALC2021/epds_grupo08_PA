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
        if (isset($_POST['enviar'])) {
            $con = mysqli_connect("localhost", "user", "user");
            if (!$con) {
                die('No podemos conectar a la base de datos:' . mysqli_error());
            }
            $db_selected = mysqli_select_db($con, "practica");
            if (!$db_selected) {
                die("No puedo uasr la base de datos:" . mysqli_error($con));
                mysqli_close($con);
            } else {
                //sanear entrada, injeccion sql
                $name1 = mysqli_real_escape_string($con, $_POST['name']);
                $pwd1 = mysqli_real_escape_string($con, $_POST['pwd']);
                //ver escape de cadena
                echo "clave saneada:" . $pwd1 . "<br />";

                //creamos consulta
                $query = "SELECT * FROM user WHERE name='" . $name1 . "' AND pwd='" . $pwd1 . "'";
                $res = mysqli_query($con, $query);

                echo"<table border='1'>";
                echo"<tr><th>Name</th><th>Email</th></tr>";

                while ($fila = mysqli_fetch_array($res)) {
                    echo "<tr>";
                    echo "<td>" . $fila['name'] . "</td>";
                    echo "<td>" . $fila['pwd'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        } else {
            ?>
            <form name="e1" method="post">
                Nombre: <input type="text" name="name" value="">
                <br /><br />
                Contraseña: <input type="password" name="pwd" value="">
                <br /><br />
                <input type="submit" name="enviar" value="Enviar">
            </form>
            <?php
        }
        ?>
    </body>
</html>
