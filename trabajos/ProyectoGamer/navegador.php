
<nav>
    <ul id="derecha">
        <li><a <?php echo $_SESSION['currentPage'] == "index" ? "class=\"active\"" : ""; ?> href="index.php">Inicio</a></li>
        <li><a <?php echo $_SESSION['currentPage'] == "consola" ? "class=\"active\"" : ""; ?> href="consola.php">Consolas</a>
            <?php
            if (isset($_SESSION['logeado'])) {
                echo '<ul>';
                echo '<li><a href="consola.php?s=add">Agregar</a></li>';
                echo '<li><a href="consola.php?s=search">Buscar</a></li>';
                if ($_SESSION['admin'] == TRUE) {
                    echo '<li><a href="consola.php?s=modify">Modificar</a></li>';
                    echo '<li><a href="consola.php?s=delete">Eliminar</a></li>';
                }
                echo '</ul>';
            } else {
                echo '<ul>';
                echo '<li><span class="textoLogeate"><a href="login.php">Login</a></span></li>';
                echo '</ul>';
            }
            ?></li>
        <li><a <?php echo $_SESSION['currentPage'] == "juegos" ? "class=\"active\"" : ""; ?> href="juegos.php">Juegos</a>
            <?php
            if (isset($_SESSION['logeado'])) {
                echo '<ul>';
                echo '<li><a href="juegos.php?s=add">Agregar</a></li>';
                echo '<li><a href="juegos.php?s=search">Buscar</a></li>';
                if ($_SESSION['admin'] == TRUE) {
                    echo '<li><a href="juegos.php?s=modify">Modificar</a></li>';
                    echo '<li><a href="juegos.php?s=delete">Eliminar</a></li>';
                }
                echo '</ul>';
            } else {
                echo '<ul>';
                echo '<li><span class="textoLogeate"><a href="login.php">Login</a></span></li>';
                echo '</ul>';
            }
            ?>
        </li>
        <li><a <?php echo $_SESSION['currentPage'] == "noticias" ? "class=\"active\"" : ""; ?> href="index.php">Noticias</a>
            <ul>
                <li><a <?php echo $_SESSION['currentPage'] == "noticiasConsolas" ? "class=\"active\"" : ""; ?> href="noticiasConsolas.php">Consolas</a>
                    <?php
                    if (isset($_SESSION['logeado'])) {
                        echo '<ul>';
                        echo '<li><a href="noticiasConsolas.php?s=add">Agregar</a></li>';
                        echo '<li><a href="noticiasConsolas.php?s=modify">Modificar</a></li>';
                        echo '<li><a href="noticiasConsolas.php?s=search">Buscar</a></li>';
                        echo '<li><a href="noticiasConsolas.php?s=delete">Eliminar</a></li>';
                        echo '</ul>';
                    } else {
                        echo '<ul>';
                        echo '<li><span class="textoLogeate"><a href="login.php"> Login</a></span></li>';
                        echo '</ul>';
                    }
                    ?>
                </li>
                <li><a <?php echo $_SESSION['currentPage'] == "noticiasJuegos" ? "class=\"active\"" : ""; ?> href="noticiasJuegos.php">Juegos</a>
                    <?php
                    if (isset($_SESSION['logeado'])) {
                        echo '<ul>';
                        echo '<li><a href="noticiasJuegos.php?s=add">Agregar</a></li>';
                        echo '<li><a href="noticiasJuegos.php?s=modify">Modificar</a></li>';
                        echo '<li><a href="noticiasJuegos.php?s=search">Buscar</a></li>';
                        echo '<li><a href="noticiasJuegos.php?s=delete">Eliminar</a></li>';
                        echo '</ul>';
                    } else {
                        echo '<ul>';
                        echo '<li><span class="textoLogeate"><a href="login.php"> Login</a></span></li>';
                        echo '</ul>';
                    }
                    ?>
                </li>
            </ul>
        </li>
        <li><a <?php echo $_SESSION['currentPage'] == "analisis" ? "class=\"active\"" : ""; ?> href="analisis.php">Analisis</a>
            <ul>
                <li><a <?php echo $_SESSION['currentPage'] == "analisisConsolas" ? "class=\"active\"" : ""; ?> href="analisisConsolas.php">Consolas</a>
                    <?php
                    if (isset($_SESSION['logeado'])) {
                        echo '<ul>';
                        echo '<li><a href="analisisConsolas.php?s=add">Agregar</a></li>';
                        echo '<li><a href="analisisConsolas.php?s=modify">Modificar</a></li>';
                        echo '<li><a href="analisisConsolas.php?s=search">Buscar</a></li>';
                        echo '<li><a href="analisisConsolas.php?s=delete">Eliminar</a></li>';
                        echo '</ul>';
                    } else {
                        echo '<ul>';
                        echo '<li><span class="textoLogeate"><a href="login.php"> Login</a></span></li>';
                        echo '</ul>';
                        ;
                    }
                    ?>
                </li>
                <li><a <?php echo $_SESSION['currentPage'] == "analisisJuegos" ? "class=\"active\"" : ""; ?> href="analisisJuegos.php">Juegos</a>
                    <?php
                    if (isset($_SESSION['logeado'])) {
                        echo '<ul>';
                        echo '<li><a href="analisisJuegos.php?s=add">Agregar</a></li>';
                        echo '<li><a href="analisisJuegos.php?s=modify">Modificar</a></li>';
                        echo '<li><a href="analisisJuegos.php?s=search">Buscar</a></li>';
                        echo '<li><a href="analisisJuegos.php?s=delete">Eliminar</a></li>';
                        echo '</ul>';
                    } else {
                        echo '<ul>';
                        echo '<li><span class="textoLogeate"><a href="login.php"> Login</a></span></li>';
                        echo '</ul>';
                    }
                    ?>
                </li>
            </ul>
        </li>
    </ul>
    <ul id="izquierda">
        <?php
        if (isset($_SESSION['logeado']) && $_SESSION['logeado'] == TRUE) {
            echo '<li><label class="usuarioNavegacion"><a href="usuario.php">' . $_SESSION['user'] . '</a></label></li>';
            echo '<li><a '
            ?><?php echo $_SESSION['currentPage'] == 'desconectar' ? 'class="active"' : ''; ?><?php
            echo ' href="desconectar.php">Desconectar</a></li>';
        } else {
            echo '<li><a '
            ?><?php echo $_SESSION['currentPage'] == 'login' ? 'class="active"' : ''; ?><?php
            echo ' href="login.php">Login</a></li>';
            echo '<li><a '
            ?><?php echo $_SESSION['currentPage'] == 'registro' ? 'class="active"' : ''; ?><?php
            echo ' href="registro.php">Registro</a></li>';
        }
        ?>
    </ul>
</nav>
