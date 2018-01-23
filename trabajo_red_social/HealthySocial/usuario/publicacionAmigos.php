<?PHP
session_start();
//inicializamos la sesión amigo para que únicamente se muestre las publicaciones de los amigos.
$_SESSION['amigo'] = TRUE;
require_once './publicaciones.php';
?>