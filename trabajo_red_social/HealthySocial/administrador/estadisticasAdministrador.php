<?PHP
session_start();

require_once '../functions.php';
//si eres sesión de administrador
if (isset($_SESSION['administrador'])) {
    //conexión con la base de datos
    $con = connectDB();
    $db_selected = selectDB($con);
    //consultamos el número de mujeres
    $numMujeres = mysqli_query($con, "SELECT COUNT(*) AS numeroMujeres FROM `estadisticasapp` WHERE `sexo` LIKE 'mujer';");

    if (!$numMujeres) {
        die("Error al ejecutar la consulta: " . mysqli_error($con));
    } else {
        $mujeres = mysqli_fetch_array($numMujeres);
    }
    //consultamos el número de hombres
    $numHombres = mysqli_query($con, "SELECT COUNT(*) AS numeroHombres FROM `estadisticasapp` WHERE `sexo` LIKE 'hombre';");
    if (!$numHombres) {
        die("Error al ejecutar la consulta: " . mysqli_error($con));
    } else {
        $hombres = mysqli_fetch_array($numHombres);
    }
    //mostramos qué sexo hay más
    if ($hombres['numeroHombres'] > $mujeres['numeroMujeres']) {
        $sexoMasFrec = 'Hombre';
    } else {
        $sexoMasFrec = 'Mujer';
    }

    //calculamos la nota media
    $media = mysqli_query($con, "SELECT AVG(estadisticasapp.nota) AS notamedia FROM estadisticasapp;");
    if (!$media) {
        die("Error al ejecutar la consulta: " . mysqli_error($con));
    } else {
        $nota_media = mysqli_fetch_array($media);
    }
    
    //calculamos el tiempo medio de la aplicación
    $tiempoMedio = mysqli_query($con, "SELECT AVG(DATEDIFF(estadisticasapp.fecha_baja,estadisticasapp.fecha_alta)) AS tiempoMedio FROM estadisticasapp;");
    if (!$tiempoMedio) {
        die("Error al ejecutar la consulta: " . mysqli_error($con));
    } else {
        $tiempoMedioUso = mysqli_fetch_array($tiempoMedio);
    }
    
    //contamos el número del primer motivo
    $numMot1 = mysqli_query($con, "SELECT COUNT(estadisticasapp.num_motivo) AS motivo1,estadisticasapp.num_motivo FROM estadisticasapp WHERE estadisticasapp.num_motivo=1;");
    if (!$numMot1) {
        die("Error al ejecutar la consulta: " . mysqli_error($con));
    } else {
        $motivo1 = mysqli_fetch_array($numMot1);
    }
    //contamos el número del segundo motivo
    $numMot2 = mysqli_query($con, "SELECT COUNT(estadisticasapp.num_motivo) AS motivo2,estadisticasapp.num_motivo FROM estadisticasapp WHERE estadisticasapp.num_motivo=2;");
    if (!$numMot2) {
        die("Error al ejecutar la consulta: " . mysqli_error($con));
    } else {
        $motivo2 = mysqli_fetch_array($numMot2);
    }
    //contamos el número del tercer motivo
    $numMot3 = mysqli_query($con, "SELECT COUNT(estadisticasapp.num_motivo) AS motivo3,estadisticasapp.num_motivo FROM estadisticasapp WHERE estadisticasapp.num_motivo=3;");
    if (!$numMot3) {
        die("Error al ejecutar la consulta: " . mysqli_error($con));
    } else {
        $motivo3 = mysqli_fetch_array($numMot3);
    }


    //se ordenan los motivos
    if ($motivo1['motivo1'] > $motivo2['motivo2']) {
        if ($motivo1['motivo1'] > $motivo3['motivo3']) {
            $mayor = $motivo1['motivo1'];
            $idmayor = $motivo1['num_motivo'];

            if ($motivo2['motivo2'] > $motivo3['motivo3']) {
                $medio = $motivo2['motivo2'];
                $idmedio = $motivo2['num_motivo'];
                $menor = $motivo3['motivo3'];
                $idmenor = $motivo3['num_motivo'];
            } else {
                $medio = $motivo3['motivo3'];
                $idmedio = $motivo3['num_motivo'];
                $menor = $motivo2['motivo2'];
                $idmenor = $motivo2['num_motivo'];
            }
        } else {
            $mayor = $motivo3['motivo3'];
            $idmayor = $motivo3['num_motivo'];
            $medio = $motivo1['motivo1'];
            $idmedio = $motivo1['num_motivo'];
            $menor = $motivo2['motivo2'];
            $idmenor = $motivo2['num_motivo'];
        }
    } else {

        if ($motivo2['motivo2'] > $motivo3['motivo3']) {
            $mayor = $motivo2['motivo2'];
            $idmayor = $motivo2['num_motivo'];

            if ($motivo1['motivo1'] > $motivo3['motivo3']) {
                $medio = $motivo1['motivo1'];
                $idmedio = $motivo1['num_motivo'];
                $menor = $motivo3['motivo3'];
                $idmenor = $motivo3['num_motivo'];
            } else {
                $medio = $motivo3['motivo3'];
                $idmedio = $motivo3['num_motivo'];
                $menor = $motivo1['motivo1'];
                $idmenor = $motivo1['num_motivo'];
            }
        } else {
            $mayor = $motivo3['motivo3'];
            $idmayor = $motivo3['num_motivo'];

            if ($motivo2['motivo2'] > $motivo1['motivo1']) {
                $medio = $motivo2['motivo2'];
                $idmedio = $motivo2['num_motivo'];
                $menor = $motivo1['motivo1'];
                $idmenor = $motivo1['num_motivo'];
            } else {
                $medio = $motivo1['motivo1'];
                $idmedio = $motivo1['num_motivo'];
                $menor = $motivo2['motivo2'];
                $idmenor = $motivo2['num_motivo'];
            }
        }
    }

    //Se obtiene la descripción de cada motivo   
    $descripcion1 = mysqli_query($con, "SELECT `descripcion` FROM `motivo` WHERE `id_motivo`=" . $idmayor . ";");
    if (!$descripcion1) {
        die("Error al ejecutar la consulta: " . mysqli_error($con));
    } else {
        $desc1 = mysqli_fetch_array($descripcion1);
    }


    $descripcion2 = mysqli_query($con, "SELECT `descripcion` FROM `motivo` WHERE `id_motivo`=" . $idmedio . ";");
    if (!$descripcion2) {
        die("Error al ejecutar la consulta: " . mysqli_error($con));
    } else {
        $desc2 = mysqli_fetch_array($descripcion2);
    }

    $descripcion3 = mysqli_query($con, "SELECT `descripcion` FROM `motivo` WHERE `id_motivo`=" . $idmenor . ";");
    if (!$descripcion3) {
        die("Error al ejecutar la consulta: " . mysqli_error($con));
    } else {
        $desc3 = mysqli_fetch_array($descripcion3);
    }

    disconnectDB($con);
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-
        strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta charset="UTF-8" />
            <title>SocialHealthy</title>
            <meta name="viewport" content="width=device-width, user-scalabe=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
            <link rel="stylesheet" type="text/css" href="../css/style_base.css" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
            <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
            <link rel="shortcut icon" type="image/x-icon" href="images/logoUrl.ico" />
        </head>
        <body>

            <?PHP include_once '../header.php'; ?>

            <div class="contendioPrincipal">

                <?PHP include_once './menuPrincipalAdministrador.php'; ?>

                <section class="sectionEstadistica">
                    <h2>Estad&iacute;sticas de la aplicaci&oacute;n</h2>
                    <div class="pruebaEst">
                        <table class="estadisticaUsuario">
                            <tr><td>Motivos de baja ordenados por su frecuencia</td></tr>
                            <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<b>1.</b>&nbsp;<?PHP echo utf8_encode($desc1['descripcion']) ?></td></tr>
                            <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<b>2.</b>&nbsp;<?PHP echo utf8_encode($desc2['descripcion']) ?></td></tr>
                            <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<b>3.</b>&nbsp;<?PHP echo utf8_encode($desc3['descripcion']) ?></td></tr>
                            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
                            <tr><td>Nota media de la aplicación puntuada por los usuarios:&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo number_format($nota_media['notamedia'], 1) ?></b></td></tr>                                      
                            <tr><td>Sexo m&aacute;s frecuente de uso de la aplicaci&oacute;n:&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $sexoMasFrec ?></b></td></tr>
                            <tr><td>Ti&eacute;mpo medio de uso de la aplicaci&oacute;n:&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo number_format($tiempoMedioUso['tiempoMedio'], 0) . ' d&iacute;as' ?></b></td></tr> 
                        </table>
                    </div>
                </section>

                <?php
                include_once '../aside.php';
                ?>
            </div>

            <?php
            include_once '../footer.php';
        } else {
            //guardamos la url para volver a esta pagína en una variable de sesión y el tipo de usuario
            $_SESSION['url'] = "administrador/estadisticasAdministrador.php";
            $_SESSION['tipo'] = 'administrador';
            header("location:../login.php");
        }
        ?>
    </body>
</html>
