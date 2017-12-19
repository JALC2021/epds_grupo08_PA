<?php
session_start();
unset($_SESSION['rol']);
session_destroy();
$variables = session_get_cookie_params();
setcookie(session_name(),0,1,$variables["path"]);

header("Location: index.php");
?>