<?PHP
session_start();
//inicializamos la sesión amigo a false para que únicamente se muestre las publicaciones personales.
$_SESSION['amigo'] = FALSE;
require_once './publicaciones.php';
?>


