<div class='admin'>
<?php
	if(isset($_SESSION['user']) and $_SESSION['tipo']=='admin'){
	echo "<div class='mi-cuenta-opc'>";
        echo "<h2>MEN&Uacute; DE OPCIONES:</h2>";
        echo "<img src='imagenes/admin.png' class='mi-cuenta-img'/>";
	echo "<ul><li><h4><a href='borrarusuario.php'>Borrar usuario(s)</a></h4></li>";
	echo "<li><h4><a href='agregarlibro.php'>A&ntilde;adir libro</a></h4></li>";
	echo "<li><h4><a href='borrarlibro.php'>Borrar libro(s)</a></h4></li>";
        echo "<li><h4><a href='agregarnoticia.php'>Insertar noticia</a></h4></li></ul></div>";
	}
	else{
            echo "<p class='center'>Este contenido solo est&aacute; disponible para usuarios registrados con permisos de administrador."
            . " Si desea o cree que deber&iacute;a tener privilegios de administrador, por favor, p&oacute;ngase en contacto "
            . "con nosotros en el siguiente enlace, lo solucionaremos lo antes posible.</p>"
            . "<p align='center'><a href='mailto:info@todoletras.comuv.com'>info@todoletras.comuv.com</a></p>";
	}
?>
</div>