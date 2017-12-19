<?php
include 'consultasSql.php';
include 'seguridad.php';
$_SESSION['currentPage'] = 'usuario';
include 'cabecera.php';
include 'navegador.php';

function mostrarUsuarioIndex() {
    $sql = 'SELECT * FROM usuarios WHERE id like ' . $_SESSION['idUser'];
    $result = consultaSelect($sql);
    $row = mysql_fetch_array($result);

    echo '<div>';
    echo '<form class="formulario" action="#" method="POST">';
    echo '<ul>';
    echo '<li>';
    echo '<h2>Panel de Control</h2>';
    echo '</li>';
    echo '<li>';
    echo '<label>Nombre: </label><input type="text" value="' . $row['user'] . '" name="user" required/><br\>';
    echo '</li>';
    echo '<li>';
    echo '<label>Nueva Password: </label><input type="password" name="newPassword" placeholder="No tocar, si no querer cambiar" /><br\>';
    echo '</li>';
    echo '<li>';
    echo '<label>Confirmar nueva password: </label><input type="password" name="newPasswordConf" /><br\>';
    echo '</li>';
    echo '<li>';
    echo '<label>Antigua Password: </label><input type="password" name="oldPassword" /><br\>';
    echo '</li>';
    echo '<li>';
    echo '<label>Email: </label><input type="text" value="' . $row['correo'] . '" name="correo" required/><br\>';
    echo '</li>';
    echo '<li>';
    echo '<button type="submit" name="enviar">Cambiar</button>';
    echo '</li>';
    echo '</ul>';
    echo '</form>';
    echo '</div>';
}

function modificarUsuario() {
    $sql = 'SELECT * FROM usuarios WHERE id like ' . $_SESSION['idUser'];
    $result = consultaSelect($sql);
    $row = mysql_fetch_array($result);

    $filtros = Array(
        'nombre' => FILTER_SANITIZE_STRING,
        'newPassword' => FILTER_SANITIZE_STRING,
        'newPasswordConf' => FILTER_SANITIZE_STRING,
        'oldPassword' => FILTER_SANITIZE_STRING,
        'correo' => FILTER_SANITIZE_STRING
    );

    $result = filter_input_array(INPUT_POST, $filtros);

    if (isset($_POST['newPassword']) AND $_POST['newPassword'] != '' AND isset($_POST['newPasswordConf']) AND $_POST['newPasswordConf'] != '' AND isset($_POST['oldPassword']) AND $_POST['oldPassword'] != '') {
        if ($result['newPassword'] == $result['newPasswordConf']) {
            if ($result['oldPassword'] == $row['password']) {
                $sql = 'UPDATE usuarios SET user = "' . $result['nombre'] . '", password ="' . $result['newPassword'] . '", correo = "' . $result['correo'] . '" WHERE id like ' . $_SESSION['idUser'];
                consultaInsert($sql);
                mostrarUsuarioIndex();
            } else {
                echo '<p>Error en los datos del formulario</p>';
                echo '<p>Por favor vuelva a introducir los datos de nuevo.</p>';
                echo '<p style="color:red">Errores cometidos:</p>';
                echo '<ul style="color:red">';
                echo "<li>La contrase&ntilde;a antigua no coincide</li>";
                echo '</ul>';
                mostrarUsuarioIndex();
            }
        } else {
            echo '<p>Error en los datos del formulario</p>';
            echo '<p>Por favor vuelva a introducir los datos de nuevo.</p>';
            echo '<p style="color:red">Errores cometidos:</p>';
            echo '<ul style="color:red">';
            echo "<li>Las nuevas contrase&ntilde;as no coinciden</li>";
            echo '</ul>';
            mostrarUsuarioIndex();
        }
    } else {
        $sql = 'UPDATE usuarios SET user = "' . $result['nombre'] . '", correo = "' . $result['correo'] . '"';
        consultaInsert($sql);
        mostrarUsuarioIndex();
    }
}
?>
<section id="content">
    <?php
    if (isset($_POST['enviar'])) {
        modificarUsuario();
    } else {
        mostrarUsuarioIndex();
    }
    ?>
</section>
<?php
include 'pie.php';
?>