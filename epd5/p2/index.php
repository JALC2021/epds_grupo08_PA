<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="estilo.css" />
        <title>EPD5-P2</title>
    </head>
    <body>
        <?php

        function getFotoURL($vector) {
            $categorias = "";
            for ($i = 0; $i < count($vector); $i++) {

                if ($i == count($vector) - 1) {
                    $foto = $vector[$i];
                } else if ($i == count($vector) - 2) {
                    $categorias .= $vector[$i];
                } else {
                    $categorias .= $vector[$i] . ",";
                }
            }
            copy("https://source.unsplash.com/featured/?" . urlencode($categorias), $foto);
        }

        function mostrarImagenes($vector) {
            $date = date("Y-m-d_H-i") . ".jpg";
            array_push($vector, $date);
            getFotoURL($vector);
            ?>
    <th colspan="2">
            <figure><img style="width: 40%" src=<?PHP echo $date ?>>
                <figcaption><?PHP
                    echo "Categor&iacute;as: ";
                    for ($i = 0; $i < count($vector) - 1; $i++) {
                        if ($i == count($vector) - 2) {
                            echo $vector[$i];
                        } else {
                            echo $vector[$i] . ", ";
                        }
                    }
                    echo "<br />Fecha: " . date("m-d-y g:i a")
                    ?></figcaption>
            </figure>
        </th>
        <?PHP
        $fw = fopen("fichero.txt", "a");
        for ($i = 0; $i < count($vector); $i++) {
            if ($i == count($vector) - 1) {
                fwrite($fw, "\t" . $vector[$i] . "\n");
            } else if ($i == count($vector) - 2) {
                fwrite($fw, $vector[$i]);
            } else {
                fwrite($fw, $vector[$i] . ",");
            }
        }
        fclose($fw);
    }

    function mostrarVariasImagenes($imagenes) {

        for ($j = 0; $j < count($imagenes); $j++) {
            $vector = explode(",", $imagenes[$j]);
            $date = date("Y-m-d_H-i") . "-" . chr($j+65) . ".jpg";
            array_push($vector, $date);
            getFotoURL($vector);
            ?>
            <td>
                <figure><img style="width: 100%" src=<?PHP echo $date ?>>
                    <figcaption><?PHP
                        echo "Categor&iacute;as: ";
                        for ($i = 0; $i < count($vector) - 1; $i++) {
                            if ($i == count($vector) - 2) {
                                echo $vector[$i];
                            } else {
                                echo $vector[$i] . ", ";
                            }
                        }
                        echo "<br />Fecha: " . date("m-d-y g:i a")
                        ?></figcaption>
                </figure>
            </td>
            <?PHP
            $fw = fopen("fichero.txt", "a");
            for ($i = 0; $i < count($vector); $i++) {
                if ($i == count($vector) - 1) {
                    fwrite($fw, "\t" . $vector[$i] . "\n");
                } else if ($i == count($vector) - 2) {
                    fwrite($fw, $vector[$i]);
                } else {
                    fwrite($fw, $vector[$i] . ",");
                }
            }
            fclose($fw);
        }
    }
    ?>
            <header><h1>EPD5-P2: Grupo8</h1></header>
    <table>
        <tr>
            <?PHP
            if (isset($_POST['EnvioCheck']) || isset($_POST['EnvioFichero'])) {
                $vector = array();
                if (isset($_POST['EnvioCheck'])) {

                    if (isset($_POST['nature'])) {
                        array_push($vector, 'nature');
                    }
                    if (isset($_POST['car'])) {
                        array_push($vector, 'car');
                    }
                    if (isset($_POST['girl'])) {
                        array_push($vector, 'girl');
                    }
                    if (isset($_POST['lake'])) {
                        array_push($vector, 'lake');
                    }
                    if (isset($_POST['mountain'])) {
                        array_push($vector, 'mountain');
                    }
                    if (isset($_POST['forest'])) {
                        array_push($vector, 'forest');
                    }
                    if (isset($_POST['dog'])) {
                        array_push($vector, 'dog');
                    }
                    if (isset($_POST['agent'])) {
                        array_push($vector, 'agent');
                    }
                    mostrarImagenes($vector);
                } else if (isset($_POST['EnvioFichero'])) {
                    $f = fopen($_FILES['fichero']['tmp_name'], "r");
                    $linea = fgets($f);

                    if (strlen($linea) < 201) {
                        if (strpos($linea, ";") === False) {
                            $vector = explode(",", $linea);
                            mostrarImagenes($vector);
                        } else {
                            $imagenes = explode(";", $linea);
                            mostrarVariasImagenes($imagenes);
                        }
                    } else {
                        echo "Ha superado el máximo de 200 carácteres en la línea del fichero";
                    }

                    fclose($f);
                }
            }
            ?>


        </tr>
        <tr>
            <td><strong>Elegir una/varias categorías:</strong>
                <form action="." method="POST">
                    <table>
                        <tr>
                            <td>Nature <input type="checkbox" name="nature"></td>
                            <td>Car <input type="checkbox" name="car"></td>
                        </tr>
                        <tr>  

                            <td>Girl <input type="checkbox" name="girl"></td>
                            <td>Lake <input type="checkbox" name="lake"></td>
                        </tr>
                        <tr>
                            <td>Mountain <input type="checkbox" name="mountain"></td>
                            <td>Forest <input type="checkbox" name="forest"></td>
                        </tr>
                        <tr>
                            <td>Dog <input type="checkbox" name="dog"></td>
                            <td>Agent <input type="checkbox" name="agent"></td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="EnvioCheck" value="OK"></td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="EnvioInicio" value="Inicio"></td>
                        </tr>

                    </table>
                </form>
            </td>
            <td><ol><strong>El archivo subido tiene que tener las siguientes car&aacute;cter&iacute;sticas:</strong><br />
                    <li>Tipo: Texto</li>
                    <li>Formato: Una sola línea</li>
                    <li>Longitud: Máximo 200 carácteres</li>
                    <li>Características: Separadas por comas</li>
                    <li>Número de imágenes: Separadas por punto y coma</li>
                </ol>
                <form action="." method="POST" enctype="multipart/form-data">
                    <input type="file" name="fichero" value="upload" ><br />
                    <input type="submit" name="EnvioFichero" value="OK">
                </form>
            </td>
        </tr>
    </table>
</body>
</html>
