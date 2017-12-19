<header>
    <?php
    if (isset($_SESSION['user'])) {
        if ($_SESSION['tipo'] == 'admin') {
            include('includes/navadmin.php');
        } else {
            include('includes/navlogin.php');
        }
    } else {
        include('includes/navlogout.php');
    }
    ?>
    <div class="logo">
        <figure>
            <a href="index.php"><img src="imagenes/logotipo.png" alt="logo" /></a>
        </figure>
        <div class="carro">
            <figure>
                <a href="carro.php"><img src="imagenes/carro_compra.png" alt="carrito" /></a>
            </figure>
        </div>
    </div>
</header>