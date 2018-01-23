<?PHP
session_start();
//si la sesión activa es la del administrador
if (isset($_SESSION['administrador'])) {
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
            <link rel="shortcut icon" type="image/x-icon" href="../images/logo2.png" />
        </head>
        <body>

            <?PHP include_once '../header.php'; ?>

            <div class="contendioPrincipal">

                <?PHP include_once './menuPrincipalAdministrador.php'; ?>

                <section class="sectionPaginaPersonal">

                    <h2><i class="fa fa-user-secret" style="color:#ef8d17;font-size:20px;"></i>&nbsp;<?PHP echo $_SESSION['user'];?></h2>
                    <!--mensaje de inicio-->
                    <p>Como administrador del sistema podrás realizar las siguientes funciones:</p>
                    <ol>
                        <li>Eliminar un usuario en concreto.</li>
                        <li>Eliminar el contenido de un usuario.</li>
                        <li>Ver estad&iacute;sticas de los usuarios para mejorar la aplicaci&oacute;n.</li>
                    </ol>

                </section>

                <?php
                include_once '../aside.php';
                ?>
            </div>

            <?php
            include_once '../footer.php';
        } else {
//guardamos la url para volver a esta pagína en una variable de sesión y el tipo de usuario
            $_SESSION['url'] = "administrador/indexAdministrador.php";
            $_SESSION['tipo'] = 'administrador';
            header("location:../login.php");
        }
        ?>
    </body>
</html>
