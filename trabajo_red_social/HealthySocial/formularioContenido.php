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
                        if (num === 0) {
                            document.getElementById('c' + (num + 2)).setAttribute("style", "display: none");
                            document.getElementById('c' + (num + 1)).setAttribute("style", "display: none");
                            document.getElementById('c' + (num)).removeAttribute("style");
                        } else if (num === 1) {
                            document.getElementById('c' + (num - 1)).setAttribute("style", "display: none");
                            document.getElementById('c' + (num)).removeAttribute("style");
                            document.getElementById('c' + (num + 1)).setAttribute("style", "display: none");
                        } else if (num === 2) {
                            document.getElementById('c' + (num - 2)).setAttribute("style", "display: none");
                            document.getElementById('c' + (num - 1)).setAttribute("style", "display: none");
                            document.getElementById('c' + (num)).removeAttribute("style");
                        }

                    }
                </script>

        </head>
        <body>

            <?PHP include_once './header.php'; ?>

            <div class="contendioPrincipal">

                <?PHP include_once './menuPrincipal.php'; ?>

                <section class="sectionPublicaciones">

                    <div class="container">
                        <h2>Publicaciones</h2>
                        <form method="POST" action="#">

                            <div class="row">
                                <div class="col-25">
                                    <label for="categoria">Categoria</label>
                                </div>
                                <div class="col-75">
                                    <select id="categoria" name="categoria" onchange="mostrar(this.selectedIndex)" required>
                                        <option value="alimentacion">Alimentaci&oacute;n</option>
                                        <option value="deportes">Deportes</option>
                                        <option value="suplemento">Suplemento</option>
                                    </select>
                                </div>
                            </div>
                   
                            <div class="row">
                                <div class="col-25">
                                    <label for="tipo">Tipo</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="tipo" name="tipo" required autofocus placeholder="Introduzca tipo..." />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-25">
                                    <label for="duracion">Duraci&oacute;n</label>
                                </div>
                                <div class="col-75">
                                    <input type="time" id="duracion" name="duracion" required placeholder="Introduzca duración..." />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-25">
                                    <label for="descripcion">Descripci&oacute;n</label>
                                </div>
                                <div class="col-75">
                                    <textarea id="descripcion" name="descripcion" placeholder="Introduce descripción..." style="height:100px"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-25">
                                    <label for="foto">Foto</label>
                                </div>
                                <div class="col-75">
                                    <input type="url" id="foto" name="foto" placeholder="Introduzca url..." />
                                </div>
                            </div>


                            <div id="c0">
                                <div class="row">
                                    <div class="col-25">
                                        <label for="dieta">Dieta</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="radio" id="dieta" name="dietaEstudio" value="dieta" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-25">
                                        <label for="dieta">Estudio Cient&iacute;fico</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="radio" id="estudiocientifico" name="dietaEstudio" value="cientifico" />
                                    </div>
                                </div>

                                <div class="row">
                                    <input type="submit" name="publicar" value="Publicar"/>
                                </div>
                            </div>
                    
                   
                        <div id="c1" style="display:none">
                            <div class="row">
                                <div class="col-25">
                                    <label for="nivel">Nivel</label>
                                </div>
                                <div class="col-75">
                                    <select id="categoria" name="nivel" required>
                                        <option value="bajo" selected>Nivel bajo</option>
                                        <option value="medio">Nivel medio</option>
                                        <option value="alto">Nivel Alto</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-25">
                                    <label for="localidad">Localidad</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="localidad" name="localidad" />
                                </div>
                            </div>

                            <div class="row">
                                <input type="submit" name="publicar" value="Publicar"/>
                            </div>
                        </div>
                    

                        <div id="c2" style="display:none">
                            <div class="row">
                                <div class="col-25">
                                    <label for="dosis">Dosis</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="dosis" name="dosis" />
                                </div>
                            </div>

                            <div class="row">
                                <input type="submit" name="publicar" value="Publicar"/>
                            </div>
                        </div>
                        </form>
                    </div>

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
