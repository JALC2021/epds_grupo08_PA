<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0
    Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-
    strict.dtd">
    <?PHP
    session_start();

    require_once './functions.php';


    if (isset($_SESSION['estado'])) {
        if (isset($_POST['alimentacion']) || isset($_POST['deportes']) || isset($_POST['suplemento'])) {
            $insertar = true;
            if (isset($_POST['alimentacion'])) {
                if (!isset($_POST['dietaEstudio'])) {
                    ?>
                <script type="text/javascript">
                    alert("Debe seleccionar si la dieta es un estudio Científico o una dieta");
                </script>
                <?PHP
                $insertar = false;
            }
        } else if (isset($_POST['deportes'])) {

            if (!isset($_POST['nivel'])) {
                ?>
                <script type="text/javascript">
                    alert("Debe seleccionar un nivel");
                </script>
                <?PHP
                $insertar = false;
            }
            if ($_POST['localidad'] == "") {
                ?>
                <script type="text/javascript">
                    alert("Debe insertar una localidad");
                </script>
                <?PHP
                $insertar = false;
            }
        } else if (isset($_POST['suplemento'])) {
            if ($_POST['dosis'] == "") {
                ?>
                <script type="text/javascript">
                    alert("Debe insertar una dosis");
                </script>
                <?PHP
                $insertar = false;
            }
        }

        if ($insertar && preg_match("/^[0-2][0-9]:[0-5][0-9]$/", $_POST['duracion'])) {
            $con = connectDB();

            if (!$con) {
                die("Conexión fallida");
            }

            $db_selected = mysqli_select_db($con, "healthysocial");

            if (!$db_selected) {
                die("Conexión a basde de datos fallida");
            }

            //saneamos la entrada a la bbdd
            $tipo = mysqli_real_escape_string($con, $_POST['tipo']);
            $duracion = mysqli_real_escape_string($con, $_POST['duracion']);
            $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);
            $foto = filter_var($_POST['foto'], FILTER_SANITIZE_URL);

            $user = $_SESSION['user'];

            $result1 = mysqli_query($con, "SELECT `id_usuario` FROM `usuario` WHERE `usuario` LIKE '" . $user . "';");

            if (!$result1) {
                die("Error al ejecutar la consulta: " . mysqli_error($con));
            }

            if (mysqli_num_rows($result1) == 1) {

                $row = mysqli_fetch_array($result1);

                $result2 = mysqli_query($con, "INSERT INTO `contenido` (`id_contenido`, `id_usuario`, `duracion`, `tipo`) VALUES (NULL, '" . $row['id_usuario'] . "', '" . $duracion . "', '" . $tipo . "');");
                if (!$result2) {
                    die("Error al ejecutar la consulta: " . mysqli_error($con));
                }

                $result3 = mysqli_query($con, "Select `id_contenido` from `contenido` order by `id_contenido` desc limit 1");

                if (!$result3) {
                    die("Error al ejecutar la consulta: " . mysqli_error($con));
                }
                $row2 = (mysqli_fetch_array($result3));

                if ($_POST['foto'] != "") {
                    $result = mysqli_query($con, "INSERT INTO `foto` (`id_foto`, `id_usuario`, `id_contenido`, `url`) VALUES (NULL, '" . $row['id_usuario'] . "', '" . $row2['id_contenido'] . "', '" . $foto . "');");
                    if (!$result) {
                        die("Error al ejecutar la consulta: " . mysqli_error($con));
                    }
                }
                if (isset($_POST['alimentacion'])) {
                    $result = mysqli_query($con, "INSERT INTO `alimentacion` (`id_contenido`, `dieta_estudio`) VALUES ('" . $row2['id_contenido'] . "', '" . $_POST['dietaEstudio'] . "');");
                    if (!$result) {
                        die("Error al ejecutar la consulta: " . mysqli_error($con));
                    }
                    ?>
                    <script type="text/javascript">
                        alert("El contenido de alimentación se ha publicado correctamente");
                    </script>
                    <?PHP
                    disconnectDB($con);
                } else if (isset($_POST['deportes'])) {
                    $nivel = mysqli_real_escape_string($con, $_POST['nivel']);
                    $localidad = mysqli_real_escape_string($con, $_POST['localidad']);

                    $result = mysqli_query($con, "INSERT INTO `deportes` (`id_contenido`, `nivel`, `localizacion`) VALUES ('" . $row2['id_contenido'] . "', '" . $nivel . "', '" . $localidad . "');");
                    if (!$result) {
                        die("Error al ejecutar la consulta: " . mysqli_error($con));
                    }
                    ?>
                    <script type="text/javascript">
                        alert("El contenido de deportes se ha publicado correctamente");
                    </script>
                    <?PHP
                    disconnectDB($con);
                } else if (isset($_POST['suplemento'])) {
                    if ($_POST['dosis'] > 0) {
                        $dosis = mysqli_real_escape_string($con, $_POST['dosis']);
                        $result = mysqli_query($con, "INSERT INTO `suplemento` (`id_contenido`, `dosis`) VALUES ('" . $row2['id_contenido'] . "', '" . $_POST['dosis'] . "');");
                        if (!$result) {
                            die("Error al ejecutar la consulta: " . mysqli_error($con));
                        }
                        ?>
                        <script type="text/javascript">
                            alert("El contenido de suplemento se ha publicado correctamente");
                        </script>
                        <?PHP
                        disconnectDB($con);
                    } else {
                        ?>
                        <script type="text/javascript">
                            alert("La dosis debe ser mayor a 0");
                        </script>
                        <?PHP
                        disconnectDB($con);
                    }
                }
            }
        } else {

            if (!preg_match("/^[0-2][0-9]:[0-5][0-9]$/", $_POST['duracion'])) {
                ?>
                }
                <script type="text/javascript">
                    alert("Duración incorrecta.Ej:22:22");
                </script>
                <?PHP
            }
        }
    }
    ?>
    <!--
    To change this license header, choose License Headers in Project Properties.
    To change this template file, choose Tools | Templates
    and open the template in the editor.
    -->
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta charset="UTF-8">
                <title>SocialHealthy</title>
                <meta name="viewport" content="width=device-width, user-scalabe=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
                <link rel="stylesheet" type="text/css" href="css/style_index.css" />
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
                <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
                <script type="text/javascript">

                    function mostrar(num) {
                        if (num == 0) {
                            document.getElementById('c' + (num + 2)).setAttribute("style", "display: none");
                            document.getElementById('c' + (num + 1)).setAttribute("style", "display: none");
                            document.getElementById('c' + (num)).removeAttribute("style");
                        } else if (num == 1) {
                            document.getElementById('c' + (num - 1)).setAttribute("style", "display: none");
                            document.getElementById('c' + (num)).removeAttribute("style");
                            document.getElementById('c' + (num + 1)).setAttribute("style", "display: none");
                        } else if (num == 2) {
                            document.getElementById('c' + (num - 2)).setAttribute("style", "display: none");
                            document.getElementById('c' + (num - 1)).setAttribute("style", "display: none");
                            document.getElementById('c' + (num)).removeAttribute("style");
                        }

                    }
                </script>
                <style>

                    section{
                        background: #a2dece;
                        border: 1px solid #36752D;
                        margin-left: 1%;
                        margin-top: 1%;

                    }
                    table{
                        padding-left: 5%;
                        text-align: left;

                        font: normal 15px/150% Arial, Helvetica, sans-serif; 
                        overflow: hidden; 

                        -webkit-border-radius: 3px; 
                        -moz-border-radius: 3px; 
                        border-radius: 3px;
                    }
                    table td{
                        width: 200px;
                        height: 50px;
                        color: #242424;
                    }

                </style>
        </head>
        <body>

            <?PHP include_once './header.php'; ?>

            <div class="contendioPrincipal">

                <?PHP include_once './menuPrincipal.php'; ?>

                <section class="tabla">
                    <h2>Publicaciones</h2>
                    <form method="POST" action="#">
                        <table>

                            <tr><td>Categor&iacute;a</td><td><select name="contenido" id="select" onchange="mostrar(this.selectedIndex)" required>
                                        <option value="alimentacion" selected>Alimentaci&oacute;n</option>
                                        <option value="deportes">Deportes</option>
                                        <option value="suplemento">Suplemento</option>
                                    </select>
                                </td>
                            </tr>

                            <tr><td>Tipo</td><td><input type="text" name="tipo" required autofocus/></td></tr>

                            <tr><td>Duraci&oacute;n</td><td><input type="time" name="duracion" required /></td></tr>

                            <tr><td>Descripci&oacute;n</td><td><textarea name="descripcion" rows="4" cols="50" required>Introduce texto aqui...</textarea></td></tr>

                            <tr><td>Foto (url)</td><td><input type="text" name="foto" /></td></tr> 
                        </table>
                        <div id="c0">
                            <table>
                                <tr><td>Dieta</td><td><input type="radio" name="dietaEstudio" value="dieta" /></td></tr>
                                <tr><td>Estudio Cient&iacute;fico</td><td><input type="radio" name="dietaEstudio" value="cientifico" /></td></tr>

                                <tr><td><input type="submit" name="alimentacion" value="Publicar"/></td></tr>

                            </table>
                        </div>
                        <div id="c1" style="display:none">
                            <table>
                                <tr><td>Nivel</td><td><select name="nivel" >
                                            <option value="bajo" selected>Nivel bajo</option>
                                            <option value="medio">Nivel medio</option>
                                            <option value="alto">Nivel Alto</option>
                                        </select>
                                    </td></tr>
                                <tr><td>Localidad</td><td><input type="text" name="localidad"  /></td></tr>
                                <tr><td><input type="submit" name="deportes" value="Publicar"/></td></tr>
                            </table>
                        </div>
                        <div id="c2" style="display:none">
                            <table>
                                <tr><td>Dosis</td><td><input type="number" name="dosis"  /></td></tr>

                                <tr><td><input type="submit" name="suplemento" value="Publicar"/></td></tr>
                            </table>
                        </div>

                    </form>
                </section>
                <?php
                include_once './aside.php';
                ?>
            </div>

            <?php
            include_once './footer.php';
        } else {
            $_SESSION['url'] = "formularioContenido.php";
            header("location:login.php");
        }
        ?>
    </body>
</html>
