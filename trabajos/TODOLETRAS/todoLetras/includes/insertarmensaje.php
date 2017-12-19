<div class="publicar-mensaje">
    <?php
    if ($_SESSION['tipo'] == "admin" || $_SESSION['tipo'] == "user" || $_SESSION['tipo'] == "autor") {
        ?>
        <h4>INSERTE EL MENSAJE A PUBLICAR EN EL FORO:</h4>
        <form method="post" action="confirmacionmensaje.php" onsubmit="return comprobarMensaje()">
            <label>Mensaje:</label><br/>
            <textarea name="mensaje" cols="30" rows="5" id="msg" onchange="validarMensaje(this)"></textarea><br/>
            <input type="submit" name='insertar' value='Insertar Mensaje' class="input-button"/>
        </form>

        <?php
    } else {
        echo "<p class='center'><strong>ERROR:</strong> Acceso restringido. &Uacute;nicamente los administradores y usuarios registrados pueden acceder a esta p&aacute;gina.</p>";
    }
    ?>
    <p class='center'><a href='comunidad.php'>Volver al Foro</a></p>
</div>