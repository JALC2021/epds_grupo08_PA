<!DOCTYPE html>
<?PHP
session_start();

require_once '../functions.php';

if (isset($_SESSION['usuario'])) {

    $con = connectDB();

    if (!$con) {
        die("Conexión fallida");
    }

    $db_selected = mysqli_select_db($con, "healthysocial");

    if (!$db_selected) {
        die("Conexión a basde de datos fallida");
    }

    $consulta = mysqli_query($con, "SELECT * FROM `usuario` WHERE `usuario` LIKE '" . $_SESSION['user'] . "';");
    if (!$consulta) {
        die("Error al ejecutar la consulta: " . mysqli_error($con));
    }

    $datosUsu = mysqli_fetch_array($consulta);


    if (isset($_POST['modificar'])) {
        $result = mysqli_query($con, "SELECT usuario FROM usuario WHERE usuario like '" . $_POST['usuario'] . "';");

        if (!$result) {
            die("Error al ejecutar la consulta: " . mysqli_error($con));
        }

        if (mysqli_num_rows($result) > 0) {
            ?>
            <script type="text/javascript">
                alert("El usuario introducido ya existe. Pruebe a insertar uno nuevo");
            </script>
            <?PHP
        } else if (preg_match("/^[A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]{2,15}$/", $_POST['nombre']) && preg_match("/^[[:alnum:]]{6,15}$/", $_POST['password']) &&
                preg_match("/^[[:alnum:]]{3,15}$/", $_POST['usuario']) && preg_match("/^[a-zA-z0-9]+@[a-z]+\.[a-z]+/", $_POST['email']) &&
                preg_match("/^([a-zA-ZÁÉÍÓÚñáéíóú]{1,15}[\s]*)+$/", $_POST['apellidos']) && preg_match("/^([a-zA-ZÁÉÍÓÚñáéíóú]{1,15}[\s]*)+$/", $_POST['localidad'])) {



            //saneamos la entrada a la bbdd
            $name = mysqli_real_escape_string($con, $_POST['nombre']);
            $apellidos = mysqli_real_escape_string($con, $_POST['apellidos']);
            $localidad = mysqli_real_escape_string($con, $_POST['localidad']);
            $user = mysqli_real_escape_string($con, $_POST['usuario']);

            $email = mysqli_real_escape_string($con, $_POST['email']);

            //usamos el hash para insertarlo en la bbdd
            $pass = password_hash(mysqli_real_escape_string($con, $_POST['password']), PASSWORD_DEFAULT);


            $result = mysqli_query($con, "UPDATE `usuario` SET `usuario`='" . $user . "',`password`='" . $pass . "',`tipo`='usuario',`nombre`='" . $name . "',`email`='" . $email . "',`sexo`='" . $datosUsu['sexo'] . "',`apellidos`='" . $apellidos . "',`localidad`='" . $localidad . "',`fecha_alta`='" . $datosUsu['fecha_alta'] . "' WHERE `usuario` LIKE '" . $_SESSION['user'] . "';");


            if (!$result) {
                die("Error al ejecutar la consulta: " . mysqli_error($con));
            }
            ?>
            <script type="text/javascript">
                alert("El usuario <?PHP echo $user ?> se ha modificado correctamente");
            </script>
            <?PHP
            disconnectDB($con);
        } else { //el problema viene aquí. Habra k poner alguna condición. Esto entonces tb un if else¿
            if (!preg_match('/^[[:alnum:]]{3,15}$/', $_POST['usuario'])) {
                ?>
                }
                <script type="text/javascript">
                    alert("Usuario incorrecto. De 3 a 15 carácteres alfanuméricos");
                </script>
                <?PHP
            }
            if (!preg_match("/^[[:alnum:]]{6,15}$/", $_POST['password'])) {
                ?>

                <script type="text/javascript">
                    alert("La contraseña es incorrecta. De 6 a 15 carácteres alfanuméricos");
                </script>
                <?PHP
            }
            if (!preg_match("/^[A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]{2,15}$/", $_POST['nombre'])) {
                ?>

                <script type="text/javascript">
                    alert("No se ha introducido el nombre correctamente. La primera letra mayúscula y de 3 a 15 carácteres alfanuméricos");
                </script>
                <?PHP
            }

            if (!preg_match("/^[a-zA-z0-9]+@[a-z]+\.[a-z]+/", $_POST['email'])) {
                ?>

                <script type="text/javascript">
                    alert("No se ha introducido el email correctamente.Ej:ejemplo@ejemplo.com");
                </script>
                <?PHP
            }
            if (!preg_match("/^([a-zA-ZÁÉÍÓÚñáéíóú]{1,15}[\s]*)+$/", $_POST['apellidos'])) {
                ?>

                <script type="text/javascript">
                    alert("No se ha introducido el apellido correctamente");
                </script>
                <?PHP
            }
            if (!preg_match("/^([a-zA-ZÁÉÍÓÚñáéíóú]{1,15}[\s]*)+$/", $_POST['localidad'])) {
                ?>

                <script type="text/javascript">
                    alert("No se ha introducido la localidad correctamente");
                </script>
                <?PHP
            }
        }
    }
    ?>

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
                        } else if (campo.getAttribute('id') == "password") {
                            alert('El campo ' +
                                    campo.getAttribute('id') +
                                    ' debe tener de 6 a 15 carácteres alfanuméricos');
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

                <?PHP include_once './menuPrincipal.php'; ?>

                <section class="sectionModificar">

                    <div class="container">
                        <h2>Modificar datos</h2>
                        <form method="POST" action="#">

                            <div class="row">
                                <div class="col-25">
                                    <label>Usuario</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="usuario" value="<?PHP echo $datosUsu['usuario'] ?>" name="usuario" class="form-control"  onchange="comprobar(this, /^[a-zA-z0-9]{3,15}$/)" /> 

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-25">
                                    <label>Contrase&ntilde;a<span id="requerido"> (*)</span></label>
                                </div>

                                <div class="col-75">
                                    <input type="password" size="8"  id="password" name="password" class="form-control" onchange="comprobar(this, /^[a-zA-z0-9]{6,15}$/)" required placeholder="Si lo desea puede modificar su contrase&ntilde;a o introducir la que tiene" />
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-25">
                                    <label>Nombre</label>
                                </div>
                                <div class="col-75">
                                    <input type="text"  id="nombre" value="<?PHP echo $datosUsu['nombre'] ?>" name="nombre" class="form-control" onchange="comprobar(this, /^[A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]{2,15}$/)"  />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-25">
                                    <label>Apellidos</label>
                                </div>
                                <div class="col-75">

                                    <input type="text" id="apellidos" value="<?PHP echo $datosUsu['apellidos']; ?>" name="apellidos" class="form-control" onchange="comprobar(this, /^([a-zA-ZÁÉÍÓÚñáéíóú]{1,15}[\s]*)+$/)" />
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-25">
                                    <label>Localidad</label>
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

                                <div class="col-25">
                                    <label>E-mail</label>
                                </div>
                                <div class="col-75">
                                    <input type="email" id="email" value="<?php echo $datosUsu['email'] ?>" name="email" class="form-control" onchange="comprobar(this, /^[a-zA-z0-9]+@[a-z]+\.[a-z]+/)"/>
                                </div>
                            </div>

                            <div id="buttonsContainer">
                                <input type="submit" name="modificar" class="button" id="btn-register-now" value="Modificar"  />
                            </div>

                            <div>
                                <div class="row">
                                    <div class="col-25" id="requerido">
                                        (*) Campo requerido
                                    </div>
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
            $_SESSION['url'] = "usuario/modificarDatos.php";
            $_SESSION['tipo'] = 'usuario';
            header("location:../login.php");
        }
        ?>
    </body>
</html>
