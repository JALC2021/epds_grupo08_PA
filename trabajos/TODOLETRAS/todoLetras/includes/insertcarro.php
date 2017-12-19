<div class="insertar-carro">
    <?php
    include("conexion.php");

    $tabla = "libros";
    $tabla2 = "carro";
    $tabla3 = "ventas";

    if (isset($_SESSION['user'])) {
        $usuario = $_SESSION['user'];
        //seleccionar los libros que hay en el carro
        $consulta = "SELECT * FROM $tabla2 WHERE usuario='$usuario';";
        $comprobar = mysql_query($consulta, $conexion);
        if (!$comprobar) {
            echo "<p class='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br/>Disculpen las molestias.</p>";
        }
        //sacar el isbn de los libros que tiene el carro para saber cual actualizar
        else {
            while ($fila = mysql_fetch_array($comprobar)) {
                $isbn = $fila[6];
                //selecciono los libros que tienen ese isbn
                $consulta = "SELECT * FROM $tabla WHERE isbn='$isbn';";
                $ventas = mysql_query($consulta, $conexion);
                if (!$ventas) {
                    echo "<p class='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br/>Disculpen las molestias.</p>";
                } else {
                    while ($fila = mysql_fetch_array($ventas)) {
                        //sumo mas 1 al campo ventas
                        $num = $fila[9] + 1;
                        $consulta = "UPDATE $tabla SET ventas=$num WHERE isbn='$isbn';";
                        $update = mysql_query($consulta, $conexion);
                        if (!$update) {
                            echo "<p class='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br/>Disculpen las molestias.</p>";
                        } else {
                            //insertamos la fecha de la compra en la tabla ventas
                            $mes = date("m");
                            $dia = date("d");
                            $anio = date("Y");
                            $consulta = "INSERT INTO $tabla3 VALUES (0,'$fila[1]','$fila[2]','$fila[3]','$fila[4]',$fila[5],'$fila[6]','$fila[7]',$fila[8],$dia,$mes,$anio,'$usuario');";
                            $insert = mysql_query($consulta, $conexion);
                        }
                    }
                }
            }
            //una vez actualizado libro, borro la tabla cesta del perteneciente usuario
            $consulta = "DELETE FROM $tabla2 WHERE usuario='$usuario';";
            $borrar = mysql_query($consulta, $conexion);
            if (!$borrar) {
                echo "<p class='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br/>Disculpen las molestias.</p>";
            }
            //Si todo ha salido bien...
            if (isset($insert) && $borrar) {
                if (!$insert) {
                    echo "<p class='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br/>Disculpen las molestias.</p>";
                } else {
                    echo "<p class='center'><strong>Su pedido se ha tramitado correctamente, puede seguir viendo mas libros en nuestro cat&aacute;logo.</strong></p>";
                    echo "<p class='center'><a href='libros.php'>Ver mas libros</a></p>";
                }
            }
        }
    } else {
        echo "<p class='center'><strong>Su sesi&oacute;n ha caducado. Vuelva a iniciar sesi&oacute;n.</strong></p>";
    }
    ?>
</div>
