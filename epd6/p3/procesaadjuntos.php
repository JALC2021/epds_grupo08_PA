<?php

session_start();

include 'funciones\conexion.php';
include 'funciones\erroresArchivo.php';

//CONSTANTES
define("PASO_CONVERSION", 1024);
define("MB_PERMITIDOS", 5);
define("NUMERO_PASOS_UNIDADES", 2);

$condicionOk = FALSE;

$encontrado = FALSE;
$hash_articulo = "";

if (isset($_POST['envio']) && filter_has_var(INPUT_POST, 'envio')) {

    //if (isset($_FILES['articulo']) && filter_has_var(INPUT_POST,$_FILES['articulo']['name'])) {
    if (isset($_FILES['articulo'])) {

        if ($_FILES['articulo']['error'] > 0) {
            errorFichero($_FILES['articulo']['error']);
        } else {                              //si no hay errores al subir el artículo
            if ($_FILES['articulo']['type'] == 'application/pdf') { //comprobamos el formato del artículo
                if ($_FILES['articulo']['size'] <= (MB_PERMITIDOS * (pow(PASO_CONVERSION, NUMERO_PASOS_UNIDADES)))) {    //comprobamos el tamaño del artículo
                    // echo 'Su art&iacute;culo ha sido subido correctamente<br />';
                    //una vez se cumplen las restricciones del archivo, podemos recogerlo y calcular su hash
                    //   $nom_articulo= filter_input(INPUT_POST,$_FILES['articulo']['name'],FILTER_SANITIZE_STRING);
                    // $nom_articulo = $_FILES['articulo']['name']; //se guarda el nombre original
                    // $arrayNombre = explode('.', $nom_articulo);
                    // $nomSinExtension = $arrayNombre[0];       //se guarda el nombre sin la extensión
                    //echo "lo que se recoge de articulo es: $nom_articulo y el nom sin extension es: $nomSinExtension<br />";
                    $hash_articulo = md5_file($_FILES['articulo']['tmp_name']); //se calcula el hash del artículo
                    //echo "El hash del articulo es: $hash_articulo";
                    // consultamos los hash de los articulos del usuario para que no onroduzca otra artículo con el mismo contenido
                    $consulta = "SELECT hash_articulo FROM articulos";
                    $resultado = mysqli_query($conexion, $consulta);
                    while (!$encontrado && $fila = mysqli_fetch_array($resultado)) {
                        //echo 'entro en while hash';
                        if (strcmp($fila['hash_articulo'], $hash_articulo) == 0) {
                            $encontrado = TRUE;
                            // echo '<br />entro en if hash';
                        }
                    }
                    if ($encontrado == TRUE) {
                        echo '<p>Error. No se permite subir el at&iacute;culo porque ya existe un archivo con ese contenido</p>';
                    } else { //si no hay ningún artículo con el mismo contenido en la base de datos, se carga este en la misma
                        // echo '<br />nom_usuario cogido de session es:' . $_SESSION['loginUsuario'].' y la universidad cogida de session es: '.$_SESSION['universidad'];
//                        $nom_usuario=$_SESSION['loginUsuario'];
//                        $universidad=$_SESSION['universidad'];
//                        $hora_desubida = time();
                        $condicionOk = TRUE;
//                        $query = "INSERT INTO `articulos`(`nom_articulo`, `hora_desubida`, `descripcion_articulo`, `nom_usuario`, `universidad`, `hash_articulo`) VALUES ('$nom_articulo','$hora_desubida','$descripcion_articulo','$nom_usuario','$universidad',$hash_articulo)";
//                        $result = mysqli_query($conexion, $query);
//
//                        if (!$result) {
//                            echo 'Error. El art&iacute;culo no se ha podido añadir a la Base de datos';
//                        } else {
//                            echo 'Art&iacuate;culo añadido a la Base de datos satisfactoriamente.';
//                        }
                    }
                } 
            } else {                                  //si el formato no es correcto..
                echo 'S&oacute;lo se admiten art&iacute;culos con formato PDF';
            }
        }
    } else {
        echo 'Debe seleccionar un art&iacute;culo';
    }
    if (isset($_POST['textarea']) && $_POST['textarea'] != "" && filter_has_var(INPUT_POST, 'textarea')) {
        $descripcion_articulo = "";
        $descripcion_articulo = filter_input(INPUT_POST, 'textarea', FILTER_SANITIZE_STRING);
        $descripcion_articulo=mysqli_real_escape_string($conexion,$descripcion_articulo);

        if ($condicionOk) {
            
            $nombre_articulo = $_FILES['articulo']['name'];

            $nom_articulo=mysqli_real_escape_string($conexion,$nombre_articulo);
             
            $nom_usuario =mysqli_real_escape_string($conexion,$_SESSION['loginUsuario']);
            $universidad =mysqli_real_escape_string($conexion,$_SESSION['universidad']);
            $marca_tiempo = time();

            $query = "INSERT INTO `articulos`(`nom_articulo`, `marca_tiempo`, `descripcion_articulo`, `nom_usuario`, `universidad`, `hash_articulo`) VALUES ('$nom_articulo','$marca_tiempo','$descripcion_articulo','$nom_usuario','$universidad','$hash_articulo')";
            $result = mysqli_query($conexion, $query);
            mysqli_close($conexion);
            if (!$result) {
                echo '<p>Error. El art&iacute;culo no se ha podido añadir a la Base de datos</p>';
            } else {
                echo '<p>Art&iacute;culo añadido a la Base de datos satisfactoriamente.</p>';
               
                //Se crea el nombre de archivo con el que se va a guardar dicho archivo en un directorio definitivo

                $nombre_archivo = "";
                $nombre_archivo ="$nom_usuario,$nombre_articulo";

                //copiamos los archivos a otra carpeta para poder conservarlos después de la ejecución del proyecto
                $destino = 'C:\xampp\htdocs\p3Epd5\articulos';
                move_uploaded_file($_FILES['articulo']['tmp_name'], "$destino/$nombre_archivo");


            }
            
        }
    } else {
        echo '<p>Error. Debe rellenar la descripci&oacute;n</p>';
    }
}

?>
