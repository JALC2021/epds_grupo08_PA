<?php
session_start();
require 'Bbdd.php';
?>
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
        $nombre_usuario = $_POST['usuario_perfil'];
        $result = consultar_usuario($nombre_usuario);
        $row = mysqli_fetch_array($result);
        if ($row['imagen'] == "") {
            ?>
            <img class="imagenes" src="img/perfil_global.png"  width="100" height="100">
            <?php
        } else {
            ?>
            <img class="imagenes" src="img/<?php echo $row['imagen']; ?>"  width="100" height="100">
            <?php
        }
        ?>
        <table
            <tr>
                <td>Nombre </td>
                <td><?php echo $row['nombre']; ?></td>
            </tr>
            <tr>
                <td>Primer Apellido </td>
                <td><?php echo $row['apellido1']; ?></td>
            </tr>
            <tr>
                <td>Segundo Apellido </td>
                <td><?php echo $row['apellido2']; ?></td>
            </tr>
            <tr>
                <td>Email </td>
                <td><?php echo $row['email']; ?></td>
            </tr>
            <tr>
                <td>Nombre de Usuario </td>
                <td><?php echo $row['nombre_usuario']; ?></td>
            </tr>
            <tr>
                <td>Telefono </td>
                <td><?php echo $row['telefono']; ?></td>
            </tr>
        </table>
    </body>
</html>
