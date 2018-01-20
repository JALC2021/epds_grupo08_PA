<?PHP
session_start();

require_once '../functions.php';


if (isset($_SESSION['usuario'])) {

    $con = connectDB();

    if (!$con) {
        die("Conexión fallida");
    }

    $db_selected = selectDB($con);

    $user = $_SESSION['user'];

    $result = mysqli_query($con, "SELECT `id_usuario` FROM `usuario` WHERE `usuario` LIKE '" . $user . "';");

    $row = mysqli_fetch_array($result);

    $id_usuario = $row["id_usuario"];

    $result = mysqli_query($con, "select COUNT(*) AS \"votosRecibidos\"  FROM contenido c , voto v WHERE c.id_contenido = v.id_contenido and c.id_usuario = '" . $id_usuario . "';");

    $row = mysqli_fetch_array($result);

    $votosRecibidos = $row["votosRecibidos"];

    $result = mysqli_query($con, "SELECT COUNT(*) AS \"votosRealizados\" FROM voto WHERE id_usuario = '" . $id_usuario . "';");

    $row = mysqli_fetch_array($result);

    $votosRealizados = $row["votosRealizados"];

    $result = mysqli_query($con, "select SEC_TO_TIME(SUM(TIME_TO_SEC(d.duracion))) as \"time\" from contenido c NATURAL JOIN deportes d where c.id_usuario ='" . $id_usuario . "';");

    $row = mysqli_fetch_array($result);

    $time = $row['time'];

    $result = mysqli_query($con, "SELECT COUNT(*) AS \"comentariosRecibidos\" FROM comentario cm, contenido cn where cm.id_contenido = cn.id_contenido and cn.id_usuario = '" . $id_usuario . "';");

    $row = mysqli_fetch_array($result);

    $comentariosRecibidos = $row['comentariosRecibidos'];

    $result = mysqli_query($con, "SELECT COUNT(*) AS \"comentariosRealizados\" FROM comentario WHERE id_usuario = '" . $id_usuario . "';");

    $row = mysqli_fetch_array($result);

    $comentariosRealizados = $row['comentariosRealizados'];


    $result = mysqli_query($con, "SELECT count(*) AS \"dieta\" FROM alimentacion a NATURAL JOIN contenido c where c.id_usuario = '" . $id_usuario . "' and a.dieta_estudio like 'dieta';");

    $row = mysqli_fetch_array($result);

    $dietas = $row['dieta'];

    $result = mysqli_query($con, "SELECT count(*) AS \"cientifico\" FROM alimentacion a NATURAL JOIN contenido c where c.id_usuario = '" . $id_usuario . "' and a.dieta_estudio like 'cientifico';");

    $row = mysqli_fetch_array($result);

    $cientifico = $row['cientifico'];

    $result = mysqli_query($con, "SELECT count(*) AS \"deportes\" FROM deportes a NATURAL JOIN contenido c where c.id_usuario = '" . $id_usuario . "';");

    $row = mysqli_fetch_array($result);

    $deportes = $row['deportes'];

    $result = mysqli_query($con, "SELECT count(*) AS \"suplemento\" FROM suplemento a NATURAL JOIN contenido c where c.id_usuario = '" . $id_usuario . "';");

    $row = mysqli_fetch_array($result);

    $suplemento = $row['suplemento'];
    $publicaciones = $dietas + $cientifico + $deportes + $suplemento;

    disconnectDB($con);
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8" />
            <title>SocialHealthy</title>
            <meta name="viewport" content="width=device-width, user-scalabe=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
            <link rel="stylesheet" type="text/css" href="../css/style_base.css" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link rel="shortcut icon" type="image/x-icon" href="../images/logo2.png" />
        </head>
        <body>

            <?PHP include_once '../header.php'; ?>

            <div class="contendioPrincipal">


                <?PHP include_once './menuPrincipal.php'; ?>

                <section class="sectionEstadistica">
                    <div class="container">
                        <h2>Mis estad&iacute;sticas</h2>
                        <table class="estadistica">
                            <tr><th>Estad&iacute;stica</th><th>Cantidad</th></tr>
                            <tr><td>Likes realizados</td><td><?PHP echo $votosRecibidos; ?></td></tr>
                            <tr><td>Likes recibidos</td><td><?PHP echo $votosRealizados; ?></td></tr>
                            <tr><td>Publicaciones realizadas</td><td><?PHP echo $publicaciones; ?></td></tr>
                            <tr><td>Comentarios recibidos</td><td><?PHP echo $comentariosRecibidos; ?></td></tr>
                            <tr><td>Comentarios Realizados</td><td><?PHP echo $comentariosRealizados; ?></td></tr>
                            <tr><td>Dietas publicadas</td><td><?PHP echo $dietas; ?></td></tr>
                            <tr><td>Estudios cientificos publicados</td><td><?PHP echo $cientifico; ?></td></tr>
                            <tr><td>Deportes publicados</td><td><?PHP echo $deportes; ?></td></tr>
                            <tr><td>Suplementos publicados</td><td><?PHP echo $suplemento; ?></td></tr>
                            <tr><td>Tiempo invertido en hacer deporte</td><td><?PHP echo $time; ?> horas</td></tr>
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
            $_SESSION['url'] = "usuario/estadistica.php";
            $_SESSION['tipo'] = 'usuario';
            header("location:../login.php");
        }
        ?>
    </body>
</html>