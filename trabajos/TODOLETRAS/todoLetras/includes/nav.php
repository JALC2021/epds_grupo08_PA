<nav class="menu">
    <ul>
        <li><a href="index.php">Inicio</a></li>
        <li><a href="libros.php">Libros</a></li>
        <li><a href="ebooks.php">eBooks</a></li>
        <li><a href="comunidad.php">Comunidad</a></li>
        <li><a href="noticias.php">Noticias</a></li>
        <li><a href="contacto.php">Contacto</a></li>
        <form class="buscar" method="get" name="searchform" action="busqueda.php" >
            <input type="text" name="buscar" placeholder="Buscar" />
            <select name="seleccion">
                <option value="0">Todo</option>
                <option value="1">T&iacute;tulo</option>
                <option value="2">Autor</option>
                <option value="3">Editorial</option>
                <option value="4">A&ntilde;o de Edici&oacute;n</option>
                <option value="5">ISBN</option>
            </select>
            <input type="submit" value="Buscar" class="input-button"/>
        </form>
    </ul>
</nav>
