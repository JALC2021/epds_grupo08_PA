<?php
include 'consultasSql.php';
include 'seguridad.php';
$_SESSION['currentPage'] = 'index';
include 'cabecera.php';
include 'navegador.php';
?>
<section id="content" class="inicio">
    <div class="articulos">      
        <h3>NOTICIAS JUEGOS</h3>
        <?php
        $result = consultaSelect("SELECT noticiajuego.id,titulo,texto,fecha,usuario_id,user FROM `noticiajuego`, usuarios WHERE usuarios.id LIKE usuario_id ORDER BY fecha DESC LIMIT 2 ");
        while ($row = mysql_fetch_array($result)) {
            ?>
            <div class="articulo">
                <?php
                echo '<h3 class="titulo"><strong><a href="noticiasjuegos.php?id=' . $row['id'] . '">' . $row['titulo'] . '</a></strong><span class="etiq"></span></h2>';
                echo '<p class="texto">' . substr($row['texto'], 0, 100) . '<br/><br/><a href="noticiasjuegos.php?id=' . $row['id'] . '" class="more"> Leer más...</a></p>';
                echo '<p class="autor">Author: ' . $row['user'] . '</p>';
                echo '<p class="fecha">Date: ' . $row['fecha'] . '</p>';
                ?>
            </div>
            <?php
        }
        ?>
    </div>
    <br/>
    <div class="articulos">
        <h3>NOTICIAS CONSOLAS</h3>
        <?php
        $result = consultaSelect("SELECT noticiaconsola.id,usuario_id,titulo,texto,fecha,user FROM `noticiaconsola`, usuarios WHERE usuarios.id LIKE usuario_id ORDER BY fecha DESC LIMIT 2 ");
        while ($row = mysql_fetch_array($result)) {
//            $resultUsuario = consultaSelect('SELECT user FROM usuarios where id like ' . $row['usuario_id'] . ' LIMIT 1;');
//            $rowUsuario = mysql_fetch_array($resultUsuario);
            ?>
            <div class="articulo">
                <?php
                echo '<h3 class="titulo"><strong><a href="noticiasconsolas.php?id=' . $row['id'] . '">' . $row['titulo'] . '</a></strong><span class="etiq"></span></h2>';
                echo '<p class="texto">' . substr($row['texto'], 0, 100) . '<br/><br/><a href="noticiasconsolas.php?id=' . $row['id'] . '" class="more"> Leer más...</a></p>';
                echo '<p class="autor">Author: ' . $row['user'] . '</p>';
                echo '<p class="fecha">Date: ' . $row['fecha'] . '</p>';
                ?>
            </div>
            <?php
        }
        ?>
    </div>
</section>
<?php
include 'pie.php';
?>