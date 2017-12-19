<div class="donar">
    <?php
    if (isset($_SESSION['user']) && $_SESSION['tipo'] != 'admin') {
        ?>

        <div class='mi-cuenta-opc'>
            <h2>Donar un ebook</h2>
            <img src='imagenes/ebook.png' class='mi-cuenta-img'/>
            <p class='center'>Donando un ebook, podr&aacute; acceder a cierto contenido privilegiado de la web. Suba sus libros y podr&aacute; descargarse los libros del resto de nuestros usuarios. &iexcl;Empiece ahora!</p>
            <form action="#" method="post" enctype="multipart/form-data" onsubmit="return validar()">					
                <p align='center'><input type="file" name="file" id="file" class="input-button" onchange="validarFichero(this)"/><br/><br/>
                    <input type="submit" name="subir" value='Subir archivo' class="input-button"/></p>
            </form>
        </div>                   
        <p class="center"><a href='micuenta.php'>Volver a mi cuenta</a></p>
        <?php
        if (isset($_POST['subir']) && $_POST['subir'] != "") {
            if ($_FILES['file']['type'] == "application/pdf") {
                $estructura = "ebooks/" . $_SESSION['user'];
                if (!is_dir($estructura)) {
                    if (!mkdir($estructura, 0777, true)) {
                        echo "<p class='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br>Disculpen las molestias.</p>";
                    }
                }
                $resultado = copy($_FILES['file']['tmp_name'], $estructura . '/' . $_FILES['file']['name']);
                if (!$resultado) {
                    echo "<p class='center'>Estamos teniendo problemas con nuestro sistema de datos. Por favor, intentelo de nuevo mas tarde.<br>Disculpen las molestias.</p>";
                } else {
                    $ficheroname = $_FILES['file']['name'];
                    include("includes/actualizarusuario.php");
                    mysql_close($conexion);
                    header("Location: misebooks.php");
                }
            }
        }
    } else if ($_SESSION['tipo'] == 'admin') {
        echo "<p class='center'>Debe crearse un usuario autor para subir libros</p>";
        echo "<p class='center'><a href='micuenta.php'>Volver a mi cuenta</a></p>";
    } else {
        echo "<p class='center'>No ha iniciado sesion<br><a href='iniciarsesion.php'>Iniciar Sesion</a></p";
    }
    ?>
</div>