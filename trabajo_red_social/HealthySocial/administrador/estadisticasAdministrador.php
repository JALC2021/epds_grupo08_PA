<?PHP
    session_start();

    require_once '../functions.php';

    if (isset($_SESSION['administrador'])) {

        $con = connectDB();
        
  $db_selected = selectDB($con);
  
        $numMujeres = mysqli_query($con, "SELECT COUNT(*) AS numeroMujeres FROM `estadisticasapp` WHERE `sexo` LIKE 'mujer';");

        if (!$numMujeres) {
            die("Error al ejecutar la consulta: " . mysqli_error($con));
        } else {
            $mujeres = mysqli_fetch_array($numMujeres);
        }
        $numHombres = mysqli_query($con, "SELECT COUNT(*) AS numeroHombres FROM `estadisticasapp` WHERE `sexo` LIKE 'hombre';");
        if (!$numHombres) {
            die("Error al ejecutar la consulta: " . mysqli_error($con));
        } else {
            $hombres = mysqli_fetch_array($numHombres);
        }
        if ($hombres['numeroHombres'] > $mujeres['numeroMujeres']) {
            $sexoMasFrec = 'Hombre';
        } else {
            $sexoMasFrec = 'Mujer';
        }

        $media = mysqli_query($con, "SELECT AVG(estadisticasapp.nota) AS notamedia FROM estadisticasapp;");
        if (!$media) {
            die("Error al ejecutar la consulta: " . mysqli_error($con));
        } else {
            $nota_media = mysqli_fetch_array($media);
        }



        $tiempoMedio = mysqli_query($con, "SELECT AVG(DATEDIFF(estadisticasapp.fecha_baja,estadisticasapp.fecha_alta)) AS tiempoMedio FROM estadisticasapp;");
        if (!$tiempoMedio) {
            die("Error al ejecutar la consulta: " . mysqli_error($con));
        } else {
            $tiempoMedioUso = mysqli_fetch_array($tiempoMedio);
        }
        
       $numMot1=mysqli_query($con,"SELECT COUNT(estadisticasapp.num_motivo) AS motivo1,estadisticasapp.num_motivo FROM estadisticasapp WHERE estadisticasapp.num_motivo=1;");
        if (!$numMot1) {
            die("Error al ejecutar la consulta: " . mysqli_error($con));
        } else {
            $motivo1 = mysqli_fetch_array($numMot1);
        }
       
       $numMot2=mysqli_query($con,"SELECT COUNT(estadisticasapp.num_motivo) AS motivo2,estadisticasapp.num_motivo FROM estadisticasapp WHERE estadisticasapp.num_motivo=2;");
       if (!$numMot2) {
            die("Error al ejecutar la consulta: " . mysqli_error($con));
        } else {
            $motivo2 = mysqli_fetch_array($numMot2);
        }
       
       $numMot3=mysqli_query($con,"SELECT COUNT(estadisticasapp.num_motivo) AS motivo3,estadisticasapp.num_motivo FROM estadisticasapp WHERE estadisticasapp.num_motivo=3;");
         if (!$numMot3) {
            die("Error al ejecutar la consulta: " . mysqli_error($con));
        } else {
            $motivo3 = mysqli_fetch_array($numMot3);
        }
      
        
      //se ordenan los motivos
        if($motivo1['motivo1']>$motivo2['motivo2']){
            if($motivo1['motivo1']>$motivo3['motivo3']){
                $mayor=$motivo1['motivo1'];
                $idmayor=$motivo1['num_motivo'];
                
                if($motivo2['motivo2']>$motivo3['motivo3']){
                    $medio=$motivo2['motivo2'];
                    $idmedio=$motivo2['num_motivo'];
                    $menor=$motivo3['motivo3'];
                    $idmenor=$motivo3['num_motivo'];
                }else{
                    $medio=$motivo3['motivo3'];
                    $idmedio=$motivo3['num_motivo'];
                    $menor=$motivo2['motivo2'];
                    $idmenor=$motivo2['num_motivo'];
                }
            }else{
                $mayor=$motivo3['motivo3'];
                $idmayor=$motivo3['num_motivo'];
                $medio=$motivo1['motivo1'];
                $idmedio=$motivo1['num_motivo'];
                $menor=$motivo2['motivo2'];
                $idmenor=$motivo2['num_motivo'];
            }
        }else{
            
            if($motivo2['motivo2']>$motivo3['motivo3']){
                $mayor=$motivo2['motivo2'];
                $idmayor=$motivo2['num_motivo'];
                
                if($motivo1['motivo1']>$motivo3['motivo3']){
                    $medio=$motivo1['motivo1'];
                    $idmedio=$motivo1['num_motivo'];
                    $menor=$motivo3['motivo3'];
                    $idmenor=$motivo3['num_motivo'];
                }else{
                    $medio=$motivo3['motivo3'];
                    $idmedio=$motivo3['num_motivo'];
                    $menor=$motivo1['motivo1'];
                    $idmenor=$motivo1['num_motivo'];
                }
            }else{
                $mayor=$motivo3['motivo3'];
                $idmayor=$motivo3['num_motivo'];
                
                if($motivo2['motivo2']>$motivo1['motivo1']){
                    $medio=$motivo2['motivo2'];
                    $idmedio=$motivo2['num_motivo'];
                    $menor=$motivo1['motivo1'];
                    $idmenor=$motivo1['num_motivo'];
                }else{
                    $medio=$motivo1['motivo1'];
                    $idmedio=$motivo1['num_motivo'];
                    $menor=$motivo2['motivo2'];
                    $idmenor=$motivo2['num_motivo'];
                }
            }
        }
        
    //Se obtiene la descripción de cada motivo   
        $descripcion1=mysqli_query($con,"SELECT `descripcion` FROM `motivo` WHERE `id_motivo`=".$idmayor.";");
         if (!$descripcion1) {
            die("Error al ejecutar la consulta: " . mysqli_error($con));
        } else {
            $desc1 = mysqli_fetch_array($descripcion1);
        }
     
        
        $descripcion2=mysqli_query($con,"SELECT `descripcion` FROM `motivo` WHERE `id_motivo`=".$idmedio.";");
          if (!$descripcion2) {
            die("Error al ejecutar la consulta: " . mysqli_error($con));
        } else {
            $desc2 = mysqli_fetch_array($descripcion2);
        }
     
        $descripcion3=mysqli_query($con,"SELECT `descripcion` FROM `motivo` WHERE `id_motivo`=".$idmenor.";");
         if (!$descripcion3) {
            die("Error al ejecutar la consulta: " . mysqli_error($con));
        } else {
            $desc3 = mysqli_fetch_array($descripcion3);
        }
     
       disconnectDB($con);


        ?>
 <!DOCTYPE html>
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

                <section class="sectionPaginaPersonal">
                    <h2>Estad&iacute;sticas aplicaci&oacute;n</h2>
                    <ul>
                        <li>Motivos de baja ordenados por su frecuencia
                            <ol><br />
                                <li> <?PHP echo utf8_encode($desc1['descripcion']) ?></li>
                                <li> <?PHP echo utf8_encode($desc2['descripcion']) ?></li>
                                <li> <?PHP echo utf8_encode($desc3['descripcion']) ?></li>
                            </ol><br />
                        </li> 
                        <li>Nota media de la aplicación puntuada por los usuarios: <?php echo number_format($nota_media['notamedia'], 1) ?> </li>
                        <li>Sexo m&aacute;s frecuente de uso de la aplicaci&oacute;n: <?php echo $sexoMasFrec ?></li>
                        <li>Tiempo medio de uso de la aplicaci&oacute;n: <?php echo number_format($tiempoMedioUso['tiempoMedio'],0).' d&iacute;as' ?></li>
                    </ul>
                    <article>


                    </article>

                </section>

    <?php
    include_once '../aside.php';
    ?>
            </div>

                <?php
                include_once '../footer.php';
            } else {
                $_SESSION['url'] = "administrador/estadisticasAdministrador.php";
                $_SESSION['tipo'] = 'administrador';
                header("location:../login.php");
            }
            ?>
    </body>
</html>
