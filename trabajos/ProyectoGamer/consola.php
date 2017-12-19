<?php
include 'consultasSql.php';
include 'seguridad.php';
$_SESSION['currentPage'] = 'consola';
$seccion = "consola";
include 'cabecera.php';
include 'navegador.php';

function muestraIndexConsola() {
    echo '<div class="articulos">';
    echo '<h3>CONSOLAS</h3>';
    $sql = "SELECT id, nombre, descripcion, especificaciones, empresa, anyo FROM consola ORDER BY anyo DESC LIMIT 6";
    $result = consultaSelect($sql);
    while ($row = mysql_fetch_array($result)) {
        echo '<div class="articulolleno">';
        echo '<h3 class="titulo"><strong><a href="?id=' . $row['id'] . '">' . $row['nombre'] . '</a></strong><span class="etiq"></span></h3>';
        echo '<p class="texto">' . substr($row['descripcion'], 0, 100) . '<br /><br /><a href="consola.php?id=' . $row['id'] . '" class="more"> Leer más...</a></p>';
        echo '<p class="fecha">Date: ' . $row['anyo'] . '</p>';
        echo '</div>';
    }
    echo '</div>';
}

function mostrarInformacionConsolaId($id) {
    $sql = 'SELECT * FROM consola WHERE id like "' . $id . '"';
    $result = consultaSelect($sql);
    if (mysql_num_rows($result) == 0) {
        echo '<h3>No existe la consola</h3>';
    } else {
        $row = mysql_fetch_array($result);
        echo '<div>';
        echo '<table class="tabla">';
        echo '<tr><td>Nombre:</td><td>' . $row['nombre'] . '</td></tr>';
        echo '<tr><td>Descripcion:</td><td>' . $row['descripcion'] . '</td></tr>';
        echo '<tr><td>Especificaciones:</td><td>' . $row['especificaciones'] . '</td></tr>';
        echo '<tr><td>Empresa:</td><td>' . $row['empresa'] . '</td></tr>';
        echo '<tr><td>Año:</td><td>' . $row['anyo'] . '</td></tr>';
        echo '</table>';
        echo '</div>';
    }
}

function muestraformInsert() {
    echo '<form action="#" method="POST" class="formulario">';
    echo '<ul>';
    echo '<li>';
    echo '<h2>Agregar consola</h2>';
    echo '</li>';
    echo '<li>';
    echo '<label>Nombre: </label><input type="text" name="nombre" placeholder="PlayStation 4" required />';
    echo '</li>';
    echo '<li>';
    echo '<label>Descripci&oacute;n: </label>'
    . '<textarea rows="4" cols="50" name="descripcion" placeholder="Escriba una descripci&oacute;n de la consola" required></textarea>';
    echo '</li>';
    echo '<li>';
    echo '<label>Especificaciones</label>'
    . '<textarea rows="4" cols="50" name="especificaciones" placeholder="Escriba especificaciones de la consola"></textarea>';
    echo '</li>';
    echo '<li>';
    echo '<label>Empresa</label><input type="text" name="empresa" placeholder="SONY" required />';
    echo '</li>';
    echo '<li>';
    echo '<label>Año de Fabricaci&oacute;n</label><input type="date" name="anyo" required />';
    echo '<button class="submit" type="submit" name="enviarAdd" value="Enviar">Añadir</button>';
    echo '</li>';
    echo '</ul>';
    echo '</form>';
}

function muestraformSearch() {
    echo '<form action="#" method="POST" class="formulario">';
    echo '<ul>';
    echo '<li>';
    echo '<h2>Buscar consola</h2>';
    echo '</li>';
    echo '<li>';
    echo '<label>Buscar por nombre:</label><input type="text" name="buscar" required>';
    echo '<button class="submit" type="submit" name="enviarSearch" value="Buscar">Buscar</button>';
    echo '</li>';
    echo '</ul>';
    echo '</form>';
}

function mostrarInformacionConsola() {
    $sql = 'SELECT * FROM consola WHERE id like ' . $_POST['radioSearch'];
    $result = consultaSelect($sql);
    $row = mysql_fetch_array($result);
    echo '<div>';
    echo '<table class="tabla">';
    echo '<tr><td>Nombre:</td><td>' . $row['nombre'] . '</td></tr>';
    echo '<tr><td>Descripci&oacute;n:</td><td>' . $row['descripcion'] . '</td></tr>';
    echo '<tr><td>Especifiaciones:</td><td>' . $row['especificaciones'] . '</td></tr>';
    echo '<tr><td>Empresa:</td><td>' . $row['empresa'] . '</td></tr>';
    echo '<tr><td>Año:</td><td>' . $row['anyo'] . '</td></tr>';
    echo '</table>';
    echo '</div>';
}

function saveSaltoLinea($result, $param) {
    $textarea = $result[$param];
    return $result[$param] = str_replace("\n", "<br>", $textarea);
}

function muestraformSearchRemove() {
    echo '<form action="#" method="POST" class="formulario">';
    echo '<ul>';
    echo '<li>';
    echo '<h2>Buscar consola para eliminar</h2>';
    echo '</li>';
    echo '<li>';
    echo '<label>Buscar por nombre:</label><input type="text" name="buscar" required>';
    echo '<button class="submit" type="submit" name="enviarSearchRemove" value="Buscar">Buscar</button>';
    echo '</li>';
    echo '</ul>';
    echo '</form>';
}

function mostrarInformacionConsolaRemove() {
    $sql = 'SELECT * FROM consola WHERE id like ' . $_POST['radioSearch'];
    $result = consultaSelect($sql);
    $row = mysql_fetch_array($result);
    $_SESSION['idEliminarConsola'] = $row['id'];
    echo '<table class="tabla">';
    echo '<tr><td>Nombre:</td><td>' . $row['nombre'] . '</td></tr>';
    echo '<tr><td>Descripci&oacute;n:</td><td>' . $row['descripcion'] . '</td></tr>';
    echo '<tr><td>Especificaciones:</td><td>' . $row['especificaciones'] . '</td></tr>';
    echo '<tr><td>Empresa:</td><td>' . $row['empresa'] . '</td></tr>';
    echo '<tr><td>Año:</td><td>' . $row['anyo'] . '</td></tr>';
    echo '</table>';
    echo '<form action="#" method="POST">';
    echo '<button class="submit" type="submit" value="Borrar" name="enviarConsolaRemove">Borrar</button>';
    echo '</form>';
}

function eliminarConsola() {
    $sql = 'DELETE FROM `consola` WHERE id like ' . $_SESSION['idEliminarConsola'];
    consultaInsert($sql);
    muestraIndexConsola();
}

function muestraformSearchModify() {
    echo '<form action="#" method="POST" class="formulario">';
    echo '<ul>';
    echo '<li>';
    echo '<h2>Buscar consola para modificar</h2>';
    echo '</li>';
    echo '<li>';
    echo '<label>Buscar por nombre:</label><input type="text" name="buscar" required>';
    echo '<button class="submit" type="submit" name="enviarSearchModify" value="Buscar">Buscar</button>';
    echo '</li>';
    echo '</ul>';
    echo '</form>';
}

function mostrarModifyConsola() {
    $sql = 'SELECT * FROM consola WHERE id like ' . $_POST['radioSearch'];
    $result = consultaSelect($sql);
    $row = mysql_fetch_array($result);
    $_SESSION['idConsolaModificar'] = $row['id'];
    echo '<form method="POST" action="#">';
    echo '<table class="tabla">';
    echo '<tr><td>Nombre:</td><td><input type="text" value="' . $row['nombre'] . '" name="nombre" /></td></tr>';
    echo '<tr><td>Descripci&oacute;n:</td><td><textarea rows="4" cols="50" name="descripcion">' . $row['descripcion'] . '</textarea></td></tr>';
    echo '<tr><td>Especificaciones:</td><td><textarea rows="4" cols="50" name="especificaciones">' . $row['especificaciones'] . '</textarea></td></tr>';
    echo '<tr><td>Empresa:</td><td><input type="text" value="' . $row['empresa'] . '" name="empresa" /></td></tr>';
    echo '<tr><td>Año:</td><td><input type="date" name="anyo" value="' . $row['anyo'] . '" /></td></tr>';
    echo '</table>';
    echo '<button type="submit" value="Enviar" name="enviarConsolaModify">Enviar</button>';
    echo '</form>';
}

function guardarConsolaModify() {
    $filtros = Array(
        'nombre' => FILTER_SANITIZE_STRING,
        'descripcion' => FILTER_SANITIZE_STRING,
        'empresa' => FILTER_SANITIZE_STRING,
        'especificaciones' => FILTER_SANITIZE_STRING
    );
    $result = filter_input_array(INPUT_POST, $filtros);
    $expresion = "/[a-zA-Z ]/";

    $result['descripcion'] = saveSaltoLinea($result, 'descripcion');
    //VALIDAMOS
    if (!isset($_POST['anyo']) || !preg_match('/^\d{1,2}\-\d{1,2}\-\d{4}$/', $_POST['anyo'])) {
        $errores[] = 'Indique la fecha estilo: dd-mm-aaaa (Use firefox)';
    }
    if (!isset($result['especificaciones']) || !preg_match('/^[[:alnum:]]/', $_POST['especificaciones'])) {
        $errores[] = 'Indique las especificaciones minimas';
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
        $sql = 'UPDATE `consola` SET `nombre`="' . $result["nombre"] . '",`descripcion`="' . $result["descripcion"] . '",`especificaciones`="' . $result["especificaciones"] . '",`empresa`="' . $result["empresa"] . '",`anyo`="' . fechaToBD($_POST["anyo"]) . '" WHERE id like ' . $_SESSION['idConsolaModificar'];
        consultaInsert($sql);
        muestraIndexConsola();
    }
}
?>


<section id="content">
    <?php
    if (isset($_POST['enviarAdd'])) {
        $filtros = Array(
            'nombre' => FILTER_SANITIZE_STRING,
            'descripcion' => FILTER_SANITIZE_STRING,
            'especificaciones' => FILTER_SANITIZE_STRING,
            'empresa' => FILTER_SANITIZE_STRING
        );
        $result = filter_input_array(INPUT_POST, $filtros);
        $expresion = "/[a-zA-Z ]/";

        $result['descripcion'] = saveSaltoLinea($result, 'descripcion');
        $result['especificaciones'] = saveSaltoLinea($result, 'especificaciones');
        //VALIDAMOS
        if (!isset($_POST['anyo']) || !preg_match('/^\d{1,2}\-\d{1,2}\-\d{4}$/', $_POST['anyo'])) {
            $errores[] = 'Indique la fecha estilo: dd-mm-aaaa';
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
        } else { //CREA EL SQL
            $sql = "INSERT INTO `consola`(`nombre`, `descripcion`, `especificaciones`, `empresa`, `anyo`)"
                    . 'VALUES ("' . $result["nombre"] . '","' . $result["descripcion"] . '","' . $result["especificaciones"] . '","' . $result["empresa"] . '","' . fechaToBD($_POST["anyo"]) . '")';
            consultaInsert($sql);
            muestraIndexConsola();
        }
    } else if (isset($_POST['enviarSearch'])) {
        $sql = 'SELECT * FROM consola WHERE nombre like "%' . $_POST['buscar'] . '%";';
        $result = consultaSelect($sql);

        if (mysql_num_rows($result) == 0) {
            echo '<h2>No hay ninguna consola para esa busqueda</h2>';
            muestraIndexConsola();
        } else {
            echo '<form method="POST" action="#">';
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
    } else if (isset($_POST['enviarSearchBuscado'])) {
        mostrarInformacionConsola();
    } else if (isset($_POST['enviarSearchRemove'])) {
        $sql = 'SELECT * FROM consola WHERE nombre like "%' . $_POST['buscar'] . '%";';
        $result = consultaSelect($sql);

        if (mysql_num_rows($result) == 0) {
            echo '<h2>No hay ninguna consola para esa busqueda</h2>';
            muestraIndexConsola();
        } else {
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
    } else if (isset($_POST['enviarSearchRemoved'])) {
        mostrarInformacionConsolaRemove();
    } else if (isset($_POST['enviarConsolaRemove'])) {
        eliminarConsola();
    } else if (isset($_POST['enviarSearchModify'])) {
        $sql = 'SELECT * FROM consola WHERE nombre like "%' . $_POST['buscar'] . '%";';
        $result = consultaSelect($sql);

        if (mysql_num_rows($result) == 0) {
            echo '<h2>No hay ninguna consola para esa busqueda</h2>';
            muestraIndexConsola();
        } else {
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
    } else if (isset($_POST['enviarSearchModifed'])) {
        mostrarModifyConsola();
    } else if (isset($_POST['enviarConsolaModify'])) {
        guardarConsolaModify();
    } else {
        if (isset($_GET['s'])) {
            switch ($_GET["s"]) {
                case "add":
                    muestraformInsert();
                    break;
                case "delete":
                    if ($_SESSION['admin'] == TRUE) {
                        muestraformSearchRemove();
                    } else {
                        muestraIndexConsola();
                    }
                    break;
                case "search":
                    muestraformSearch();
                    break;
                case "modify";
                    if ($_SESSION['admin'] == TRUE) {
                    muestraformSearchModify();
                    } else {
                        muestraIndexConsola();
                    }
                    break;
                default :
                    muestraIndexConsola();
            }
        } else if (isset($_GET['id'])) {
            mostrarInformacionConsolaId($_GET['id']);
        } else {
            muestraIndexConsola();
        }
    }
    ?>
</section>
<?php
include 'pie.php';
