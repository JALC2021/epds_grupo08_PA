<!DOCTYPE html>
<?PHP
session_start();

if (isset($_SESSION['usuario'])) {
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
                                    <label>Usuario <span id="requerido"> (*)</span></label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="usuario" name="usuario" class="form-control" onchange="comprobar(this, /^[a-zA-z0-9]{3,15}$/)" required /> 
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-25">
                                    <label>Contrase&ntilde;a <span id="requerido"> (*)</span></label>
                                </div>

                                <div class="col-75">
                                    <input type="password" id="password" name="password" class="form-control" onchange="comprobar(this, /^[a-zA-z0-9]{6,15}$/)" required />
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-25">
                                    <label>Nombre <span id="requerido"> (*)</span></label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="nombre" name="nombre" class="form-control" onchange="comprobar(this, /^[A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]{2,15}$/)" required />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-25">
                                    <label>Apellidos <span id="requerido"> (*)</span></label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="apellidos" name="apellidos" class="form-control" onchange="comprobar(this, /^([a-zA-ZÁÉÍÓÚñáéíóú]{1,15}[\s]*)+$/)" required />
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

                                <div class="col-25">
                                    <label>E-mail <span id="requerido"> (*)</span></label>
                                </div>
                                <div class="col-75">
                                    <input type="email" id="email" name="email" class="form-control" onchange="comprobar(this, /^[a-zA-z0-9]+@[a-z]+\.[a-z]+/)" required />
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
            $_SESSION['url'] = "usuario/publicacionAmigos.php";
            $_SESSION['tipo'] = 'usuario';
            header("location:../login.php");
        }
        ?>
    </body>
</html>
