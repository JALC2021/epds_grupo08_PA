<?php
include 'consultasSql.php';
include 'seguridad.php';
$_SESSION['currentPage'] = 'juegos';
include 'cabecera.php';
include 'navegador.php';

function muestraIndexJuegos() {
    echo '<div class="articulos">';
    echo '<h3>JUEGOS</h3>';
    $result = consultaSelect("SELECT id,nombre,anyo,descripcion FROM juego ORDER BY anyo DESC LIMIT 6 ");
    while ($row = mysql_fetch_array($result)) {
        echo '<div class="articulolleno">';
        echo '<h3 class="titulo"><strong><a href="?id=' . $row['id'] . '">' . $row['nombre'] . '</a></strong><span class="etiq"></span></h3>';
        echo '<p class="texto">' . substr($row['descripcion'], 0, 100) . '<br /><br /><a href="juegos.php?id=' . $row['id'] . '" class="more"> Leer más...</a></p>';
        echo '<p class="fecha">Date: ' . $row['anyo'] . '</p>';
        echo '</div>';
    }
    echo '</div>';
}

function mostrarInformacionJuegoId($id) {
    $sql = 'SELECT * FROM juego WHERE id like "' . $id . '"';
    $result = consultaSelect($sql);
    if (mysql_num_rows($result) == 0) {
        echo '<h3>No existe el juego</h3>';
    } else {
        $row = mysql_fetch_array($result);
        echo '<div>';
        echo '<table class="tabla">';
        echo '<tr><td>Nombre:</td><td>' . $row['nombre'] . '</td></tr>';
        echo '<tr><td>Descripci&oacute;n:</td><td>' . $row['descripcion'] . '</td></tr>';
        echo '<tr><td>Informaci&oacute;n PEGI:</td><td>' . $row['edad'] . '</td></tr>';
        echo '<tr><td>Empresa:</td><td>' . $row['empresa'] . '</td></tr>';
        echo '<tr><td>Año:</td><td>' . $row['anyo'] . '</td></tr>';
        echo '</table>';
        echo '</div>';
    }
}

function mostrarInformacionJuego() {
    $sql = 'SELECT * FROM juego WHERE id like ' . $_POST['radioSearch'];
    $result = consultaSelect($sql);
    $row = mysql_fetch_array($result);
    echo '<div>';
    echo '<table class="tabla">';
    echo '<tr><td>Nombre:</td><td>' . $row['nombre'] . '</td></tr>';
    echo '<tr><td>Descripci&oacute;n:</td><td>' . $row['descripcion'] . '</td></tr>';
    echo '<tr><td>Informaci&oacute;n PEGI:</td><td>' . $row['edad'] . '</td></tr>';
    echo '<tr><td>Empresa:</td><td>' . $row['empresa'] . '</td></tr>';
    echo '<tr><td>Año:</td><td>' . $row['anyo'] . '</td></tr>';
    echo '</table>';
    echo '</div>';
}

function mostrarInformacionJuegoRemove() {
    $sql = 'SELECT * FROM juego WHERE id like ' . $_POST['radioSearch'];
    $result = consultaSelect($sql);
    $row = mysql_fetch_array($result);
    $_SESSION['idEliminarJuego'] = $row['id'];
    echo '<table class="tabla">';
    echo '<tr><td>Nombre:</td><td>' . $row['nombre'] . '</td></tr>';
    echo '<tr><td>Descripci&oacute;n:</td><td>' . $row['descripcion'] . '</td></tr>';
    echo '<tr><td>Informaci&oacute;n PEGI:</td><td>' . $row['edad'] . '</td></tr>';
    echo '<tr><td>Empresa:</td><td>' . $row['empresa'] . '</td></tr>';
    echo '<tr><td>Año:</td><td>' . $row['anyo'] . '</td></tr>';
    echo '</table>';
    echo '<form action="#" method="POST">';
    echo '<h3>¿Está seguro?</h3>';
    echo '<input type="submit" value="Borrar" name="enviarJuegoRemove"/>';
    echo '</form>';
}

function muestraformInsert() {
    echo '<form action="#" method="POST" class="formulario">';
    echo '<ul>';
    echo '<li>';
    echo '<h2>Insertar nuevo juego</h2>';
    echo '</li>';
    echo '<li>';
    echo '<label>Nombre: </label><input type="text" name="nombre" placeholder="Mario Bros" required/>';
    echo '</li>';
    echo '<li>';
    echo '<label>Descripci&oacute;n: </label>'
    . '<textarea rows="4" cols="50" name="descripcion" placeholder="Escriba una descripci&oacute;n del juego"></textarea>';
    echo '</li>';
    echo '<li>';
    echo '<label>Informaci&oacute;n PEGI:</label><input type="text" name="edad" required/>';
    echo '</li>';
    echo '<li>';
    echo '<label>Empresa:</label><input type="text" name="empresa" placeholder="Nintendo" required/>';
    echo '</li>';
    echo '<li>';
    echo '<label>Año:</label><input type="date" name="anyo" placeholder="dd-mm-yyyy" required/>';
    echo '<button class="submit" type="submit" name="enviarAdd" value="Enviar">Añadir</button>';
    echo '</li>';
    echo '</ul>';
    echo '</form>';
}

function muestraformSearch() {
    echo '<form action="#" method="POST" class="formulario">';
    echo '<ul>';
    echo '<li>';
    echo '<h2>Buscar juego</h2>';
    echo '</li>';
    echo '<li>';
    echo '<label>Buscar por nombre:</label><input type="text" name="buscar" required>';
    echo '<button class="submit" type="submit" name="enviarSearch" value="Buscar">Buscar</button>';
    echo '</li>';
    echo '</ul>';
    echo '</form>';
}

function mostrarSearch() {
    $sql = 'SELECT * FROM juego WHERE nombre like "%' . $_POST['buscar'] . '%";';
    $result = consultaSelect($sql);

    if (mysql_num_rows($result) == 0) {
        echo '<h2>No hay ningun juego para esa busqueda</h2>';
        muestraIndexJuegos();
    } else {
        echo '<form method="POST" action="#">';
        echo '<h3>Seleccione el juego:</h3>';
        echo '<table class="tabla">';
        while ($row = mysql_fetch_array($result)) {
            echo '<tr>';
            echo '<td><input type="radio" name="radioSearch" value="' . $row['id'] . '" checked/></td>';
            echo '<td>' . $row['nombre'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '<input type="submit" value="Enviar" name="enviarSearchBuscado" />';
        echo '</form>';
    }
}

function mostrarSearchModify() {
    $sql = 'SELECT * FROM juego WHERE nombre like "%' . $_POST['buscar'] . '%";';
    $result = consultaSelect($sql);
    if (mysql_num_rows($result) == 0) {
        echo '<h2>No hay ningun juego para esa busqueda</h2>';
        muestraIndexJuegos();
    } else {
        echo '<h3>Selecciones el juego a modificar:</h3>';
        echo '<form method="POST" action="#">';
        echo '<table class="tabla">';
        while ($row = mysql_fetch_array($result)) {
            echo '<tr>';
            echo '<td><input type="radio" name="radioSearch" value="' . $row['id'] . '" checked /></td>';
            echo '<td>' . $row['nombre'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '<input type="submit" value="Enviar" name="enviarSearchModifed" />';
        echo '</form>';
    }
}

function mostrarSearchRemove() {
    $sql = 'SELECT * FROM juego WHERE nombre like "%' . $_POST['buscar'] . '%";';
    $result = consultaSelect($sql);
    if (mysql_num_rows($result) == 0) {
        echo '<h2>No hay ningun juego para esa busqueda</h2>';
        muestraIndexJuegos();
    } else {
        echo '<h3>Seleccione el juego a eliminar:</h3>';
        echo '<form method="POST" action="#">';
        echo '<table class="tabla">';
        while ($row = mysql_fetch_array($result)) {
            echo '<tr>';
            echo '<td><input type="radio" name="radioSearch" value="' . $row['id'] . '" checked /></td>';
            echo '<td>' . $row['nombre'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '<input type="submit" value="Enviar" name="enviarSearchRemoved" />';
        echo '</form>';
    }
}

function muestraformSearchModify() {
    echo '<form action="#" method="POST" class="formulario">';
    echo '<ul>';
    echo '<li>';
    echo '<h2>Buscar juego a modificar</h2>';
    echo '</li>';
    echo '<li>';
    echo '<label>Buscar por nombre:</label><input type="text" name="buscar" required>';
    echo '<button class="submit" type="submit" name="enviarSearchModify" value="Buscar">Buscar</button>';
    echo '</li>';
    echo '</ul>';
    echo '</form>';
}

function muestraformSearchRemove() {
    echo '<form action="#" method="POST" class="formulario">';
    echo '<ul>';
    echo '<li>';
    echo '<h2>Buscar juego a eliminar</h2>';
    echo '</li>';
    echo '<li>';
    echo '<label>Buscar por nombre:</label><input type="text" name="buscar" required>';
    echo '<button class="submit" type="submit" name="enviarSearchRemove" value="Buscar">Buscar</button>';
    echo '</li>';
    echo '</ul>';
    echo '</form>';
}

function mostrarModifyJuego() {
    $sql = 'SELECT * FROM juego WHERE id like ' . $_POST['radioSearch'];
    $result = consultaSelect($sql);
    $row = mysql_fetch_array($result);
    $_SESSION['idJuegoModificar'] = $row['id'];
    echo '<h3>Modifique el juego:</h3>';
    echo '<form method="POST" action="#">';
    echo '<table class="tabla">';
    echo '<tr><td>Nombre:</td><td><input type="text" value="' . $row['nombre'] . '" name="nombre" /></td></tr>';
    echo '<tr><td>Descripci&oacute;n:</td><td><textarea rows="4" cols="50" name="descripcion">' . $row['descripcion'] . '</textarea></td></tr>';
    echo '<tr><td>Informaci&oacute;n PEGI:</td><td><input type="text" value="' . $row['edad'] . '" name="edad" /></td></tr>';
    echo '<tr><td>Empresa:</td><td><input type="text" value="' . $row['empresa'] . '" name="empresa" /></td></tr>';
    echo '<tr><td>Año:</td><td><input type="date" name="anyo" value="' . $row['anyo'] . '" /></td></tr>';
    echo '</table>';
    echo '<input type="submit" value="Enviar" name="enviarJuegoModify" />';
    echo '</form>';
}

function guardarJuegoModify() {
    $filtros = Array(
        'nombre' => FILTER_SANITIZE_STRING,
        'descripcion' => FILTER_SANITIZE_STRING,
        'empresa' => FILTER_SANITIZE_STRING,
        'edad' => FILTER_SANITIZE_STRING
    );
    $result = filter_input_array(INPUT_POST, $filtros);
    $expresion = "/[a-zA-Z ]/";

    $result['descripcion'] = saveSaltoLinea($result, 'descripcion');
    //VALIDAMOS
    if (!isset($_POST['anyo']) || !preg_match('/^\d{1,2}\-\d{1,2}\-\d{4}$/', $_POST['anyo'])) {
        $errores[] = 'Indique la fecha estilo: dd-mm-aaaa (Use firefox)';
    }
    if (!isset($result['edad']) || !preg_match('/^[[:digit:]]/', $_POST['edad'])) {
        $errores[] = 'Indique la edad minimas';
    }
    if (!isset($result['nombre']) || !preg_match('/^[[:alnum:]]/', $result['nombre'])) {
        $errores[] = 'Indique un nombre correctamente';
    }
    if (!isset($result['descripcion']) || !preg_match($expresion, $result['descripcion'])) {
        $errores[] = 'Indique una descripcion correctamente';
    }
    if (!isset($result['empresa']) || !preg_match($expresion, $result['empresa'])) {
        $errores[] = 'Indique una empresa correctamente';
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

        $sql = 'UPDATE `juego` SET `nombre`="' . $result["nombre"] . '",`descripcion`="' . $result["descripcion"] . '",`edad`="' . $result["edad"] . '",`empresa`="' . $result["empresa"] . '",`anyo`="' . fechaToBD($_POST["anyo"]) . '" WHERE id like ' . $_SESSION['idJuegoModificar'];
        consultaInsert($sql);
        muestraIndexJuegos();
    }
}

function eliminarJuego() {
    $sql = 'DELETE FROM `juego` WHERE id like ' . $_SESSION['idEliminarJuego'];
    consultaInsert($sql);
    muestraIndexJuegos();
}

function saveSaltoLinea($result, $param) {
    $textarea = $result[$param];
    return $result[$param] = str_replace("\n", "<br>", $textarea);
}

function comprobarAdd() {
    $filtros = Array(
        'nombre' => FILTER_SANITIZE_STRING,
        'descripcion' => FILTER_SANITIZE_STRING,
        'empresa' => FILTER_SANITIZE_STRING,
        'edad' => FILTER_SANITIZE_STRING
    );
    $result = filter_input_array(INPUT_POST, $filtros);
    $expresion = "/[a-zA-Z ]/";

    $result['descripcion'] = saveSaltoLinea($result, 'descripcion');
    //VALIDAMOS
    if (!isset($_POST['anyo']) || !preg_match('/^\d{1,2}\-\d{1,2}\-\d{4}$/', $_POST['anyo'])) {
        $errores[] = 'Indique la fecha estilo: dd-mm-aaaa (Use firefox)';
    }
    if (!isset($result['edad']) || !preg_match('/^[[:digit:]]/', $_POST['edad'])) {
        $errores[] = 'Indique la edad minimas';
    }
    if (!isset($result['nombre']) || !preg_match('/^[[:alnum:]]/', $result['nombre'])) {
        $errores[] = 'Indique un nombre correctamente';
    }
    if (!isset($result['descripcion']) || !preg_match($expresion, $result['descripcion'])) {
        $errores[] = 'Indique una descripcion correctamente';
    }
    if (!isset($result['empresa']) || !preg_match($expresion, $result['empresa'])) {
        $errores[] = 'Indique una empresa correctamente';
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
        $sql = 'INSERT INTO `juego`(`id`, `nombre`, `descripcion`, `edad`, `empresa`, `anyo`) '
                . 'VALUES (NULL,"' . $result["nombre"] . '","' . $result["descripcion"] . '",' . $result["edad"] . ',"' . $result["empresa"] . '","' . fechaToBD($_POST['anyo']) . '")';
        consultaInsert($sql);
        muestraIndexJuegos();
    }
}
?>
<section id="content">
    <?php
    if (isset($_POST['enviarAdd'])) {
        comprobarAdd();
    } else if (isset($_POST['enviarSearch'])) {
        mostrarSearch();
    } else if (isset($_POST['enviarSearchBuscado'])) {
        mostrarInformacionJuego();
    } else if (isset($_POST['enviarSearchModify'])) {
        mostrarSearchModify();
    } else if (isset($_POST['enviarSearchModifed'])) {
        mostrarModifyJuego();
    } else if (isset($_POST['enviarJuegoModify'])) {
        guardarJuegoModify();
    } else if (isset($_POST['enviarSearchRemove'])) {
        mostrarSearchRemove();
    } else if (isset($_POST['enviarSearchRemoved'])) {
        mostrarInformacionJuegoRemove();
    } else if (isset($_POST['enviarJuegoRemove'])) {
        eliminarJuego();
    } else {
        if (isset($_GET["s"])) {
            switch ($_GET["s"]) {
                case "add":
                    muestraformInsert();
                    break;
                case "delete":
                    if ($_SESSION['admin'] == TRUE) {
                    muestraformSearchRemove();
                    } else {
                        muestraIndexJuegos();
                    }
                    break;
                case "search":
                    muestraformSearch();
                    break;
                case "modify":
                    if ($_SESSION['admin'] == TRUE) {
                    muestraformSearchModify();
                    } else {
                        muestraIndexJuegos();
                    }
                    break;
                default :
                    muestraIndexJuegos();
                    break;
            }
        } else if (isset($_GET['id'])) {
            mostrarInformacionJuegoId($_GET['id']);
        } else {
            muestraIndexJuegos();
        }
    }
    ?> 
</section>
<?php
include 'pie.php';
