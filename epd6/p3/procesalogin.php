<?php
session_start();
include 'funciones\conexion.php';

$errores = "";
$res = FALSE;
$enc = FALSE;



if (isset($_POST['loginEnvio']) && filter_has_var(INPUT_POST, 'loginEnvio')) {

    if (isset($_POST['loginUsuario']) && $_POST['loginUsuario'] != "" && filter_has_var(INPUT_POST, 'loginUsuario')) {
        $loginUsuario = filter_input(INPUT_POST, 'loginUsuario', FILTER_SANITIZE_STRING);
    } else {
        $loginUsuario = "";
        $errores .= '<p>Error. No ha introducido un usuario en el campo correspondiente</p>';
    }
    if (isset($_POST['loginContrasenia']) && $_POST['loginContrasenia'] != "" && filter_has_var(INPUT_POST, 'loginContrasenia')) {
        $loginContrasenia = md5(filter_input(INPUT_POST, 'loginContrasenia', FILTER_SANITIZE_STRING)); //necesitamos ocultar la contraseña en el login, porque cuando verifique si esta corresponde al usuario introducido, sino está oculta, la comparará con la que está oculta en base de datos, y no será igual
    } else {
        $loginContrasenia = "";
        $errores .= '<p>Error. No se ha introducido una contrase&ntilde;a en el campo correspondiente</p>';
    }
    if ((strlen($errores)) == 0) {//si no hay errores de validación
        //Comprobar usuario en BD
        $query = "SELECT * FROM usuarios";
        $resultado = mysqli_query($conexion, $query);

        while ($row = mysqli_fetch_array($resultado)) {
            if ($row['nom_usuario'] == $loginUsuario) {
                $res = true;
            }
        }

        if (!$res) { //si el conjunto de $resultado es falso..
            //Se avisa que no existe ese usuario 
            echo "No existe el usuario introducido. Por favor, reg&iacute;strese";
            //Se muestra formulario Registro
            ?>
            <form action="procesaregistro.php" method="POST">
                <p><label>Usuario (*):</label><input type="text" name="registroUsuario"></p>
                <p><label>Contrase&ntilde;a (*):</label> <input type="password" name="registroContrasenia"></p>
                <p><label>eMail (*):</label><input type="text" name="registroEmail"></p>
                <p><label> Universidad (*):</label>
                    <select name="registroUniversidad">
                        <option value="US">Universidad de Sevilla</option>
                        <option value="UM">Universidad de Malaga</option>
                        <option value="UG">Universidad de Granada</option>
                        <option value="UCA">Universidad de C&aacute;diz</option>
                        <option value="UH">Universidad de Huelva</option>
                        <option value="UJ">Universidad de Jaen</option>
                        <option value="UC">Universidad de C&oacute;rdoba</option>
                        <option value="UA">Universidad de Almer&iacute;a</option>
                        <option value="UPO">Universidad Pablo de Olavide</option>
                        <option value="UIA">Universidad Internacional de Andaluc&iacute;a</option>
                    </select> </p>


                <p><input type="submit" name="registroEnvio" value="Registrarse"></p>
            </form>
            <?php
        } else { //si el num de filas es superior a 0 (igual a 1)...
            //Comprobar usuario y contraseña
            //Primero seleccionamos la clave del usuario
            $query_usuario = "SELECT clave FROM usuarios WHERE nom_usuario = '$loginUsuario'";
            $resultado_usuario = mysqli_query($conexion, $query_usuario);

            while ($row = mysqli_fetch_array($resultado_usuario)) {
                if ($row['clave'] == $loginContrasenia) {

                    if (!isset($_SESSION["loginUsuario"])) {
                        $_SESSION["loginUsuario"] = $loginUsuario;
                    } else {
                        $_SESSION["loginUsuario"] = $loginUsuario;
                    }

                    $nom_usuario = $_SESSION["loginUsuario"];
                    echo "<h1>Bienvenido/a $nom_usuario</h1>";

                    $consulta = "SELECT * FROM usuarios";
                    $resultado_universidad = mysqli_query($conexion, $consulta);
                    mysqli_close($conexion);
                    while ($row = mysqli_fetch_array($resultado_universidad)) {
                        if ($row['nom_usuario'] == $nom_usuario) {
                            $_SESSION['universidad'] = $row['universidad'];

                            $enc = TRUE;
                        }
                    }
                    if (!$enc) {
                        echo 'Error. No se ha podido encontrar la universidad porque no existe tal usuario en la Base de datos';
                    }
                    ?>
                    <p>Utilice el buscador para encontrar uno o varios art&iacute;culos de su inter&eacute;s<br />
                        o el men&uacute; desplegable para visualizar todos los art&iacute;culos de la universidad que desee</p>

                    <form action="procesabusquedas.php" method="POST">
                        <input type="search" name="busquedaPalabra" placeholder="Introduzca una palabra">

                        <label> Universidad:</label>
                        <select name="busquedaUniversidad">
                            <option value="">Seleccione una universidad</option>
                            <option value="US">Universidad de Sevilla</option>
                            <option value="UM">Universidad de Malaga</option>
                            <option value="UG">Universidad de Granada</option>
                            <option value="UCA">Universidad de C&aacute;diz</option>
                            <option value="UH">Universidad de Huelva</option>
                            <option value="UJ">Universidad de Jaen</option>
                            <option value="UC">Universidad de C&oacute;rdoba</option>
                            <option value="UA">Universidad de Almer&iacute;a</option>
                            <option value="UPO">Universidad Pablo de Olavide</option>
                            <option value="UIA">Universidad Internacional de Andaluc&iacute;a</option>
                        </select>
                        <p><input type="submit" name="busquedaEnvio" value="Buscar"></p>
                    </form>


                    <?php
                    //se muestran los artículos subidos por el usuario
                    echo '<p>Sus art&iacute;culos cargados en el sistema:</p>';

                    if ($directorio = opendir('C:\xampp\htdocs\p3Epd5\articulos')) {


                        while (false !== ($archivo = readdir($directorio))) {

                            $arraylinea = explode(",", $archivo);
                            if ($arraylinea[0] == $_SESSION['loginUsuario']) {

                                echo "<a href='descargararchivo.php/?nombre=$archivo'>$arraylinea[1]</a><br />";
                            }
                        }
                    }
                    ?>

                    <form action="procesaadjuntos.php" method="post" enctype="multipart/form-data">
                        <p> <label>Subir art&iacute;culo:</label></p>
                        <p><input type="file" name="articulo"></p>
                        <p><textarea cols="60" rows="10" name="textarea" placeholder="Escriba aqu&iacute; la descripci&oacute;n de su art&iacute;culo"></textarea></p>
                        <input type="submit" name="envio" value="Enviar">
                    </form><br /><br />




                    <?php
                } else {

                    echo 'Usuario y/o contraseña incorrectos. Vuelva a introducir sus credenciales por favor<br /><br />';
                    require_once 'index.php';
                }
            }
        }
    }

    if (!isset($_POST['loginEnvio']) || strlen($errores) > 0) { //si hay errores
        if (strlen($errores) > 0) {
            echo '<h1>Se han producido los siguientes errores:</h1>';
            echo $errores;
        }
    }
    ?>

    <form action="procesacerrarsesion.php" method="post" >
        <input type="submit" name="salir" value="Cerrar sesi&oacute;n">
    </form>
    <?php }
?>



