<?php

//comprueba que el usuario está registrado en la página, es decir, existe en el fichero su usuario
function existenciaUsuario($usuario) {
    $correcto = 0; //si vale 0 el usuario no existe

    $archivo = fopen('users.txt', 'r');
    if ($archivo) {
        while (!feof($archivo)) {
            $linea = fgets($archivo);
            $linea = explode(';', $linea);
            for ($i = 0; $i < sizeof($linea); $i++) {
                if ($i == 0) {
                    if (strcmp($linea[$i], $usuario) == 0) {
                        $correcto = 1;
                    }
                }
            }
        }
        fclose($archivo);
        return $correcto;
    } else {
        echo 'Error.No se ha podido acceder al archivo que contiene la informaci&oacute;n<br />';
    }
}

//comprueba si las credenciales del usuario son correctas
function comprobarUsuario($usuario, $contrasenia) {
    $correcto = 0; //si vale 0 es que el usuario y su contraseña son correctos
    $archivo = fopen('users.txt', 'r');
    if ($archivo) {
        while (!feof($archivo)) {
            $linea = fgets($archivo);
            $linea = explode(';', $linea);
            for ($i = 0; $i < sizeof($linea); $i++) {
                if ($i == 0) {

                    if (strcmp($linea[$i], $usuario) == 0 && strcmp($linea[$i + 1], $contrasenia) !== 0) {
                        $correcto = 1;
                       
                    }
                }
            }
        }fclose($archivo);
        return $correcto;
    } else {
        echo 'Error.No se ha podido acceder al archivo que contiene la informaci&oacute;n<br />';
    }
}

//añade un usuario al fichero de usuarios
function aniadirUsuario($nombreUsuario, $contrasenia, $email, $universidad) {
    $correcto = 0; //si el usuario se añade correctamente 

    $archivo = fopen('users.txt', 'a');
    if ($archivo) {
        $datosUsuario = $nombreUsuario . ';' . $contrasenia . ';' . $email . ';' . $universidad . "\n";

        if (fwrite($archivo, $datosUsuario) == false) {
            echo 'Error. No se ha podido escribir el usuario en el fichero';
        } else {
            $correcto = 1;
        }

        fclose($archivo);
    } else {
        echo 'Error.No se ha podido acceder al archivo que contiene la informaci&oacute;n<br />';
    }
    return $correcto;
}

// Comprueba si el usuario ya ha subido una imagen con el mismo hash
function comprobarHash($nombreUsuario, $hash) { 
    $correct = 0;
    $archivo = fopen("articulos.csv", "r");
    if ($archivo) {
        while (!feof($archivo)) {
            $linea = fgets($archivo);
            $linea = explode(";", $linea);
            foreach ($linea as $clave => $valor) {
                if ($clave == 2) {
                    $usuario = $valor;
                }
                if ($clave == 3) {
                    $hash2 = $valor;
                    $hash2 = eregi_replace("[\n|\r|\n\r]", "", $hash2); // Quitamos el salto de linea de la cadena hash del fichero csv
                }
            }
            if (isset($usuario) && isset($hash2)) {
                if (($nombreUsuario == $usuario) && ($hash == $hash2)) {
                    $correct = 1;
                }
            }
        }
        fclose($archivo);
        return $correct;
    } else {
        echo "<p>Error, no hay acceso al fichero que contiene toda la informaci&#243;n</p>";
    }
}

//guarda el fichero subido por el usuario
function guardarFichero($nombreArticulo,$descripcion,$nombreusuario,$universidad,$hash) {
    $cargaCorrecta=0;
    $f = fopen("articulos.csv", 'a');
    if ($f) {
        flock($f, LOCK_EX);
        $datos=$nombreArticulo.';'.time().';'.$descripcion.';'.$nombreusuario.';'.$universidad.','.$hash."\n";
        fwrite($f,$datos);
        flock($f, LOCK_UN);
        fclose($f);
        move_uploaded_file($_FILES['articulo']['tmp_name'],'articulos.csv' );
        $cargaCorrecta=1;
        
    } else {
        echo 'Error. No se ha podido escribir en el archivo';
    }
    return $cargaCorrecta;
}

//muestra el formulario que permite subir un artículo con su descripción, lo procesa, controla el tamaño y el formato, y
//si estos son correctos, lo guarda
function entradaAlSistema($nombreUsuario,$registroUniversidad) {
    echo '<form method="post" enctype="multipart/form-data">';
    echo ' Adjunte el art&iacute;culo: <input type="file" name="articulo"><br /><br />';
    echo ' <textarea name="txt" cols="50" rows="10" placeholder="Introduzca una descripci&oacute;n del art&iacute;culo"></textarea>';
    echo ' <input type="submit" name="envioArticulos" value="Enviar">';

    echo ' </form>';

    $todoCorrecto = 1;
    if (isset($_POST['envioArticulos']) && filter_has_var(INPUT_POST, "envioArticulos")) {


        if (isset($_POST['txt']) && $_POST ['txt'] != "" && filter_has_var(INPUT_POST, "txt")) {
            $txt = filter_input(INPUT_POST, "txt", FILTER_SANITIZE_STRING);
            if (isset($_FILES['articulo'])) {
                if ($_FILES['articulo']['error'] > 0) {
                    echo "Error en el env&iacute;o";
                    $todoCorrecto = 0;
                } else {
                    $nombreArticulo = $_FILES['articulo']['name'];
                    $tipoArticulo = $_FILES['articulo']['type'];
                    $tamanioArticulo = $_FILES['articulo']['size'];
                    $temporalArticulo = $_FILES['articulo']['tmp_name'];
                    $hash = md5_file($_FILES['articulo']['tmp_name']);
                    if (!strpos($tipoAriticulo, "pdf")) {
                        echo 'Error. El art&iacute;culo debe tener formato PDF';
                        $correcto = 0;
                    } if (strpos($tamanioAriticulo > 5242880)) {
                        echo 'Error. El tama&ntilde;o del art&iacute;culo no puede superar 5Mb ';
                        $correcto = 0;
                    }if(comprobarHash($nombreUsuario, $hash)==0){
                         if ((guardarFichero($nombreArticulo, $_POST['txt'],$nombreUsuario,$nombreUsuario,$registroUniversidad,$hash))==1) {
                            echo "El archivo ha sido cargado correctamente";
                         } else {
                             echo "Ocurrió algún error al subir el fichero. No pudo guardarse";
                        }
                    }
                }
            }
        }
    }
    return $todoCorrecto;
}
?>