<?php
include 'funciones\conexion.php';
error_reporting(0);


if (isset($_POST['busquedaEnvio']) && filter_has_var(INPUT_POST, 'busquedaEnvio')) {

    $errores = "";
    if (isset($_POST['busquedaPalabra']) && $_POST['busquedaPalabra'] != "" && filter_has_var(INPUT_POST, 'busquedaPalabra')) {
        $palabraArticulo = filter_input(INPUT_POST, 'busquedaPalabra', FILTER_SANITIZE_STRING);
        
        
        $query_busquedaPalabra = "SELECT nom_articulo, nom_usuario, universidad FROM articulos WHERE descripcion_articulo LIKE '%$palabraArticulo%'";
        
        $resultado_busquedaPalabra = mysqli_query($conexion, $query_busquedaPalabra);
        

        if (mysqli_num_rows($resultado_busquedaPalabra)) {
            while ($row = mysqli_fetch_array($resultado_busquedaPalabra)) {//si se obtienen coincidencias
                ?>
                <ul>
                    <li><?php echo $row['nom_articulo'] . ' ' . $row['nom_usuario'] . ' ' . $row['universidad'] ?></li>

                </ul>
                <?php
            }
        } else {
            echo'<p>No se encontraron art&iacute;culos que correspondan con su criterio de b&uacute;squeda</p>';
        }

    }
    
    if (isset($_POST['busquedaUniversidad']) && $_POST['busquedaUniversidad'] != "" && filter_has_var(INPUT_POST, 'busquedaUniversidad')) {
        $busquedaUniversidad = filter_input(INPUT_POST, 'busquedaUniversidad', FILTER_SANITIZE_STRING);

        $query_busquedaUniversidad = "SELECT nom_articulo, nom_usuario FROM articulos WHERE universidad = '$busquedaUniversidad'";
        
        $resultado_busquedaUniversidad = mysqli_query($conexion, $query_busquedaUniversidad);
        
      
        if(mysqli_num_rows($resultado_busquedaUniversidad) > 0){

            while ($row = mysqli_fetch_array($resultado_busquedaUniversidad)) {
                ?>
              <ul>
                    <li><?php echo $row['nom_articulo'] . ' ' . $row['nom_usuario'] ?></li>

                </ul>
                <?php  
            }
        }else{
            echo '<p>Error.No se encontraron art&iacute;culos que correspondan con su criterio de b&uacute;squeda</p>';
        }
    }


    if ($_POST['busquedaPalabra']=="" && $_POST['busquedaUniversidad']=="") {
        $errores .= '<p>Error. Debe usar alguno de los dos buscadores para visualizar art&iacute;culos</p>';
    }

    if (strlen($errores) > 0) {
        echo '<h1>Se han producido los siguientes errores:</h1>';
        echo $errores;
    }
}
mysqli_close($conexion);
?>

