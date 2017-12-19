<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
require 'Bbdd.php';

if (isset($_POST['aceptar_solicitud'])) {
    if (isset($_SESSION['id_usuario_origen'])) {
        
    }
}

if (isset($_POST['rechazar_solicitud'])) {
    
}
?>
<html>
    <head>
        <link rel="stylesheet" href="style.css" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Work2Community</title>
    </head>
    <body>

        <header>           
            <h1 class="logo">Work<em>2</em>Community</h1>   
            <nav>
                <ul>
                    <li><a href="PagPrincipal.php">Inicio</a></li>
                    <li><a href="grupos.php">Grupos</a></li>
                    <li><a href="#">Calendario</a></li>
                </ul>
            </nav>
        </header>
        <nav>
            <?php
            if (isset($_SESSION['usuario'])) {
                echo '<a href="perfil_usuario.php">Mi Perfil</a>';      /* esto no lo entiendo pa que lo quereis */
            }
            ?>
        </nav>

        <section id="section_perfilusuario">
            <article id="imagen_perfil">
                <label>Imagen Perfil</label><img alt="Imagen Perfil"/>
            </article>
            <article id="article_perfil_usuario">
                <table border="1">
                    <?php
                    $result = consultar_usuario($_SESSION['usuario']);
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <?php if ($row['imagen'] == "") { ?>
                            <tr>
                                <td><img src="img/perfil_global.png" width="100" height="100"</td>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <td><img src="img/<?php $row['imagen']; ?>"</td>
                            </tr>
                        <?php } ?>
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
                    <?php } ?>
                </table>
                <?php
                echo '<br>';
                if (!isset($_SESSION['id_usuario'])) {
                    
                } else {
                    $id_usuario_destino = $_SESSION['id_usuario'];
                    $result2 = consultar_solicitud($id_usuario_destino);
                    if (!$result2) {
                        
                    } else {
                        $row2 = mysqli_fetch_array($result2);
                        $id_grupo = $row2['id_grupo'];
                        echo '<br>El usuario ' . $row2['id_usuario_origen'] . ' quiere unirse a su grupo ' . $id_grupo;
                        ?>
                        <form action="#" method="post">
                            <button type="submit" name="aceptar_solicitud">Aceptar Solicitud</button>
                            <button type="submit" name="rechazar_solicitud">Rechazar Solicitud</button>
                        </form>
                        <?php
                    }
                }
                ?>
            </article>
        </section>
        <footer>
            <p>Realizado por:</p>
            <a class="enlace_personal" href="#">Antonio Flores Romero - </a> <!--podemos poner nuestro twiter o nuestra pagina de la upo-->
            <a class="enlace_personal" href="#">Jose Antonio Resurrecion - </a>
            <a class="enlace_personal" href="#">Juan Antonio López Cano</a>
        </footer>
    </body>
</html>
