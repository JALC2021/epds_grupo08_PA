<!DOCTYPE html>
<?PHP
session_start();

require_once '../functions.php';


if (isset($_SESSION['usuario'])) {
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
            if (!isset($_POST['localidad'])) {
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

        if ($insertar && preg_match("/^([a-zA-ZÁÉÍÓÚñáéíóú0-9]*[\s]*)+$/", $_POST['descripcion'])) {
            $con = connectDB();

            if (!$con) {
                die("Conexión fallida");
            }

            $db_selected = mysqli_select_db($con, "healthysocial");

            if (!$db_selected) {
                die("Conexión a basde de datos fallida");
            }

            //saneamos la entrada a la bbdd
            $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);
            $foto = filter_var($_POST['foto'], FILTER_SANITIZE_URL);

            $user = $_SESSION['user'];

            $result1 = mysqli_query($con, "SELECT `id_usuario` FROM `usuario` WHERE `usuario` LIKE '" . $user . "';");

            if (!$result1) {
                die("Error al ejecutar la consulta: " . mysqli_error($con));
            }

            if (mysqli_num_rows($result1) == 1) {

                $row = mysqli_fetch_array($result1);

                $result2 = mysqli_query($con, "INSERT INTO `contenido` (`id_contenido`, `id_usuario`, `descripcion`) VALUES (NULL, '" . $row['id_usuario'] . "','" . $descripcion . "');");
                if (!$result2) {
                    die("Error al ejecutar la consulta: " . mysqli_error($con));
                }

                $result3 = mysqli_query($con, "Select `id_contenido` from `contenido` order by `id_contenido` desc limit 1");

                if (!$result3) {
                    die("Error al ejecutar la consulta: " . mysqli_error($con));
                }
                $row2 = (mysqli_fetch_array($result3));


                $id_cont = $row2['id_contenido'];
                $_SESSION['cont'] = $id_cont;

                if ($_POST['foto'] != "") {
                    $result = mysqli_query($con, "INSERT INTO `foto` (`id_foto`, `id_usuario`, `id_contenido`, `url`) VALUES (NULL, '" . $row['id_usuario'] . "', '" . $row2['id_contenido'] . "', '" . $foto . "');");
                    if (!$result) {
                        die("Error al ejecutar la consulta: " . mysqli_error($con));
                    }
                }
                if (isset($_POST['alimentacion'])) {
                    //saneamos las entradas
                    $tipoAlimentacion = mysqli_real_escape_string($con, $_POST['tipoAlimentacion']);
                    $duracionAlimentacion = mysqli_real_escape_string($con, $_POST['duracionAlimentacion']);

                    $result = mysqli_query($con, "INSERT INTO `alimentacion` (`id_contenido`, `dieta_estudio`,`tipo`, `duracion`) VALUES ('" . $row2['id_contenido'] . "', '" . $_POST['dietaEstudio'] . "', '" . $tipoAlimentacion . "', '" . $duracionAlimentacion . "');");
                    if (!$result) {
                        die("Error al ejecutar la consulta: " . mysqli_error($con));
                    }
                    ?>
                    <script type="text/javascript">
                        alert("El contenido de alimentación se ha publicado correctamente");
                    </script>
                    <?PHP
                    disconnectDB($con);
                    header("location:personal.php");
                } else if (isset($_POST['deportes'])) {
                    //saneamos las entradas
                    $nivel = mysqli_real_escape_string($con, $_POST['nivel']);
                    $localidad = mysqli_real_escape_string($con, $_POST['localidad']);

                    $tipoDeporte = mysqli_real_escape_string($con, $_POST['tipoDeporte']);
                    $duracionDeporte = mysqli_real_escape_string($con, $_POST['duracionDeporte']);

                    $result = mysqli_query($con, "INSERT INTO `deportes` (`id_contenido`, `nivel`, `localizacion`,`tipo`, `duracion`) VALUES ('" . $row2['id_contenido'] . "', '" . $nivel . "', '" . $localidad . "', '" . $tipoDeporte . "', '" . $duracionDeporte . "');");
                    if (!$result) {
                        die("Error al ejecutar la consulta: " . mysqli_error($con));
                    }
                    ?>
                    <script type="text/javascript">
                        alert("El contenido de deportes se ha publicado correctamente");
                    </script>
                    <?PHP
                    disconnectDB($con);
                    header("location:personal.php");
                } else if (isset($_POST['suplemento'])) {
                    if ($_POST['dosis'] > 0) {
                        //saneamos las entradas
                        $dosis = mysqli_real_escape_string($con, $_POST['dosis']);
                        $tipoSuplemento = mysqli_real_escape_string($con, $_POST['tipoSuplemento']);
                        $duracionSuplemento = mysqli_real_escape_string($con, $_POST['duracionSuplemento']);
                        $result = mysqli_query($con, "INSERT INTO `suplemento` (`id_contenido`, `dosis`,`tipo`, `duracion`) VALUES ('" . $row2['id_contenido'] . "', '" . $_POST['dosis'] . "', '" . $tipoSuplemento . "', '" . $duracionSuplemento . "');");
                        if (!$result) {
                            die("Error al ejecutar la consulta: " . mysqli_error($con));
                        }
                        ?>
                        <script type="text/javascript">
                            alert("El contenido de suplemento se ha publicado correctamente");
                        </script>
                        <?PHP
                        disconnectDB($con);
                        header("location:personal.php");
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
                <script type="text/javascript">
                    alert("Duración incorrecta.Ej:22:22");
                </script>
                <?PHP
            }if (!preg_match("/^([a-zA-ZÁÉÍÓÚñáéíóú0-9]*[\s]*)+$/", $_POST['tipo'])) {
                ?>
                <script type="text/javascript">
                    alert("El tipo debe contener carácteres alfanuméricos");
                </script>
                <?PHP
            }if (!preg_match("/^([a-zA-ZÁÉÍÓÚñáéíóú0-9]*[\s]*)+$/", $_POST['descripcion'])) {
                ?>  
                <script type="text/javascript">
                    alert("La descripción debe contener carácteres alfanuméricos");
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
    <html>
        <head>
            <meta charset="UTF-8" />
            <title>SocialHealthy</title>
            <meta name="viewport" content="width=device-width, user-scalabe=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
            <link rel="stylesheet" type="text/css" href="../css/style_base.css" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
            <link rel="shortcut icon" type="image/x-icon" href="../images/logo2.png" />
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

                function comprobar(campo, expr) {
                    if (!expr.test(campo.value)) {
                        campo.value = "";

                        if (campo.getAttribute('id') === "duración") {
                            alert('El campo ' +
                                    campo.getAttribute('id') +
                                    ' tiene una duración incorrecta.Ej:22:22');
                        } else if (campo.getAttribute('id') === "tipo") {
                            alert('El campo ' +
                                    campo.getAttribute('id') +
                                    ' debe tener carácteres alfanuméricos');
                        } else if (campo.getAttribute('id') === "descripcion") {
                            alert('El campo ' +
                                    campo.getAttribute('id') +
                                    ' debe tener carácteres alfanuméricos');
                        }
                    }
                }

            </script>
            <script>
                function myFunction() {
                    alert("Por ejemplo futbol");
                }
            </script>

        </head>
        <body>

            <?PHP include_once '../header.php'; ?>
            <div class="contendioPrincipal">

                <?PHP include_once './menuPrincipal.php'; ?>

                <section class="sectionPublicaciones">

                    <div class="container">
                        <h2>Publicar</h2>
                        <form method="POST" action="#">

                            <div class="row">
                                <div class="col-25">
                                    <label>Categor&iacute;a <span id="requerido"> (*)</span></label>
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
                                    <label>Descripci&oacute;n <span id="requerido"> (*)</span></label>
                                </div>
                                <div class="col-75">
                                    <textarea id="descripcion" name="descripcion" onchange="comprobar(this, /^([a-zA-ZÁÉÍÓÚñáéíóú0-9]*[\s]*)+$/)" required placeholder="Introduce descripción..." style="height:100px"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-25">
                                    <label>Foto</label>
                                </div>
                                <div class="col-75">
                                    <input type="url" id="foto" name="foto" placeholder="Introduzca url..." /> 
                                </div>
                            </div>

                            <!--alimentacion-->
                            <div id="c0">

                                <div class="row">
                                    <div class="col-25">
                                        <label>Tipo <span id="requerido"> (*)</span></label>
                                    </div>
                                    <div class="col-75">
                                        <select id="tipoAlimentacion" name="tipoAlimentacion" >                                    
                                            <option value="omnivora">Omn&iacute;vora</option>
                                            <option value="vegetariana">Vegetariana</option>
                                            <option value="vegana">Vegana</option>
                                            <option value="crudista">Crudista</option>
                                            <option value="macrobiotica">Macrobi&oacute;tica</option>
                                            <option value="ovolactovegetariana">Ovolactovegetariana</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-25">
                                        <label>Duraci&oacute;n <span id="requerido"> (*)</span></label>
                                    </div>
                                    <div class="col-75">
                                        <select id="duracionAlimentacion" name="duracionAlimentacion" >                                    
                                            <option value="1semana">1 semana</option>
                                            <option value="2semanas">2 semanas</option>
                                            <option value="3semanas">3 semanas</option>
                                            <option value="4semanas">4 semanas</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-25">
                                        <label>Dieta <span id="requerido"> (*)</span></label>
                                    </div> 
                                    <div class="col-75">
                                        <input type="radio" id="dieta" name="dietaEstudio" value="dieta" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-25">
                                        <label>Estudio Cient&iacute;fico <span id="requerido"> (*)</span></label>
                                    </div>
                                    <div class="col-75">
                                        <input type="radio" id="estudiocientifico" name="dietaEstudio" value="cientifico" />
                                    </div>
                                </div>

                                <div class="row">
                                    <input type="submit" name="alimentacion" value="Publicar"/>
                                </div>
                            </div>

                            <!--deportes-->
                            <div id="c1" style="display:none">

                                <div class="row">
                                    <div class="col-25">
                                        <label>Tipo <span id="requerido"> (*)</span></label>
                                    </div>
                                    <div class="col-75">
                                        <select id="tipoDeporte" name="tipoDeporte" >
                                            <option value="futbol">F&uacute;tbol</option>
                                            <option value="tenis">Tenis</option>
                                            <option value="paddel">Paddel</option>
                                            <option value="surf">Surf</option>
                                            <option value="baloncesto">Baloncesto&oacute;tica</option>
                                            <option value="running">Runnig</option>
                                            <option value="natacion">Nataci&oacute;n</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-25">
                                        <label>Duraci&oacute;n <span id="requerido"> (*)</span></label>
                                    </div>
                                    <div class="col-75">
                                        <input type="time" id="duracion" name="duracionDeporte" onchange="comprobar(this, /^[0-2][0-9]:[0-5][0-9]$/)"  placeholder="Introduzca duración..." />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-25">
                                        <label>Nivel <span id="requerido"> (*)</span></label>
                                    </div>
                                    <div class="col-75">
                                        <select id="categoria" name="nivel" >
                                            <option value="bajo">Bajo</option>
                                            <option value="medio">Medio</option>
                                            <option value="alto">Alto</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-25">
                                        <label>Localidad <span id="requerido"> (*)</span></label>
                                    </div>
                                    <div class="col-75">
                                        <select id="localidad" name="localidad" >
                                            <option value='A Coruña' >A Coruña</option>
                                            <option value='&Aacute;lava'>Alava</option>
                                            <option value='Albacete' >Albacete</option>
                                            <option value='Alicante'>Alicante</option>
                                            <option value='Almería' >Almería</option>
                                            <option value='Asturias' >Asturias</option>
                                            <option value='ávila' >Ávila</option>
                                            <option value='Badajoz' >Badajoz</option>
                                            <option value='Barcelona'>Barcelona</option>
                                            <option value='Burgos' >Burgos</option>
                                            <option value='Cáceres' >Cáceres</option>
                                            <option value='Cádiz' >Cádiz</option>
                                            <option value='Cantabria' >Cantabria</option>
                                            <option value='Castellón' >Castellón</option>
                                            <option value='Ceuta' >Ceuta</option>
                                            <option value='Ciudad Real' >Ciudad Real</option>
                                            <option value='Córdoba' >Córdoba</option>
                                            <option value='Cuenca' >Cuenca</option>
                                            <option value='Gerona' >Gerona</option>
                                            <option value='Girona' >Girona</option>
                                            <option value='Las Palmas' >Las Palmas</option>
                                            <option value='Granada' >Granada</option>
                                            <option value='Guadalajara' >Guadalajara</option>
                                            <option value='Guipúzcoa' >Guipúzcoa</option>
                                            <option value='Huelva' >Huelva</option>
                                            <option value='Huesca' >Huesca</option>
                                            <option value='Jaén' >Jaén</option>
                                            <option value='La Rioja' >La Rioja</option>
                                            <option value='León' >León</option>
                                            <option value='Lleida' >Lleida</option>
                                            <option value='Lugo' >Lugo</option>
                                            <option value='Madrid' >Madrid</option>
                                            <option value='Malaga' >Málaga</option>
                                            <option value='Mallorca' >Mallorca</option>
                                            <option value='Melilla' >Melilla</option>
                                            <option value='Murcia' >Murcia</option>
                                            <option value='Navarra' >Navarra</option>
                                            <option value='Orense' >Orense</option>
                                            <option value='Palencia' >Palencia</option>
                                            <option value='Pontevedra'>Pontevedra</option>
                                            <option value='Salamanca'>Salamanca</option>
                                            <option value='Segovia' >Segovia</option>
                                            <option value='Sevilla' >Sevilla</option>
                                            <option value='Soria' >Soria</option>
                                            <option value='Tarragona' >Tarragona</option>
                                            <option value='Tenerife' >Tenerife</option>
                                            <option value='Teruel' >Teruel</option>
                                            <option value='Toledo' >Toledo</option>
                                            <option value='Valencia' >Valencia</option>
                                            <option value='Valladolid' >Valladolid</option>
                                            <option value='Vizcaya' >Vizcaya</option>
                                            <option value='Zamora' >Zamora</option>
                                            <option value='Zaragoza'>Zaragoza</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <input type="submit" name="deportes" value="Publicar"/>
                                </div>
                            </div>

                            <!--suplemento-->
                            <div id="c2" style="display:none">

                                <div class="row">
                                    <div class="col-25">
                                        <label>Tipo <span id="requerido"> (*)</span></label>
                                    </div>
                                    <div class="col-75">
                                        <select id="tipoSuplemento" name="tipoSuplemento" >
                                            <option value="alimentario">Alimentario</option>
                                            <option value="deportivo">Deportivo</option>                                          
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-25">
                                        <label>Duraci&oacute;n <span id="requerido"> (*)</span></label>
                                    </div>
                                    <div class="col-75">
                                        <select id="duracionSuplemento" name="duracionSuplemento" >                                    
                                            <option value="1semana">1 semana</option>
                                            <option value="2semanas">2 semanas</option>
                                            <option value="3semanas">3 semanas</option>
                                            <option value="4semanas">4 semanas</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-25">
                                        <label>D&oacute;sis</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" name="dosis" placeholder="En miligramos..."/>
                                    </div>
                                </div>

                                <div class="row">
                                    <input type="submit" name="suplemento" value="Publicar"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25" id="requerido">
                                    (*) Campo requerido
                                </div>

                            </div>
                        </form>
                    </div>

                </section>

                <?php
                include_once '../aside.php';
                ?>
            </div>

            <?php
            include_once '../footer.php';
        } else {
            $_SESSION['url'] = "usuario/formularioContenido.php";
            $_SESSION['tipo'] = 'usuario';
            header("location:../login.php");
        }
        ?>
    </body>
</html>
