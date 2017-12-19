<div class="publicar-mensaje">
    <?php
    if ($_SESSION['tipo'] == "admin" || $_SESSION['tipo'] == "user" || $_SESSION['tipo'] == "autor") {

        if (isset($_POST['mensaje'])) {

            // Si se escribió algo en el cuadro de texto multilínea del formulario... (si no está vacío)...
            if ($_POST['mensaje'] != "") {
                // Datos generales para la aplicación web:
                include("includes/conexion.php");
                $tabla2 = "mensajes";

                // Obtendremos la fecha y hora actuales según el servidor, con la función date:
                $fechahora_actual = date("d/m/Y H:i:s"); // FORMATO DE FECHA-HORA HABITUAL: Día/Mes/Año horas:minutos:segundos
                $fechahora_actual_formatoMySQL = date("Y-m-d H:i:s"); // FORMATO DE FECHA-HORA DE MYSQL: Año-Mes-Día horas:minutos:segundos
                // Por comodidad...
                $idmensa = "null"; // Será null, al ser un campo auto_increment, que se rellenará automáticamente. Se pone sin comillas simples en el INSERT INTO.			
                $usuario = $_SESSION['user']; // El usuario ya lo tenemos en la variable de sesión $_SESSION['usuario'].
                $fechahora = $fechahora_actual_formatoMySQL; // La fecha y hora actuales en formato de MySQL.		
                $mensaje = $_POST['mensaje']; // El mensaje lo recibimos del formulario por el método POST.
                // Instrucción SQL que inserta un nuevo registro en la tabla.
                $sql = "INSERT INTO $tabla2 VALUES ($idmensa,'$usuario','$fechahora','$mensaje');";

                $resultado = mysql_query($sql, $conexion);
                // Si no pudo realizarse la operación...
                if (!$resultado) {
                    echo "<p align='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br>Disculpen las molestias.</p>";
                } else {
                    echo "<p class='center'><strong>CORRECTO:</strong> Mensaje creado satisfactoriamente con fecha/hora:<strong> $fechahora_actual</strong></p>";
                }
                mysql_close($conexion);
            } else {
                echo "<p class='center'><strong>ERROR:</strong> Necesita tener algo escrito en el mensaje para poder insertarlo.</p>";
            }
        } // if (isset($_POST['mensaje']))
        else {
            echo "<p class='center'><strong>ERROR:</strong> Necesita insertar los datos en el formulario previamente.</p>";
        }
        // Como el usuario es administrador o es usuario registrado, le podremos un enlace directo para insertar un nuevo mensaje.
        echo "<p class='center'><a href='publicarmensaje.php'>Volver a publicar un mensaje nuevo</a></p>";
    } // if($_SESSION['tipo']=="admin" || $_SESSION['tipo']=="usuario")
    else {
        echo "<p class='center'><strong>ERROR:</strong> Acceso restringido. &Uacute;nicamente los administradores y los usuarios registrados pueden acceder a esta p&aacute;gina.</p>";
    }
    ?>
    <p class='center'><a href='comunidad.php'>Volver al Foro</a></p>
</div> 