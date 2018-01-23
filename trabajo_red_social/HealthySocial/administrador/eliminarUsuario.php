<?php
session_start();

require_once '../functions.php';
//si la sesión es de administrador
if (isset($_SESSION['administrador'])) {
    //seleccionamos la base de datos
    $con = connectDB();
    $db_selected = selectDB($con);

    //si eliminamos el usuario o el contenido
    if (isset($_POST['eliminarUsuario']) || isset($_POST['eliminarContenido'])) {
        //si eliminamos el usuario o el contenido
        if (isset($_POST['id_usuario_eliminar'])) {
            if (isset($_POST['eliminarUsuario'])) {
                $rowEliminar = mysqli_query($con, "delete from `usuario` where id_usuario= " . $_POST['id_usuario_eliminar'] . ";");
            } else if (isset($_POST['eliminarContenido'])) {
                $rowEliminar = mysqli_query($con, "delete from `contenido` where id_usuario= " . $_POST['id_usuario_eliminar'] . ";");
            }


            if (!$rowEliminar) {
                die("Error al ejecutar la consulta: " . mysqli_error($con));
            }

            if (mysqli_affected_rows($con) > 0) {

                if (isset($_POST['eliminarUsuario'])) {
                    ?>
                    <script type="text/javascript">
                        alert("Usuario eliminado correctamente");
                    </script>
                    <?PHP
                } else if (isset($_POST['eliminarContenido'])) {
                    ?>
                    <script type="text/javascript">
                        alert("Contenido eliminado correctamente");
                    </script>
                    <?PHP
                }
            }
        } else {
            echo "no ha seleccionado ningún usuario para eliminar";
        }
    }

    //Limito la busqueda
    $TAMANO_PAGINA = 5;

    //examino la página a mostrar y el inicio del registro a mostrar
    if (isset($_GET["pagina"])) {
        $pagina = $_GET["pagina"];
    } else {
        $pagina = False;
    }

    if (!$pagina) {
        $inicio = 0;
        $pagina = 1;
    } else {
        $inicio = ($pagina - 1) * $TAMANO_PAGINA;
    }

    //miro a ver el número total de campos que hay en la tabla con esa búsqueda
    $sql = "select * from usuario where tipo like 'usuario' order by usuario;";
    $rs = mysqli_query($con, $sql);
    $num_total_registros = mysqli_num_rows($rs);
    //calculo el total de páginas
    $total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);

    $sql = "select * from usuario where tipo like 'usuario' order by usuario limit " . $inicio . "," . $TAMANO_PAGINA . ";";


    $condInicial = isset($_POST['enviar']) && ($_POST['usuario'] != "" || $_POST['nombre'] != "" || $_POST['email'] != "" || $_POST['localidad'] != "" || $_POST['apellidos'] != "");
    if ($condInicial) {

    //si el campo no está vacío hacemos las comprobaciones y luego concatenamos los campos rellenos en una sql para solo hacer una sql select

        $sql = "select usuario,nombre,apellidos,email,localidad from usuario where tipo like 'usuario' and usuario <> '" . $_SESSION['user'] . "' ";

        $condUsuario = preg_match("/^[[:alnum:]]{3,15}$/", $_POST['usuario']);
        if ($_POST['usuario'] != "") {
            if ($condUsuario) {
                $sql .= "and usuario like '" . $_POST['usuario'] . "'";
            } else {
                ?>
                <script type="text/javascript">
                    alert("Usuario incorrecto. De 3 a 15 carácteres alfanuméricos");
                </script>
                <?PHP
            }
        }

        $condEmail = preg_match("/^[a-zA-z0-9]+@[a-z]+\.[a-z]+/", $_POST['email']);

        if ($_POST['email'] != "") {
            if ($condEmail) {
                $sql .= "and email like '" . $_POST['email'] . "'";
            } else {
                ?>
                <script type="text/javascript">
                    alert("No se ha introducido el email correctamente.Ej:ejemplo@ejemplo.com");
                </script>
                <?PHP
            }
        }

        $condApellidos = preg_match("/^([a-zA-ZÁÉÍÓÚñáéíóú]{1,15}[\s]*)+$/", $_POST['apellidos']);

        if ($_POST['apellidos'] != "") {
            if ($condApellidos) {
                $sql .= "and apellidos like '" . $_POST['apellidos'] . "'";
            } else {
                ?>
                <script type="text/javascript">
                    alert("No se ha introducido el apellido correctamente");
                </script>
                <?PHP
            }
        }

        $condNombre = preg_match("/^[A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]{2,15}$/", $_POST['nombre']);

        if ($_POST['nombre'] != "") {
            if ($condNombre) {
                $sql .= "and nombre like '" . $_POST['nombre'] . "';";
            } else {
                ?>
                <script type="text/javascript">
                    alert("No se ha introducido el nombre correctamente. La primera letra mayúscula y de 3 a 15 carácteres alfanuméricos");
                </script>
                <?PHP
            }
        }


        $condLocalidad = preg_match("/^([a-zA-ZÁÉÍÓÚñáéíóú]{1,15}[\s]*)+$/", $_POST['localidad']);

        if ($_POST['localidad'] != "") {

            if ($condLocalidad) {
                $sql .= " and localidad like '" . $_POST['localidad'] . "'";
            } else {
                ?>
                <script type="text/javascript">
                    alert("No se ha introducido la localidad correctamente");
                </script>
                <?PHP
            }
        }
    }
    ?>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-
        strict.dtd">
    <html>
        <head>
            <meta charset="UTF-8" />
            <title>SocialHealthy</title>
            <meta name="viewport" content="width=device-width, user-scalabe=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
            <link rel="stylesheet" type="text/css" href="../css/style_base.css" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
            <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
            <link rel="shortcut icon" type="image/x-icon" href="../images/logo2.png" />
            <script type="text/javascript">
//                comprobamos las expresiones regulares
                function comprobar(campo, expr) {
                    if (!expr.test(campo.value)) {
                        campo.value = "";

                        if (campo.getAttribute('id') == "nombre") {
                            alert('El campo ' +
                                    campo.getAttribute('id') +
                                    ' debe tener la primera letra mayúscula y de 3 a 15 carácteres alfabéticos');
                        } else if (campo.getAttribute('id') == "apellidos") {
                            alert('El campo ' +
                                    campo.getAttribute('id') +
                                    ' debe tener de 1 a 15 carácteres alfabéticos');
                        } else if (campo.getAttribute('id') == "usuario") {
                            alert('El campo ' +
                                    campo.getAttribute('id') +
                                    ' debe tener de 3 a 15 carácteres alfanuméricos');

                        } else if (campo.getAttribute('id') == "localidad") {
                            alert('El campo ' +
                                    campo.getAttribute('id') +
                                    ' debe tener de 1 a 15 carácteres alfabéticos');
                        } else if (campo.getAttribute('id') == "email") {
                            alert('El campo ' +
                                    campo.getAttribute('id') +
                                    ' no se ha introducido correctamente.Ej:ejemplo@ejemplo.com');
                        }
                    }
                }


            </script>
        </head>
        <body>

            <?PHP include_once '../header.php'; ?>

            <div class="contendioPrincipal">

                <?PHP include_once './menuPrincipalAdministrador.php'; ?>

                <section class="sectionModificar">
                    <h2>Eliminar usuarios/contenido</h2>

                    <?PHP
                    $rowUsuario = mysqli_query($con, $sql);
                    disconnectDB($con);
                    //si no hay coincidencias con el usuario
                    if (mysqli_num_rows($rowUsuario) == 0) {
                        echo "<p>No se encontraron coincidencias</p>";
                    } else {
                        ?>

                        <form method="POST">
                            <table class="eliminarAmigos">
                                <tr><th></th><th>Usuario</th><th>Nombre</th><th>Apellidos</th><th>Email</th><th>localidad</th></tr>
                                <?PHP
                                //se muestran todos los usuarios encontrados
                                while ($usuarios = mysqli_fetch_array($rowUsuario)) {
                                    ?>
                                    <tr><td><input type="radio" name="id_usuario_eliminar" value="<?PHP echo $usuarios['id_usuario'] ?>" /></td><td><i class="fa fa-user-o" style="color:#ef8d17;"></i>&nbsp;<?PHP echo $usuarios['usuario'] ?></td><td><?PHP echo $usuarios['nombre'] ?></td><td><?PHP echo $usuarios['apellidos'] ?></td><td><?PHP echo $usuarios['email'] ?></td><td><?PHP echo $usuarios['localidad'] ?></td></tr>
                                    <?PHP
                                }
                                ?>


                                <?PHP
                                //muestro los distintos índices de las páginas, si es que hay varias páginas
                                if ($total_paginas > 1) {
                                    echo "<p>";
                                    echo "Número de páginas: ";
                                    for ($i = 1; $i <= $total_paginas; $i++) {
                                        if ($pagina == $i) {
                                            //si muestro el índice de la página actual, no coloco enlace
                                            echo $pagina . " ";
                                        } else {
                                            //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
                                            echo "<a href='eliminarUsuario.php?pagina=" . $i . "'>" . $i . "</a> ";
                                        }
                                    }
                                    echo "</p>";
                                }
                                ?>

                            </table>
                            <div class="botonesUsuario">
                                <input type="submit" name="eliminarUsuario" value="Eliminar Usuario" />
                                <input type="submit" name="eliminarContenido" value="Eliminar Contenido" />
                            </div>

                        </form>

                        <?PHP
                    }
                    ?>
                    <form method="POST" action="#">

                        <div class="row">
                            <div class="col-25">
                                <label>Usuario</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="usuario" name="usuario" class="form-control"  onchange="comprobar(this, /^[a-zA-z0-9]{3,15}$/)" /> 

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-25">
                                <label>Nombre</label>
                            </div>
                            <div class="col-75">
                                <input type="text"  id="nombre" name="nombre" class="form-control" onchange="comprobar(this, /^[A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]{2,15}$/)"  />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-25">
                                <label>Apellidos</label>
                            </div>
                            <div class="col-75">

                                <input type="text" id="apellidos" name="apellidos" class="form-control" onchange="comprobar(this, /^([a-zA-ZÁÉÍÓÚñáéíóú]{1,15}[\s]*)+$/)" />
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-25">
                                <label>E-mail</label>
                            </div>
                            <div class="col-75">
                                <input type="email" id="email" name="email" class="form-control" onchange="comprobar(this, /^[a-zA-z0-9]+@[a-z]+\.[a-z]+/)"/>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-25">
                                <label>Localidad</label>
                            </div>

                            <div class="col-75">
                                <select id="localidad" name="localidad" >
                                    <option value='' >&nbsp;<-&nbsp;Seleccione&nbsp;una&nbsp;localidad&nbsp;->&nbsp;</option>
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

                        <div id="buttonsContainer">
                            <input type="submit" name="enviar" class="button" id="btn-register-now" value="Filtrar"  />
                        </div>

                        <div>
                            <div class="row">
                                <div class="col-25" id="requerido">

                                </div>
                            </div>
                        </div>

                    </form>

                </section>


                <?php
                include_once '../aside.php';
                ?>
            </div>

            <?php
            include_once '../footer.php';
        } else {
            //guardamos la url para volver a esta pagína en una variable de sesión y el tipo de usuario
            $_SESSION['url'] = "administrador/eliminarUsuario.php";
            $_SESSION['tipo'] = 'administrador';
            header("location:../login.php");
        }
        ?>
    </body>
</html>









