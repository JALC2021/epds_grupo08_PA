<div class="libros">
    <?php
    include("conexion.php");

    $tabla = "libros";

    $consultaPag = "SELECT * FROM $tabla";
    $rs_noticias = mysql_query($consultaPag, $conexion);
    $num_total_registros = mysql_num_rows($rs_noticias);

    $num_total_registros = mysql_num_rows($rs_noticias);
    //Limito la busqueda
    $TAMANO_PAGINA = 10;

//examino la página a mostrar y el inicio del registro a mostrar
    if (isset($_GET["pagina"]))
        $pagina = $_GET["pagina"];
    if (!isset($pagina)) {
        $inicio = 0;
        $pagina = 1;
    } else {
        $inicio = ($pagina - 1) * $TAMANO_PAGINA;
    }
//calculo el total de páginas
    $total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);


    $consulta = "SELECT * FROM $tabla ORDER BY titulo ASC LIMIT ".$inicio.",".$TAMANO_PAGINA;
    
    $resultado = mysql_query($consulta, $conexion);
    if (!$resultado) {
        echo "<p align='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br>Disculpen las molestias.</p>";
    } else {

        while ($fila = mysql_fetch_array($resultado)) {

            echo "<div class='libro'><a href='detallarlibro.php?id=$fila[0]'>"
            . "<img src='imagenes/$fila[7]' width='125' height='210' align='left'></a>"
            . "<figcaption><strong>Precio:</strong> $fila[8]</figcaption></div>";
            $_SESSION['isbn'] = $fila[6];
            
        }
        echo "<div style='clear: both; text-align: center;'>";
        if ($total_paginas > 1) {
            if ($pagina != 1)
                echo '<a href="?pagina=' . ($pagina - 1) . '"><img src="imagenes/izq.gif" border="0"></a>';
            for ($i = 1; $i <= $total_paginas; $i++) {
                if ($pagina == $i)
                //si muestro el índice de la página actual, no coloco enlace
                    echo $pagina;
                else
                //si el índice no corresponde con la página mostrada actualmente,
                //coloco el enlace para ir a esa página
                    echo '  <a href="?pagina=' . $i . '">' . $i . '</a>  ';
            }
            if ($pagina != $total_paginas)
                echo '<a href="?pagina=' . ($pagina + 1) . '"><img src="imagenes/der.gif" border="0"></a>';
        }
        echo "</div>";
    }
    ?>
</div>