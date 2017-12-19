<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script>
    $(function() {
        var elemento, punto, lugar, offset;
        $("input[type='range']").change(function() {
            elemento = $(this);
            width = elemento.width();
            punto = (elemento.val() - elemento.attr("min")) / (elemento.attr("max") - elemento.attr("min"));
            offset = -1.3;
            if (punto < 0) {
                lugar = 0;
            }
            else if (punto > 1) {
                lugar = width;
            }
            else {
                lugar = width * punto + offset;
                offset -= punto;
            }
            elemento
                    .next("output")
                    .css({
                        left: lugar,
                        marginLeft: offset + "%"
                    })
                    .text(elemento.val());
        })
                .trigger('change');
    });
</script>

<?php
include 'consultasSql.php';
include 'seguridad.php';
$_SESSION['currentPage'] = 'analisisJuegos';
include 'cabecera.php';
include 'navegador.php';

//include 'menu.php';
//INICIO DE ANALISIS JUEGO
function muestraIndexAnalisisJuegos() {
    echo '<div class="articulos" id="lleno">';
    $sql = "SELECT b.id,b.titulo,b.texto,b.nota,b.fecha,b.usuario_id,a.user "
            . "FROM usuarios a, analisisjuego b "
            . "WHERE a.id=b.usuario_id "
            . "ORDER BY id "
            . "DESC LIMIT 4";
    $result = consultaSelect($sql);
    while ($row = mysql_fetch_array($result)) {
        echo '<div class="articulo">';
        echo '<h3 class="titulo"><strong><a href="?id=' . $row['id'] . '">' . $row['titulo'] . '</a></strong><span class="etiq"></span></h3>';
        echo '<p class="texto">' . substr($row['texto'], 0, 100) . '<br/><br/><a href="analisisJuegos.php?id=' . $row['id'] . '" class="more"> Leer más...</a></p>';
        echo '<p class="autor">Author: ' . $row['user'] . '</p>';
        echo '<p class="fecha">Date: ' . $row['fecha'] . '</p>';
        echo '</div>';
    }
    echo '</div>';
}

//MOSTRAR ANALISIS POR ID
function mostrarAnalisisJuegos($id) {
    $sql = "SELECT b.id,b.titulo,b.texto,b.nota,b.fecha,b.usuario_id,a.user,b.video "
            . "FROM usuarios a, analisisjuego b "
            . "WHERE a.id=b.usuario_id and b.id=" . $id
            . " ORDER BY fecha"
            . " DESC LIMIT 4";
    $result = consultaSelect($sql);
    $row = mysql_fetch_array($result);
    echo '<div class="articulolleno">';
    echo '<h3 class="titulo"><strong>' . $row['titulo'] . '</strong><span class="etiq"></span></h3>';
    echo '<p class="texto">' . $row['texto'] . '</p>';
    echo '<p class="video"><iframe width="640" height="360" src="//www.youtube.com/embed/' . $row['video'] . '?rel=0" frameborder="0" allowfullscreen></iframe></p>';
    echo '<p class="nota">Nota: ' . $row['nota'] . '</p>';
    echo '<p class="autor">Author: ' . $row['user'] . '</p>';
    echo '<p class="fecha">Date: ' . $row['fecha'] . '</p>';
    echo '</div>';
}

//INSERTAR ANALISIS
function muestraformInsert() {
    $result = consultaSelect("SELECT id, nombre FROM juego");
    echo '<form action="#" method="POST" class="formulario">';
    echo '<ul>';
    echo '<li>';
    echo '<h2>Insertar an&aacute;lisis de juego </h2>';
    echo '</li>';
    echo '<li>';
    echo '<label>Titulo: </label><input type="text" name="titulo" placeholder="An&aacute;lisis de GTA V" required/>';
    echo '</li>';
    echo '<li>';
    echo '<label>An&aacute;lisis: </label>'
    . '<textarea rows="4" cols="50" name="texto" placeholder="Escribir el an&aacute;lisis del juego" required></textarea>';
    echo '</li>';
    echo '<li>';
    echo '<label>Video Youtube: </label><br /><input type="text" name="video" placeholder="www.youtube.com/embed/A5Q7Vw5lqLE?rel=0" />';
    echo '</li>';
    echo '<li>';
    echo '<label>Nota (1-10):</label><input id="nota" name="nota" type="range" min=1 max=10 value=5 required/><output for="nota">5</output>';
    echo '</li>';
    echo '<li>';
    echo '<label>Seleccionar juego:</label><select name="juegoSeleccionado">';
    while ($row = mysql_fetch_array($result)) {
        echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
    }
    echo '</select>';
    echo '<button class="submit" type = "submit" name = "enviarAdd" value = "Enviar">Publicar</button>';
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
        'nota' => FILTER_SANITIZE_NUMBER_INT,
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
    if (!isset($result['nota']) || !preg_match('/^[[:digit:]]/', $result['nota']) || $result['nota'] < -1 || $result['nota'] > 11) {
        $errores[] = 'Indique la nota correctamente, solo numeros enteros.';
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
        $sql = 'INSERT INTO `analisisjuego`(`id`, `fecha`, `titulo`, `texto`,`nota`, `juego_id`, `usuario_id`,video)'
                . ' VALUES (NULL,"' . date("Y-m-d") . '","' . $result['titulo'] . '","' . $result['texto'] . '","' . $result['nota'] . '",' . $_POST['juegoSeleccionado'] . ',' . $_SESSION['idUser'] . ',"' . $idYoutube . '")';
        consultaInsert($sql);
        muestraIndexAnalisisJuegos();
    }
}

//MOSTRAR SEARCH
function muestraformSearch() {
    echo '<form action="#" method="POST" class="formulario">';
    echo '<ul>';
    echo '<li>';
    echo '<h2>Buscar an&aacute;lisis de juego</h2>';
    echo '</li>';
    echo '<li>';
    echo '<label>Buscar por titulo:</label><input type="text" name="buscar">';
    echo '<button class="submit" type="submit" name="enviarSearch" value="Buscar">Buscar</button>';
    echo '</li>';
    echo '</ul>';
    echo '</form>';
}

//MOSTRAR BUSQUEDA
function mostrarSearch() {
    $sql = 'SELECT * FROM analisisjuego WHERE titulo like "%' . $_POST['buscar'] . '%";';
    $result = consultaSelect($sql);

    if (mysql_num_rows($result) == 0) {
        echo '<h2>No hay ningun juego para esa busqueda</h2>';
        muestraIndexAnalisisJuegos();
    } else {
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
    echo '<h2>Buscar an&aacute;lisis de juego para eliminar</h2>';
    echo '</li>';
    echo '<li>';
    echo '<label>Buscar por titulo:</label><input type="text" name="buscar">';
    echo '<button class="submit" type="submit" name="enviarSearchRemove" value="Buscar">Buscar</button>';
    echo '</li>';
    echo '</ul>';
    echo '</form>';
}

//MOSTRAR COMBOBOX PARA ELIMINAR
function mostrarSearchRemove() {
    $sql = 'SELECT * FROM analisisjuego WHERE titulo like "%' . $_POST['buscar'] . '%" AND usuario_id like ' . $_SESSION['idUser'];
    $result = consultaSelect($sql);
    if (mysql_num_rows($result) == 0) {
        echo '<h3>Usted no ha creado ningun analisis</h3>';
    } else {
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
function mostrarInformacionAnalisisJuegoRemove() {
    $sql = 'SELECT * FROM analisisjuego WHERE id like ' . $_POST['radioSearch'];
    $result = consultaSelect($sql);
    $row = mysql_fetch_array($result);
    $_SESSION['idEliminarAnalisisJuego'] = $row['id'];
    echo '<table class="tabla">';
    echo '<tr><td>Titulo:</td><td>' . $row['titulo'] . '</td></tr>';
    echo '<tr><td>Texto:</td><td>' . $row['texto'] . '</td></tr>';
    echo '</table>';
    echo '<form action="#" method="POST">';
    echo '<input type="submit" value="Borrar" name="enviarAnalisisJuegoRemove"/>';
    echo '</form>';
}

//ELIMINAR Analisis
function eliminarAnalisisJuego() {
    $sql = 'DELETE FROM `analisisjuego` WHERE id like ' . $_SESSION['idEliminarAnalisisJuego'];
    consultaInsert($sql);
    echo '<h3>Analisis Borrado</h3>';
}

//MOSTRAR SEARCH MODIFICAR
function muestraformSearchModify() {
    echo '<form action="#" method="POST" class="formulario">';
    echo '<ul>';
    echo '<li>';
    echo '<h2>Buscar an&aacute;lisis de juego para modificar</h2>';
    echo '</li>';
    echo '<li>';
    echo '<label>Buscar por titulo:</label><input type="text" name="buscar">';
    echo '<button class="submit" type="submit" name="enviarSearchModify" value="Buscar">Buscar</button>';
    echo '</li>';
    echo '</ul>';
    echo '</form>';
}

function mostrarSearchModify() {
    $sql = 'SELECT * FROM analisisjuego WHERE titulo like "%' . $_POST['buscar'] . '%";';
    $result = consultaSelect($sql);

    if (mysql_num_rows($result) == 0) {
        echo '<h2>No hay ningun juego para esa busqueda</h2>';
        muestraIndexAnalisisJuegos();
    } else {
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

function mostrarModifyAnalisisJuego() {
    $sql = 'SELECT * FROM analisisjuego WHERE id like ' . $_POST['radioSearch'];
    $result = consultaSelect($sql);
    $row = mysql_fetch_array($result);
    $_SESSION['idAnalisisJuegoModificar'] = $row['id'];
    echo '<form method="POST" action="#">';
    echo '<table class="tabla">';
    echo '<tr><td>Titulo:</td><td><input type="text" value="' . $row['titulo'] . '" name="titulo" /></td></tr>';
    echo '<tr><td>Texto:</td><td><textarea rows="4" cols="50" name="texto">' . $row['texto'] . '</textarea></td></tr>';
    echo '<tr><td>Nota (0-10):</td><td><input type="digit" value="' . $row['nota'] . '" name="nota" /></td></tr>';
    echo '<tr><td>Video Youtube: </td><td><input type="text" name="video" value="http://www.youtube.com/watch?v=' . $row['video'] . '" /></td></tr>';
    echo '</table>';
    echo '<input type="submit" value="Enviar" name="enviarAnalisisJuegoModify" />';
    echo '</form>';
}

function guardarAnalisisJuegoModify() {
    $filtros = Array(
        'titulo' => FILTER_SANITIZE_STRING,
        'texto' => FILTER_SANITIZE_STRING,
        'nota' => FILTER_SANITIZE_NUMBER_INT,
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
    if (!isset($result['nota']) || !preg_match('/^[[:digit:]]/', $result['nota']) || $result['nota'] < -1 || $result['nota'] > 11) {
        $errores[] = 'Indique una nota correctamente, entero del 0 al 10';
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
        $sql = 'UPDATE `analisisjuego` '
                . 'SET video="' . $idYoutube . '",`titulo`="' . $result["titulo"] . '",`texto`="' . $result["texto"] . '",`nota`="' . $result["nota"] . '" WHERE id like ' . $_SESSION['idAnalisisJuegoModificar'];
        consultaInsert($sql);
        muestraIndexAnalisisJuegos();
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
        mostrarAnalisisJuegos($_POST['radioSearch']);
    } else if (isset($_POST['enviarSearchRemove'])) {
        mostrarSearchRemove();
    } else if (isset($_POST['enviarSearchRemoved'])) {
        mostrarInformacionAnalisisJuegoRemove();
    } else if (isset($_POST['enviarAnalisisJuegoRemove'])) {
        eliminarAnalisisJuego();
    } else if (isset($_POST['enviarSearchModify'])) {
        mostrarSearchModify();
    } else if (isset($_POST['enviarSearchModifed'])) {
        mostrarModifyAnalisisJuego();
    } else if (isset($_POST['enviarAnalisisJuegoModify'])) {
        guardarAnalisisJuegoModify();
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
                    muestraIndexAnalisisJuegos();
                    break;
            }
        } else if (isset($_GET["id"])) {
            mostrarAnalisisJuegos($_GET["id"]);
        } else {
            muestraIndexAnalisisJuegos();
        }
    }
    ?>
</section>
<?php
include 'pie.php';
?>