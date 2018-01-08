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
            <?PHP require_once './head.html'; ?>
        </head>
        <body>

            <?PHP include_once './header.php'; ?>

            <div class="contendioPrincipal">

              <?PHP include_once './menuPrincipal.php'; ?>

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

                <?php
                include_once './aside.php';
                ?>
            </div>

            <?php
            include_once './footer.php';
        } else {
            $_SESSION['url'] = "index.php";
            header("location:login.php");
        }
        ?>
    </body>
</html>
