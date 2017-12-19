<?php

$profile = readStudentById($_SESSION['userid']);

echo '<div class="content">';
echo "<h1>Datos personales</h1>";
echo "<p><b>Nombre:</b> " . $profile['firstName'] . "</p>";
echo "<p><b>Apellidos:</b> " . $profile['lastName'] . "</p>";
echo "<p><b>DNI:</b> " . $profile['dni'] . "</p>";
echo "<p><b>Email:</b> " . $profile['email'] . "</p>";
echo '<p><b>Imagen:</b> <img src="img/' . $profile['image'] . '" alt="Imagen" height="50"></p>';
echo "</div>";