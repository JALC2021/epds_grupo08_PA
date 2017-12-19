<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <?php
    session_start();
    ?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
    <head>
        <title>TodoLetras - Comunidad</title>   
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript">
            <!--
            $(document).ready(function() {
                $(".noticia").hide();
                $("h4").click(function() {
                    $(this).next().toggle();
                    
                });
            });
//-->
        </script>
        <?php
        include('./includes/cabecera.php');
        ?>
    </head>
    <body>
        <div class="container">
            <?php
            include('./includes/header.php');
            include('./includes/nav.php');
            ?>
            <div class="noticias">
                <?php
                include("includes/conexion.php");

                $tabla = "noticias";

                $sql = "SELECT * FROM $tabla;";

                $resultado = mysql_query($sql, $conexion);
                if (!$resultado) {
                    echo "<p>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br/>Disculpen las molestias.</p>";
                } else {
                    $numero_registros = mysql_numrows($resultado);
                    if ($numero_registros == 0) {
                        echo "<h2>NOTICIAS</h2>";
                        echo "<p>Sin ning&uacute;na todav&iacute;a.</p>";
                    } else {
                        echo "<h2>NOTICIAS</h2>";
                        while ($fila = mysql_fetch_array($resultado)) {
                            $idnot = $fila['idnot'];
                            $titulo = $fila['titulo'];
                            $cuerpo = $fila['cuerpo'];
                            $fechahora = $fila['fechahora'];
                            if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'admin') {
                                echo "<img src='imagenes/flecha.png' class='flecha'/><h4>$titulo</h4><div class='noticia'>$cuerpo<form action='borrarnoticia.php' method='post'><input type='hidden' name='idnot' value='$idnot'/><input type='image' value='a' src='imagenes/x.gif' height='20px' width='20px' title='Eliminar noticia'/></form></div>";
                            } else {
                                echo "<img src='imagenes/flecha.png' class='flecha'/><h4>$titulo</h4><div class='noticia'>$cuerpo</div>";
                            }
                        }
                    }
                }
                mysql_close($conexion);
                ?>
            </div>            
            <?php
            include('./includes/novedades.php');
            include('./includes/aside.php');
            include('./includes/footer.php');
            ?>
        </div>
    </body>
</html>