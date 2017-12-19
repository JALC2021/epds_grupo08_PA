<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
require 'Bbdd.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Script-Type" content="text/javascript" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css" type="text/css"/>
        <title>Work2Community</title>
        <script>
            function mostrarResponder(id) {
                fila = document.getElementById(id);
                if (fila.style.display != "none") {
                    fila.style.display = "none"; //ocultar fila
                } else {
                    fila.style.display = ""; //mostrar fila
                }
            }
        </script>
        <?php
        $id = $_SESSION['id_usuario'];
        $result = consultar_mis_mensajes($id);
        ?>
    </head>
    <body>
        <header>           
            <h1 class="logo">Work<em>2</em>Community</h1> 
            <nav>
                <ul>
                    <li><a href="PagPrincipal.php">Inicio</a></li>
                    <li><a href="#">Grupos</a></li>
                    <li><a href="#">Calendario</a></li>
                </ul>
            </nav>
        </header>

        <section>
            <h1>Mis Mensajes</h1>
            <?php
            if (isset($_POST['enviar'])) {
                if (isset($_POST['id_usuario_origen']) && isset($_POST['mensaje']) && isset($_POST['id_pub']) && isset($_POST['id_usuario_destino']) && isset($_POST['nombre_usuario'])) {


                    $id_usuario_origen = $_POST['id_usuario_origen'];
                    $contenido = $_POST['mensaje'];
                    $id_pub = $_POST['id_pub'];
                    $id_usuario_destino = $_POST['id_usuario_destino'];
                    $nombre_usuario = $_POST['nombre_usuario'];
                    crear_mensaje($contenido, $id_usuario_origen, $id_usuario_destino, $id_pub, $nombre_usuario);
                    ?>
                    <h1>Mensaje Enviado!</h1>

                    <?php
                }
            }
            ?>

            <table border="1">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Titulo</th>
                        <th>Contenido</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        $id_pub = $row['id_pub'];
                        $titulo = consultar_titulo_publicacion($id_pub);
                        $titulo = mysqli_fetch_array($titulo);
                        echo '<tr>';
                        echo '<td>' . $row['nombre_usuario'] . '</td>';
                        echo '<td>' . $row['fecha'] . '</td>';
                        echo '<td>' . $titulo['titulo'] . '</td>';
                        echo '<td>' . $row['contenido'] . '</td>';
                        ?>
                    <td><button onclick="mostrarResponder('responder')">Responder</button></td>                    
                    </tr>                    
                    <tr id="responder" style="display:none">
                        <th colspan="5">
                            <form action="#" method="POST">
                                <textarea name="mensaje" rows="4" cols="20"></textarea>
                                <input type="hidden" value="<?php echo $_SESSION['id_usuario']; ?>" name="id_usuario_origen"/>
                                <input type="hidden" value="<?php echo $row['id_pub']; ?>" name="id_pub"/>
                                <input type="hidden" value="<?php echo $row['id_usuario_origen']; ?>" name="id_usuario_destino"/>
                                <input type="hidden" value="<?php echo $_SESSION['usuario']; ?>" name="nombre_usuario"/>
                                <input type="submit" value="Enviar" name="enviar" />
                            </form>
                        </th>
                    </tr>
                <?php }
                ?>
                </tbody>

            </table>



        </section>

        <aside>
            <ul>
                <li><a class="active" href="nueva_publicacion.php">Nueva Publicación</a></li>
                <li><a href="perfil_usuario.php">Mi Perfil</a></li>                   
                <li><a href="mis_mensajes.php">Mis Mensajes</a></li>
            </ul>
        </aside>

        <footer>
            <p>Realizado por:</p>
            <a class="enlace_personal" href="#">Antonio Flores Romero - </a> <!--podemos poner nuestro twiter o nuestra pagina de la upo-->
            <a class="enlace_personal" href="#">Jose Antonio Resurrecion - </a>
            <a class="enlace_personal" href="#">Juan Antonio López Cano</a>
        </footer>
    </body>
</html>

