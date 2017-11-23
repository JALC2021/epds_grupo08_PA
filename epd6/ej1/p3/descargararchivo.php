<?php

$nombre=$_GET['nombre'];
$enlace ="articulos/$nombre";
$nombreArticulo=explode(',',$nombre);
header ("Content-Disposition: attachment; filename='$nombreArticulo[1]'");
header ("Content-Type: application/pdf");
readfile($enlace);
//}
?>

