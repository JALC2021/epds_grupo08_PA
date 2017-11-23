<?php
function errorFichero($error) { // Muestra de que tipo es el error que se ha dado al subir un fichero
    switch ($error) {
        case 1:
            echo "<p><strong>ERROR: No se admiten archivos que tengan un tama&ntilde;o superior a 5Mb</strong></p>";
            break;
        case 2:
            echo "<p><strong>ERROR: El archivo subido excede la directiva MAX_FILE_SIZE que fue especificada en el formulario HTML</strong></p>";
            break;
        case 3:
            echo "<p><strong>ERROR: El archivo subido fue s&#243;lo parcialmente cargado</strong></p>";
            break;
        case 4:
            echo "<p><strong>ERROR: Ning&#250;n archivo fue subido</strong></p>";
            break;
        case 6:
            echo "<p><strong>ERROR: Falta la carpeta temporal</strong></p>";
            break;
        case 7:
            echo "<p><strong>ERROR: No se pudo escribir el archivo en el disco</strong></p>";
            break;
        case 7:
            echo "<p><strong>ERROR: Una extensi&#243;n de PHP detuvo la carga de archivos</strong></p>";
            break;
        default:
            echo "<p><strong>No se ha subido ning&#250;n fichero</strong></p>";
            break;
    }
}


?>
