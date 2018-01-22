<?php
session_start();

if (isset($_SESSION['usuario'])) {
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
        </head>

        <body>
            <?PHP include_once '../header.php'; ?>

            <div class="contendioPrincipal">

                <section class="sectionBaja">
                    <h2>Baja usuario</h2>
                    <p><?php $_SESSION['user'] ?> Lamentamos su p&eacute;rdida, pero tal y como nos ha solicitado, ha sido dado de baja</p>
                    <p>Redirigiendo al login...</p>
 
                </section>

                <?PHP include_once '../aside.php'; ?>
            </div>
            <?php include_once '../footer.php'; ?>

            <?php
            header("refresh:6;url=../login.php");
        } else {
            $_SESSION['url'] = "usuario/despedida.php";
            $_SESSION['tipo'] = 'usuario';
            header("location:../login.php");
        }
        ?>
    </body>
</html>