<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <?php
    session_start();
    ?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
    <head>
        <title>TodoLetras - Busqueda</title>
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
            <div class="busqueda">   
                <div class="padding-center">
                    <?php
                    include('includes/conexion.php');

                    $tabla = "libros";
                    $consulta = "SELECT * FROM $tabla;";
                    $resultado = mysql_query($consulta, $conexion);
                    if (!$resultado) {
                        echo "<p class='center'><strong>ERROR:</strong> Imposible acceder a la base de datos.</p>";
                    } else {
                        if ($_GET['seleccion'] == 0) {
                            $sql = "SELECT * FROM $tabla WHERE "
                                    . "titulo LIKE '%" . $_GET['buscar'] . "%' or "
                                    . "autor LIKE '%" . $_GET['buscar'] . "%' or "
                                    . "editorial LIKE '%" . $_GET['buscar'] . "%' or "
                                    . "anoedicion LIKE '%" . $_GET['buscar'] . "%' or "
                                    . "isbn LIKE '%" . $_GET['buscar'] . "%' ORDER BY titulo ASC;";
                            include('./includes/mostrarresultadobusqueda.php');
                        } elseif ($_GET['seleccion'] == 1) {
                            $sql = "SELECT * FROM $tabla WHERE titulo LIKE '%" . $_GET['buscar'] . "%' ORDER BY titulo ASC;";
                            include('./includes/mostrarresultadobusqueda.php');
                        } elseif ($_GET['seleccion'] == 2) {
                            $sql = "SELECT * FROM $tabla WHERE autor LIKE '%" . $_GET['buscar'] . "%' ORDER BY titulo ASC;";
                            include('./includes/mostrarresultadobusqueda.php');
                        } elseif ($_GET['seleccion'] == 3) {
                            $sql = "SELECT * FROM $tabla WHERE editorial LIKE '%" . $_GET['buscar'] . "%' ORDER BY titulo ASC;";
                            include('./includes/mostrarresultadobusqueda.php');
                        } elseif ($_GET['seleccion'] == 4) {
                            $sql = "SELECT * FROM $tabla WHERE anoedicion LIKE '%" . $_GET['buscar'] . "%' ORDER BY titulo ASC;";
                            include('./includes/mostrarresultadobusqueda.php');
                        } elseif ($_GET['seleccion'] == 5) {
                            $sql = "SELECT * FROM $tabla WHERE isbn LIKE '%" . $_GET['buscar'] . "%' ORDER BY titulo ASC;";
                            include('./includes/mostrarresultadobusqueda.php');
                        } else {
                            echo "<p class='center'><strong>ERROR</strong> en la b&uacute;squeda.</p>";
                        }
                    }
                    ?>
                </div>
            </div>
            <?php
            include('./includes/novedades.php');
            include('./includes/aside.php');
            include('./includes/footer.php');
            ?>   
        </div>
    </body>
</html>