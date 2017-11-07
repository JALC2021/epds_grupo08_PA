<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>EPD5-EJ2-Grupo8</title>
        <link rel="stylesheet" type="text/css" href="estilo.css" />
    </head>
    <body>
        <?php
        if (isset($_POST['enviar'])) {
            echo "<ol>";
            echo "<li>" . 'Nombre: ' . $_POST['nombre'] . "</li>";
            echo "<li>" . 'Apellidos: ' . $_POST['apellidos'] . "</li>";
            echo "<li>" . 'Email: ' . $_POST['email'] . "</li>";
            echo "<li>" . 'Twitter: ' . $_POST['twitter'] . "</li>";
            echo "<li>" . 'Teléfono: ' . $_POST['telefono'] . "</li>";
            echo "<li>" . 'M&oacute;vil:: ' . $_POST['movil'] . "</li>";
            echo "<li>" . 'Provincia: ' . $_POST['provincia'] . "</li>";
            echo "<li>" . 'Descripci&oacute;n: ' . $_POST['descripcion'] . "</li>";
            echo "</ol>";
        } else {
            ?>
            <header><h1>EPD5-EJ2-Grupo8</h1></header>
            <article>
                <section>
                    <table>

                        <p><b>Introduzca los datos:</b></p>

                        <form action="." method="POST">
                            <tr><td>Nombre:</td><td> <input type="text" name="nombre" required autofocus> <strong>*</strong></td></tr>

                            <tr><td>Apellidos: </td><td><input type="text" name="apellidos" required ><strong>*</strong></td></tr>

                            <tr><td>Email:</td><td> <input type="email" name="email" required ><strong>*</strong></td></tr>

                            <tr><td>Twitter:</td><td> <input type="text" name="twitter" required ><strong>*</strong></td> </tr>

                            <tr><td>Teléfono: </td><td><input type="tel" name="telefono" required ><strong>*</strong></td> </tr>

                            <tr><td>M&oacute;vil:</td><td> <input type="tel" name="movil" required ><strong>*</strong></td> </tr>  

                            <tr><td>Provincia: </td><td>
                                    <select name="provincia" required>
                                        <option value="sevilla" selected>Sevilla</option>
                                        <option value="almeria">Almer&iacute;a</option>
                                        <option value="granada">Granada</option>
                                        <option value="jaen">Ja&eacute;n</option>
                                        <option value="huelva">Huelva</option>
                                        <option value="malaga">M&aacute;laga</option>
                                        <option value="cordoba">C&oacute;rdoba</option>
                                        <option value="cadiz">C&aacute;diz</option>
                                    </select><strong>*</strong></td>


                            <tr><td>Descripci&oacute;n ruta:</td><td> <textarea name="descripcion" maxlength="200" required></textarea><strong>*</strong> </td> </tr>

                            <tr><td><input type="submit" name="enviar" value="Enviar"></td></tr>
                            <strong>(*) Todos los campos son requeridos</strong>

                        </form>
                    </table>
                </section>
            </article>
            <footer><h2>Realizado por el Grupo 8: Susana | Juan | Gonzalo</h2></footer>
            <?PHP
        }
        ?>
    </body>
</html>
