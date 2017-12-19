<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <?php
    session_start();
    ?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
    <head>
        <title>TodoLetras - Publicar Mensaje</title>
        <?php
        include('./includes/cabecera.php');
        ?>
    </head>
    <body>
        <div class="container">
            <?php
            include('./includes/header.php');
            include('./includes/nav.php');
            ?>

            <div class="publicar-mensaje">
                <?php
                if ($_SESSION['tipo'] == "admin") {

                    // Si se recibió el campo "mensaje" por el método POST desde formulario de inserción de un nuevo mensaje...
                    if (isset($_POST['noticia']) && isset($_POST['titulo'])) {

                        // Si se escribió algo en el cuadro de texto multilínea del formulario... (si no está vacío)...
                        if ($_POST['noticia'] != "" || $_POST['titulo']) {
                            // Datos generales para la aplicación web:
                            include("includes/conexion.php");
                            $tabla2 = "noticias";

                            $fechahora_actual_formatoMySQL = date("Y-m-d H:i:s"); // FORMATO DE FECHA-HORA DE MYSQL: Año-Mes-Día horas:minutos:segundos
                            // Por comodidad...
                            $idnot = "null"; // Será null, al ser un campo auto_increment, que se rellenará automáticamente. Se pone sin comillas simples en el INSERT INTO.			
                            $titulo = $_POST['titulo']; // El usuario ya lo tenemos en la variable de sesión $_SESSION['usuario'].
                            $fechahora = $fechahora_actual_formatoMySQL; // La fecha y hora actuales en formato de MySQL.		
                            $noticia = $_POST['noticia']; // El mensaje lo recibimos del formulario por el método POST.
                            // Instrucción SQL que inserta un nuevo registro en la tabla.
                            $sql = "INSERT INTO $tabla2 VALUES ($idnot,'$titulo','$fechahora','$noticia');";

                            $resultado = mysql_query($sql, $conexion);
                            // Si no pudo realizarse la operación...
                            if (!$resultado) {
                                echo "<p class='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br>Disculpen las molestias.</p>";
                            } else {
                                echo "<p class='center'><strong>CORRECTO:</strong> Noticia creada satisfactoriamente con fecha/hora: $fechahora.</p>";
                            }
                            mysql_close($conexion);
                        } else {
                            echo "<p class='center'><strong>ERROR:</strong> Debe de indicar todos los campos</p>";
                        }
                    } // if (isset($_POST['mensaje']))
                    else {
                        echo "<p class='center'><strong>ERROR:</strong> Necesita insertar los datos en el formulario previamente.</p>";
                    }
                    // Como el usuario es administrador o es usuario registrado, le podremos un enlace directo para insertar un nuevo mensaje.
                    echo "<p class='center'><a href='agregarnoticia.php'>Volver a agregar una nueva noticia</a></p>";
                }
                else {
                    echo "<p class='center'><strong>ERROR: Acceso restringido. &Uacute;nicamente los administradores pueden acceder a esta p&aacute;gina.</p>";
                }
                ?>
                <p class='center'><a href='administracion.php'>Volver a opciones</a></p>
            </div>                
            <?php
            include('./includes/novedades.php');
            include('./includes/aside.php');
            include('./includes/footer.php');
            ?> 
        </div>
    </body>
</html>