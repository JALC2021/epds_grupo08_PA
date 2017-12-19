<div class="consultar-carro">
    <div class="padding-center">
        <?php
        include("conexion.php");

        $tabla = "libros";
        $tabla2 = "carro";

        if (isset($_SESSION['user'])) {
            $usuario = $_SESSION['user'];

            // si existe el $_POST
            if (isset($_POST['enviar'])) {
                $isbn = $_POST['isbn'];
                //si existe $_POST comprobar que ese libro no esta en el carro con ese usuario:
                $consulta = "SELECT * FROM $tabla2 where isbn='$isbn';";
                $comprobar = mysql_query($consulta, $conexion);
                //si no existe ese isbn, lo añade
                if (mysql_numrows($comprobar) == 0) {
                    $consulta = "SELECT * FROM $tabla where isbn='$isbn';";
                    $comprobar = mysql_query($consulta, $conexion);
                    if (!$comprobar) {
                        echo "<p align='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br>Disculpen las molestias.</p>";
                    } else {
                        while ($fila = mysql_fetch_array($comprobar)) {
                            $consulta = "INSERT INTO $tabla2 VALUES (0,'$fila[1]','$fila[2]','$fila[3]','$fila[4]','$fila[5]','$fila[6]','$fila[7]', $fila[8],'$usuario');";
                            $insert = mysql_query($consulta, $conexion);
                            if (!$insert) {
                                echo "<p align='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br>Disculpen las molestias.</p>";
                            } else {
                                echo "<p class='center'><strong>Su articulo se ha a&ntilde;adido correctamente</strong></p>";
                                echo "<p class='center'><a href='carro.php'>Ver carro</a></p>";
                                echo "<p class='center'><a href='libros.php'>Ver mas libros</a></p>";
                            }
                        }
                    }
                }
                //si existe ese isbn, comprueba que corresponda al usuario elegido
                else {
                    $consulta = "SELECT * FROM $tabla2 where isbn='$isbn' and usuario='$usuario';";
                    $comprobar = mysql_query($consulta, $conexion);
                    if (mysql_numrows($comprobar) == 0) {
                        $consulta = "SELECT * FROM $tabla where isbn='$isbn';";
                        $comprobar = mysql_query($consulta, $conexion);
                        if (!$comprobar) {
                            echo "<p align='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br>Disculpen las molestias.</p>";
                        } else {
                            while ($fila = mysql_fetch_array($comprobar)) {
                                $consulta = "INSERT INTO $tabla2 VALUES (0,'$fila[1]','$fila[2]','$fila[3]','$fila[4]','$fila[5]','$fila[6]','$fila[7]', $fila[8],'$usuario');";
                                $insert = mysql_query($consulta, $conexion);
                                if (!$insert) {
                                    echo "<p align='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br>Disculpen las molestias.</p>";
                                } else {
                                    echo "<p class='center'><strong>Su articulo se ha a&ntilde;adido correctamente</strong></p>";
                                    echo "<p class='center'><a href='carro.php'>Ver carro</a></p>";
                                    echo "<p class='center'><strong><a href='libros.php'>Ver mas libros</a></p>";
                                }
                            }
                        }
                    } else {
                        echo "<p class='center'><strong>Su articulo ya estaba a&ntilde;adido</strong></p>";
                        echo "<p class='center'><a href='carro.php'>Ver carro</a></p>";
                        echo "<p class='center'><a href='libros.php'>Ver mas libros</a></p>";
                    }
                }
            }

            //si no existe $_POST :
            else {
                $consulta = "SELECT * FROM $tabla2 where usuario='$usuario';";
                $carro = mysql_query($consulta, $conexion);
                if (!$carro) {
                    echo "<p align='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br>Disculpen las molestias.</p>";
                } else {
                    $total = 0;
                    if (mysql_numrows($carro) > 0) {
                        ?>
                        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                            <input name="cmd" type="hidden" value="_cart" /> 
                            <input name="upload" type="hidden" value="1" /> 
                            <input name="business" type="hidden" value="patricia_j_h-facilitator@hotmail.com" />
                            <input name="shopping_url" type="hidden" value="http://todoletras.comuv.com" />
                            <input name="currency_code" type="hidden" value="EUR" />

                            <input name="return" type="hidden" value="http://todoletras.comuv.com/aceptarcarro.php" />
                            <input name="notify_url" type="hidden" value="http://mipagina.com/paypal_ipn.php" />

                            <input name="rm" type="hidden" value="2" />
                            <?php
                            $i = 1;
                            while ($fila = mysql_fetch_array($carro)) {
                                echo "<img src='imagenes/$fila[7]' class='libro-explicito' ><br/><b>Titulo:</b> $fila[1] <br><br> <b>Autor:</b> $fila[2] <br><br> <b>Editorial:</b> $fila[3] <br><br> <b>Genero:</b> $fila[4] <br><br> <b>A&ntildeo edicion:</b> $fila[5] <br><br> <b>ISBN:</b> $fila[6]<br><br> <b>Precio:</b> $fila[8]<br/><br/>";
                                $precio = $fila[8];
                                $total = $total + ($precio);
                                ?>
                                <input name="item_number_<?php echo $i; ?>" type="hidden" value="<?php echo $fila['isbn'] ?>" />
                                <input name="item_name_<?php echo $i; ?>" type="hidden" value="<?php echo $fila['titulo'] ?>" /> 
                                <input name="amount_<?php echo $i; ?>" type="hidden" value="<?php echo $fila['precio'] ?>" /> 
                                <input name="quantity_<?php echo $i; ?>" type="hidden" value="1" />
                                <?php
                                $i++;
                            }
                            echo "<p><strong>TOTAL: $total euros</strong></p>";
                            ?>
                            <input type="submit" value="Pagar con PayPal" class="input-button" />
                        </form>
                        <?php
                        echo "<form action='borrarcarro.php' method='post'><input type='submit' name='comprar' value='Borrar carro' class='input-button' /></form>";
                    } else {
                        echo "<p class='center'><strong>No ha a&ntilde;adido ning&uacute;n articulo aun. Puede mirar en nuestro cat&aacute;logo todos los libros a su disposici&oacute;n.</strong></p>";
                        echo "<p class='center'><a href='libros.php'>Ver cat&aacute;logo de libros</a></p>";
                    }
                }
            }
        }

//si no existe el usuario
        else {
            echo "<p align='center'>No ha iniciado sesion para poder comprar<br><a href='login.php'>Iniciar Sesion</a></p>";
        }
        ?>
    </div>
</div>