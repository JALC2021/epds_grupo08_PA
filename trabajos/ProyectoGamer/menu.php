
<aside>
    <ul>
        <?php
        switch ($_SESSION['currentPage']) {
            case 'consola':
                if (isset($_SESSION['logeado'])) {
                    echo '<li><a href="consola.php?s=add">Agregar</a></li>';
                    echo '<li><a href="consola.php?s=modify">Modificar</a></li>';
                    echo '<li><a href="consola.php?s=search">Buscar</a></li>';
                    echo '<li><a href="consola.php?s=delete">Eliminar</a></li>';
                } else {
                    echo '<li>Agregar<span class="textoLogeate"><a href="login.php"> Login</a></span></li>';
                    echo '<li>Modificar<span class="textoLogeate"><a href="login.php"> Login</a></span></li>';
                    echo '<li>Buscar<span class="textoLogeate"><a href="login.php"> Login</a></span></li>';
                    echo '<li>Borrar<span class="textoLogeate"><a href="login.php"> Login</a></span></li>';
                }
                break;
            case 'juegos':
                if (isset($_SESSION['logeado'])) {
                    echo '<li><a href="juegos.php?s=add">Agregar</a></li>';
                    echo '<li><a href="juegos.php?s=modify">Modificar</a></li>';
                    echo '<li><a href="juegos.php?s=search">Buscar</a></li>';
                    echo '<li><a href="juegos.php?s=delete">Eliminar</a></li>';
                } else {
                    echo '<li>Agregar<span class="textoLogeate"><a href="login.php"> Login</a></span></li>';
                    echo '<li>Modificar<span class="textoLogeate"><a href="login.php"> Login</a></span></li>';
                    echo '<li>Buscar<span class="textoLogeate"><a href="login.php"> Login</a></span></li>';
                    echo '<li>Borrar<span class="textoLogeate"><a href="login.php"> Login</a></span></li>';
                }
                break;
            case 'noticiasConsolas':
                if (isset($_SESSION['logeado'])) {
                    echo '<li><a href="noticiasConsolas.php?s=add">Agregar</a></li>';
                    echo '<li><a href="noticiasConsolas.php?s=modify">Modificar</a></li>';
                    echo '<li><a href="noticiasConsolas.php?s=search">Buscar</a></li>';
                    echo '<li><a href="noticiasConsolas.php?s=delete">Eliminar</a></li>';
                } else {
                    echo '<li>Agregar<span class="textoLogeate"><a href="login.php"> Login</a></span></li>';
                    echo '<li>Modificar<span class="textoLogeate"><a href="login.php"> Login</a></span></li>';
                    echo '<li>Buscar<span class="textoLogeate"><a href="login.php"> Login</a></span></li>';
                    echo '<li>Borrar<span class="textoLogeate"><a href="login.php"> Login</a></span></li>';
                }
                break;
            case 'noticiasJuegos':
                if (isset($_SESSION['logeado'])) {
                    echo '<li><a href="noticiasJuegos.php?s=add">Agregar</a></li>';
                    echo '<li><a href="noticiasJuegos.php?s=modify">Modificar</a></li>';
                    echo '<li><a href="noticiasJuegos.php?s=search">Buscar</a></li>';
                    echo '<li><a href="noticiasJuegos.php?s=delete">Eliminar</a></li>';
                } else {
                    echo '<li>Agregar<span class="textoLogeate"><a href="login.php"> Login</a></span></li>';
                    echo '<li>Modificar<span class="textoLogeate"><a href="login.php"> Login</a></span></li>';
                    echo '<li>Buscar<span class="textoLogeate"><a href="login.php"> Login</a></span></li>';
                    echo '<li>Borrar<span class="textoLogeate"><a href="login.php"> Login</a></span></li>';
                }
                break;
            case 'analisisConsolas':
                if (isset($_SESSION['logeado'])) {
                    echo '<li><a href="analisisConsolas.php?s=add">Agregar</a></li>';
                    echo '<li><a href="analisisConsolas.php?s=modify">Modificar</a></li>';
                    echo '<li><a href="analisisConsolas.php?s=search">Buscar</a></li>';
                    echo '<li><a href="analisisConsolas.php?s=delete">Eliminar</a></li>';
                } else {
                    echo '<li>Agregar<span class="textoLogeate"><a href="login.php"> Login</a></span></li>';
                    echo '<li>Modificar<span class="textoLogeate"><a href="login.php"> Login</a></span></li>';
                    echo '<li>Buscar<span class="textoLogeate"><a href="login.php"> Login</a></span></li>';
                    echo '<li>Borrar<span class="textoLogeate"><a href="login.php"> Login</a></span></li>';
                }
                break;
            case 'analisisJuegos':
                if (isset($_SESSION['logeado'])) {
                    echo '<li><a href="analisisJuegos.php?s=add">Agregar</a></li>';
                    echo '<li><a href="analisisJuegos.php?s=modify">Modificar</a></li>';
                    echo '<li><a href="analisisJuegos.php?s=search">Buscar</a></li>';
                    echo '<li><a href="analisisJuegos.php?s=delete">Eliminar</a></li>';
                } else {
                    echo '<li>Agregar<span class="textoLogeate"><a href="login.php"> Login</a></span></li>';
                    echo '<li>Modificar<span class="textoLogeate"><a href="login.php"> Login</a></span></li>';
                    echo '<li>Buscar<span class="textoLogeate"><a href="login.php"> Login</a></span></li>';
                    echo '<li>Borrar<span class="textoLogeate"><a href="login.php"> Login</a></span></li>';
                }
                break;
            case 'login':
                ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="recuperar.php">Recuperar Pass</a></li>
                <?php
                break;
            case 'registro':
                ?>
                <li><a href="login.php">Login</a></li>  
                <?php
                break;
            default:
                break;
        }
        ?>
    </ul>
</aside>
