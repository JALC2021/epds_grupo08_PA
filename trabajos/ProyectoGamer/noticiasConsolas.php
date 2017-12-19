<?php
include 'consultasSql.php';
include 'seguridad.php';
$_SESSION['currentPage'] = 'noticiasConsolas';
include 'cabecera.php';
include 'navegador.php';

//include 'menu.php';
//INICIO DE NOTICIAS CONSOLAS
function muestraIndexNoticiasConsolas() {
    echo '<div class="articulos" id="lleno">';
    echo '<h3>NOTICIAS CONSOLAS</h3>';
    $result = consultaSelect("SELECT noticiaconsola.id,titulo,texto,fecha,usuario_id,user FROM `noticiaconsola`, usuarios WHERE usuarios.id LIKE usuario_id ORDER BY id DESC LIMIT 4 ");
    while ($row = mysql_fetch_array($result)) {
        echo '<div class="articulo">';
        echo '<h3 class="titulo"><strong><a href="?id=' . $row['id'] . '" >' . $row['titulo'] . '</a></strong><span class="etiq"></span></h3>';
        echo '<p class="texto">' . substr($row['texto'], 0, 100) . '<br /><br/><a href="noticiasConsolas.php?id=' . $row['id'] . '" class="more"> Leer más...</a></p>';
        echo '<p class="autor">Author: ' . $row['user'] . '</p>';
        echo '<p class="fecha">Date: ' . $row['fecha'] . '</p>';
        echo '</div>';
    }
    echo '</div>';
}

//MOSTRAR NOTICIA POR ID
function mostrarNoticiaConsolas($id) {
    $result = consultaSelect('SELECT noticiaconsola.id,titulo,texto,fecha,usuario_id,user,video FROM `noticiaconsola`, usuarios WHERE usuarios.id LIKE usuario_id AND noticiaconsola.id like ' . $id . ' ORDER BY fecha DESC LIMIT 4 ');
    $row = mysql_fetch_array($result);
    echo '<div class="articulolleno">';
    echo '<h3 class="titulo"><strong>' . $row['titulo'] . '</strong><span class="etiq"></span></h3>';
    echo '<p class="texto">' . $row['texto'] . '</p>';
    echo '<div class="vid">';
    echo '<p class="video"><iframe width="640" height="360" src="//www.youtube.com/embed/' . $row['video'] . '?rel=0" frameborder="0" allowfullscreen></iframe></p>';
    echo '</div>';
    echo '<p class="autor">Author: ' . $row['user'] . '</p>';
    echo '<p class="fecha">Date: ' . $row['fecha'] . '</p>';
    echo '</div>';
}

//INSERTAR NOTICIA
function muestraformInsert() {
    $result = consultaSelect("SELECT id, nombre FROM consola");
    echo '<form action="#" method="POST" class="formulario">';
    echo '<ul>';
    echo '<li>';
    echo '<h2>Insertar nueva noticia de consola:</h2>';
    echo '</li>';
    echo '<li>';
    echo '<label>Titulo: </label><input type="text" name="titulo" placeholder="Ya está disponible la PlayStation 4" required/>';
    echo '</li>';
    echo '<li>';
    echo '<label>Noticia: </label><br />'
    . '<textarea rows="4" cols="50" name="texto" placeholder="Escribir la noticia de la consola" required></textarea>';
    echo '</li>';
    echo '<li>';
    echo '<label>Video Youtube: </label><br /><input type="text" name="video" placeholder="www.youtube.com/embed/A5Q7Vw5lqLE?rel=0" />';
    echo '</li>';
    echo '<li>';
    echo '<label>Seleccione la consola: </label><select name="consolaSeleccionado" required>';
    while ($row = mysql_fetch_array($result)) {
        echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
    }
    echo '</select>';
    echo '<button class="submit" type = "submit" name = "enviarAdd" value = "Enviar">Publicar</button>';
    echo '</li>';
    echo '</ul>';
    echo '</form>';
}

function saveSaltoLinea($result, $param) {
    $textarea = $result[$param];
    return $result[$param] = str_replace("\n", "<br>", $textarea);
}

function comprobarEntrada() {
    $filtros = Array(
        'titulo' => FILTER_SANITIZE_STRING,
        'texto' => FILTER_SANITIZE_STRING,
        'video' => FILTER_SANITIZE_URL
    );
    $result = filter_input_array(INPUT_POST, $filtros);
    $expresion = "/[a-zA-Z ]/";

    $idYoutube = getYouTubeIdFromURL($result['video']);

    $result['texto'] = saveSaltoLinea($result, 'texto');
    //VALIDAMOS
    if (!isset($result['titulo']) || !preg_match('/^[[:alnum:]]/', $result['titulo'])) {
        $errores[] = 'Indique un titulo correctamente';
    }
    if (!isset($result['texto']) || !preg_match($expresion, $result['texto'])) {
        $errores[] = 'Indique un texto correctamente';
    }

    if (array_search(false, $result, true) || array_search(NULL, $result, true) || isset($errores)) {
        echo '<p>Error en los datos del formulario</p>';
        echo '<p>Por favor vuelva a introducir los datos de nuevo.</p>';
        if (isset($errores)) {
            echo '<p style="color:red">Errores cometidos:</p>';
            echo '<ul style="color:red">';
            foreach ($errores as $e) {
                echo "<li>$e</li>";
            }
            echo '</ul>';
        }
    } else {
        $sql = 'INSERT INTO `noticiaconsola`(`id`, `fecha`, `titulo`, `texto`, `consola_id`, `usuario_id`,video) VALUES (NULL,"' . date("Y-m-d") . '","' . $result['titulo'] . '","' . $result['texto'] . '",' . $_POST['consolaSeleccionado'] . ',' . $_SESSION['idUser'] . ',"' . $idYoutube . '")';
        consultaInsert($sql);
        muestraIndexNoticiasConsolas();
    }
}

//MOSTRAR SEARCH
function muestraformSearch() {
    echo '<form action="#" method="POST" class="formulario">';
    echo '<ul>';
    echo '<li>';
    echo '<h2>Buscar noticia de consola</h2>';
    echo '</li>';
    echo '<li>';
    echo '<label>Buscar por titulo:</label><input type="text" name="buscar" required>';
    echo '<button class="submit" type="submit" name="enviarSearch" value="Buscar">Buscar</button>';
    echo '</li>';
    echo '</ul>';
    echo '</form>';
}

//MOSTRAR BUSQUEDA
function mostrarSearch() {
    $sql = 'SELECT * FROM noticiaconsola WHERE titulo like "%' . $_POST['buscar'] . '%";';
    $result = consultaSelect($sql);
    if (mysql_num_rows($result) == 0) {
        echo '<h2>No hay ninguna consola para esa busqueda</h2>';
        muestraIndexNoticiasConsolas();
    } else {
        echo '<h3>Seleccione una noticia:</h3>';
        echo '<form method="POST" action="#">';
        echo '<table class="tabla">';
        while ($row = mysql_fetch_array($result)) {
            echo '<tr>';
            echo '<td><input type="radio" name="radioSearch" value="' . $row['id'] . '" checked/></td>';
            echo '<td>' . $row['titulo'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '<input type="submit" value="Enviar" name="enviarSearchBuscado" />';
        echo '</form>';
    }
}

//MOSTRAR SEARCH ELIMINAR
function muestraformSearchRemove() {
    echo '<form action="#" method="POST" class="formulario">';
    echo '<ul>';
    echo '<li>';
    echo '<h2>Buscar noticia de consola para eliminar</h2>';
    echo '</li>';
    echo '<li>';
    echo '<label>Buscar por titulo:</label><input type="text" name="buscar" required>';
    echo '<button class="submit" type="submit" name="enviarSearchRemove" value="Buscar">Buscar</button>';
    echo '</li>';
    echo '</ul>';
    echo '</form>';
}

//MOSTRAR COMBOBOX PARA ELIMINAR
function mostrarSearchRemove() {
    $sql = 'SELECT * FROM noticiaconsola WHERE titulo like "%' . $_POST['buscar'] . '%" AND usuario_id like ' . $_SESSION['idUser'];
    $result = consultaSelect($sql);
    if (mysql_num_rows($result) == 0) {
        echo '<h3>Usted no ha creado ninguna noticia</h3>';
    } else {
        echo '<h3>Seleccione una noticia:</h3>';
        echo '<form method="POST" action="#">';
        echo '<table class="tabla">';
        while ($row = mysql_fetch_array($result)) {
            echo '<tr>';
            echo '<td><input type="radio" name="radioSearch" value="' . $row['id'] . '" checked /></td>';
            echo '<td>' . $row['titulo'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '<input type="submit" value="Enviar" name="enviarSearchRemoved" />';
        echo '</form>';
    }
}

//MOSTRAR NOTICIA DEL JUEGO A ELIMINAR
function mostrarInformacionNoticiaConsolaRemove() {
    $sql = 'SELECT * FROM noticiaconsola WHERE id like ' . $_POST['radioSearch'];
    $result = consultaSelect($sql);
    $row = mysql_fetch_array($result);
    $_SESSION['idEliminarNoticiaConsola'] = $row['id'];
    echo '<table class="tabla">';
    echo '<tr><td>Titulo:</td><td>' . $row['titulo'] . '</td></tr>';
    echo '<tr><td>Texto:</td><td>' . $row['texto'] . '</td></tr>';
    echo '</table>';
    echo '<form action="#" method="POST">';
    echo '<h3>¿Está seguro?</h3>';
    echo '<input type="submit" value="Borrar" name="enviarNoticiaConsolaRemove"/>';
    echo '</form>';
}

//ELIMINAR NOTICIA
function eliminarNoticiaConsola() {
    $sql = 'DELETE FROM `noticiaconsola` WHERE id like ' . $_SESSION['idEliminarNoticiaConsola'];
    consultaInsert($sql);
    muestraIndexNoticiasConsolas();
}

//MOSTRAR SEARCH MODIFICAR
function muestraformSearchModify() {
    echo '<form action="#" method="POST" class="formulario">';
    echo '<ul>';
    echo '<li>';
    echo '<h2>Buscar noticia de consola para modificar</h2>';
    echo '</li>';
    echo '<li>';
    echo '<label>Buscar por titulo:</label><input type="text" name="buscar"required>';
    echo '<button class="submit" type="submit" name="enviarSearchModify" value="Buscar">Buscar</button>';
    echo '</li>';
    echo '</ul>';
    echo '</form>';
}

function mostrarSearchModify() {
    $sql = 'SELECT * FROM noticiaconsola WHERE titulo like "%' . $_POST['buscar'] . '%";';
    $result = consultaSelect($sql);
    if (mysql_num_rows($result) == 0) {
        echo '<h2>No hay ninguna consola para esa busqueda</h2>';
        muestraIndexNoticiasConsolas();
    } else {
        echo '<h3>Buscar noticia:</h3>';
        echo '<form method="POST" action="#">';
        echo '<table class="tabla">';
        while ($row = mysql_fetch_array($result)) {
            echo '<tr>';
            echo '<td><input type="radio" name="radioSearch" value="' . $row['id'] . '" checked /></td>';
            echo '<td>' . $row['titulo'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '<input type="submit" value="Enviar" name="enviarSearchModifed" />';
        echo '</form>';
    }
}

function mostrarModifyNoticiaConsola() {
    $sql = 'SELECT * FROM noticiaconsola WHERE id like ' . $_POST['radioSearch'];
    $result = consultaSelect($sql);
    $row = mysql_fetch_array($result);
    $_SESSION['idNoticiaConsolaModificar'] = $row['id'];
    echo '<h3>Modifique la noticia:</h3>';
    echo '<form method="POST" action="#">';
    echo '<table class="tabla">';
    echo '<tr><td>Titulo:</td><td><input type="text" value="' . $row['titulo'] . '" name="titulo" /></td></tr>';
    echo '<tr><td>Texto:</td><td><textarea rows="4" cols="50" name="texto">' . $row['texto'] . '</textarea></td></tr>';
    echo '<tr><td>Video Youtube: </td><td><input type="text" name="video" value="http://www.youtube.com/watch?v=' . $row['video'] . '" /></td></tr>';
    echo '</table>';
    echo '<input type="submit" value="Enviar" name="enviarNoticiaConsolaModify" />';
    echo '</form>';
}

function guardarNoticiaConsolaModify() {
    $filtros = Array(
        'titulo' => FILTER_SANITIZE_STRING,
        'texto' => FILTER_SANITIZE_STRING,
        'video' => FILTER_SANITIZE_URL
    );
    $result = filter_input_array(INPUT_POST, $filtros);
    $expresion = "/[a-zA-Z ]/";

    $idYoutube = getYouTubeIdFromURL($result['video']);

    $result['texto'] = saveSaltoLinea($result, 'texto');
    //VALIDAMOS
    if (!isset($result['titulo']) || !preg_match('/^[[:alnum:]]/', $result['titulo'])) {
        $errores[] = 'Indique un titulo correctamente';
    }
    if (!isset($result['texto']) || !preg_match($expresion, $result['texto'])) {
        $errores[] = 'Indique una texto correctamente';
    }
    if (array_search(false, $result, true) || array_search(NULL, $result, true) || isset($errores)) {
        echo '<p>Error en los datos del formulario</p>';
        echo '<p>Por favor vuelva a introducir los datos de nuevo.</p>';
        if (isset($errores)) {
            echo '<p style="color:red">Errores cometidos:</p>';
            echo '<ul style="color:red">';
            foreach ($errores as $e) {
                echo "<li>$e</li>";
            }
            echo '</ul>';
        }
    } else {
        $sql = 'UPDATE `noticiaconsola` SET video="' . $idYoutube . '", `titulo`="' . $result["titulo"] . '",`texto`="' . $result["texto"] . '" WHERE id like ' . $_SESSION['idNoticiaConsolaModificar'];
        consultaInsert($sql);
        muestraIndexNoticiasConsolas();
    }
}
?>

<section id="content">
    <?php
    if (isset($_POST['enviarAdd'])) {
        comprobarEntrada();
    } else if (isset($_POST['enviarSearch'])) {
        mostrarSearch();
    } else if (isset($_POST['enviarSearchBuscado'])) {
        mostrarNoticiaConsolas($_POST['radioSearch']);
    } else if (isset($_POST['enviarSearchRemove'])) {
        mostrarSearchRemove();
    } else if (isset($_POST['enviarSearchRemoved'])) {
        mostrarInformacionNoticiaConsolaRemove();
    } else if (isset($_POST['enviarNoticiaConsolaRemove'])) {
        eliminarNoticiaConsola();
    } else if (isset($_POST['enviarSearchModify'])) {
        mostrarSearchModify();
    } else if (isset($_POST['enviarSearchModifed'])) {
        mostrarModifyNoticiaConsola();
    } else if (isset($_POST['enviarNoticiaConsolaModify'])) {
        guardarNoticiaConsolaModify();
    } else {
        if (isset($_GET["s"])) {
            switch ($_GET["s"]) {
                case "add":
                    muestraformInsert();
                    break;
                case "delete":
                    muestraformSearchRemove();
                    break;
                case "search":
                    muestraformSearch();
                    break;
                case "modify":
                    muestraformSearchModify();
                    break;
                default :
                    muestraIndexNoticiasConsolas();
                    break;
            }
        } else if (isset($_GET["id"])) {
            mostrarNoticiaConsolas($_GET["id"]);
        } else {
            muestraIndexNoticiasConsolas();
        }
    }
    ?>
</section>
<?php
include 'pie.php';
?>