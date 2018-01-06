<!DOCTYPE html>
<?PHP
session_start();

if (isset($_SESSION['estado'])) {
    ?>
    <!--
    To change this license header, choose License Headers in Project Properties.
    To change this template file, choose Tools | Templates
    and open the template in the editor.
    -->
    <html>
        <head>
            <meta charset="UTF-8">
            <title>HealthtyLife</title>
            <meta name="viewport" content="width=device-width, user-scalabe=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <link rel="stylesheet" type="text/css" href="style.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        </head>
        <body>

            <header>
                <h1>Healthy Social</h1>
            </header>

            <div class="contendioPrincipal">

                <nav class="menu">
                    <a href="#" id="botonMenu" class="material-icons">MEN&Uacute; &#xe7fd; </a>
                    <a href="#">PAGINA PERSONAL</a>
                    <a href="#">Publicar (formulario)</a>
                    <a href="#">Modificar datos personales</a>
                    <a href="#">Consultar estadísticas</a>
                    <a href="#">Darse de baja</a>
                    <a href="#">PUBLICACIONES AMIGOS</a>
                    <a href="#">Formulario de busqueda</a>
                    <a href="#">Consultar estadísticas</a>
                    <a href="#">PUBLICACIONES AMIGOS</a>
                    <a href="#">BUSCAR AMIGOS</a>
                    <a href="logout.php"id="botonCerrarSesion"<button><i class="material-icons">CERRAR SESI&Oacute;N power_settings_new</i></button></a>
                </nav>

                <section class="section">

                    <article>
                        <img class="imagenesArticulos" src="https://guiafitness.com/wp-content/uploads/tipos-deportes-invierno.jpg" alt="deporte">
                        <button style="font-size:24px"><i class="fa fa-thumbs-o-up"></i></button>
                        <button style="font-size:24px">Total <i class="fa fa-heart"></i></button>
                        <button style="font-size:24px"><i class="fa fa-thumbs-o-down"></i></button>
                        <button style="font-size:24px"><i class="fa fa-align-justify"></i></button>
                    </article>

                    <article>
                        <img class="imagenesArticulos"src="http://ideasdeeventos.com/wp-content/uploads/2014/10/vida-sana-recetas-vegetarianas1.jpg" alt="comidaSana">
                        <button style="font-size:24px"><i class="fa fa-thumbs-o-up"></i></button>
                        <button style="font-size:24px">Total <i class="fa fa-heart"></i></button>
                        <button style="font-size:24px"><i class="fa fa-thumbs-o-down"></i></button>
                        <button style="font-size:24px"><i class="fa fa-align-justify"></i></button>
                    </article>

                    <article>
                        <img class="imagenesArticulos" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRuWgUVl2yOjS85pcgImwvW2VIBMf8O29aF2mPX7JxAt5S5M3abqA" alt="vidaSana">
                        <button style="font-size:24px"><i class="fa fa-thumbs-o-up"></i></button>
                        <button style="font-size:24px">Total <i class="fa fa-heart"></i></button>
                        <button style="font-size:24px"><i class="fa fa-thumbs-o-down"></i></button>
                        <button style="font-size:24px"><i class="fa fa-align-justify"></i></button>
                    </article>

                </section>

                <aside class="aside">
                    <img class="imagenesAside" src="https://pbs.twimg.com/profile_images/771267606456053765/GdDcSuoM.jpg" alt="vidasana">
                    <img class="imagenesAside" src="http://wellness.syr.edu/wp-content/uploads/2016/06/healthy-habits-lifestyle-300x225.jpg"alt="vidasana">
                    <img class="imagenesAside" src="http://www.infanciayeducacion.com/wp-content/uploads/2014/05/Platoni%C3%B1os.jpg" alt="vidasana">
                    <img class="imagenesAside" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQE4TLEuIURtPfCWJyJauOqthYuZr46dZn8RI98d_YjOPZMeFAhQw" alt="vidasana">
                    <img class="imagenesAside" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSDASzryrOW4mg0ipwe34h7It9j0_vjncRWv9BqIoauRXK-Jypm" alt="vidasana">
                    <img class="imagenesAside" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ-77LWgwBHvySki92X-uhK-R1afpz6_WWmDNuJHVaZ-iZdoWl_" alt="vidasana">
                </aside>
            </div>

            <footer class="footer">
                <h3>Gonzalo - Juan Antonio - Susana</h3>
            </footer>

            <?php
        } else {
            $_SESSION['url'] = "index.php";
            header("location:login.php");
        }
        ?>
    </body>
</html>
