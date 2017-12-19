<div class = "ebooks">
    <?php
    session_start();
    if (isset($_SESSION['user']) and ( $_SESSION['tipo'] == 'admin')) {
        $dir = $_POST['dir'];
        $arch = $_POST['arch'];
        $borra = $dir . $arch;
        if (!unlink($borra)) {
            echo "<p class='center'>No se ha podido eliminar el ebook seleccionado. Por favor, int&eacute;ntelo de nuevo m&aacute;s tarde. </p>";
        } else {
            header("Location: ebooks.php");
        }
    } else {
        echo "<p class='center'>Debe ser administrador para acceder al contenido de esta p&aacute;gina.</p>";
    }
    ?>
</div>