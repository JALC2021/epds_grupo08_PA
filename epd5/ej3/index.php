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
        if (isset($_POST['enviar']) && preg_match("/^[[:upper:]]/", $_POST['nombre']) && preg_match("/^[[:upper:]]/", $_POST['apellidos'])
                && preg_match("/^@[[:alpha:]]*/", $_POST['twitter']) && preg_match("/^9[[:digit:]]{8}/", $_POST['telefono'])
                 && preg_match("/^6[[:digit:]]{8}/", $_POST['movil'])) {
            echo "<table class=formulario> <b>Datos del Formulario:</b>";
            echo "<tr><td>" . 'Nombre: '  .filter_var($_POST['nombre'], FILTER_SANITIZE_STRING). "</td></tr>";
            echo "<tr><td>" . 'Apellidos: ' . filter_var($_POST['apellidos'], FILTER_SANITIZE_STRING). "</td></tr>";
            echo "<tr><td>" . 'Email: ' . filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) . "</td></tr>";
            echo "<tr><td>" . 'Twitter: ' . filter_var($_POST['twitter'], FILTER_SANITIZE_STRING) . "</td></tr>";
            echo "<tr><td>" . 'Teléfono: ' . filter_var($_POST['telefono'], FILTER_SANITIZE_NUMBER_INT). "</td></tr>";
            echo "<tr><td>" . 'M&oacute;vil: ' . filter_var($_POST['movil'], FILTER_SANITIZE_NUMBER_INT) . "</td></tr>";
            echo "<tr><td>" . 'Provincia: ' . $_POST['provincia'] . "</td></tr>";
            echo "<tr><td>" . 'Descripci&oacute;n: ' . filter_var($_POST['descripcion'], FILTER_SANITIZE_STRING) . "</td></tr>";
            echo "</table>";
        } else {
            ?>
            <header><h1>EPD5-EJ2-Grupo8</h1></header>
            <article>
                <section>
                    <table>

                        <p><b>Introduzca los datos:</b></p>

                        <form action="." method="POST">
                            <?PHP
                            if(isset($_POST['nombre'])){
                                if(!preg_match("/^[[:upper:]]/", $_POST['nombre'])){
                                    ?>
                            <tr><td>Nombre:</td><td> <input style="background-color: #f84c4c" type="text" name="nombre" required autofocus><strong>*  El nombre debe comenzar por mayúscula. Ej.: Gonzalo</strong></td></tr>
                            
                            <?PHP
                                }else{
                                    ?>
                                    <tr><td>Nombre:</td><td> <input type="text" name="nombre" required autofocus> <strong>*</strong></td></tr>
                                    <?PHP
                                }
                            }else{
                            ?>
                            <tr><td>Nombre:</td><td> <input type="text" name="nombre" required autofocus> <strong>*</strong></td></tr>
                            <?PHP
                            } 
                            if(isset($_POST['apellidos'])){
                                if(!preg_match("/^[[:upper:]]/", $_POST['apellidos'])){
                                    ?>
                            <tr><td>Apellidos: </td><td><input style="background-color: #f84c4c" type="text" name="apellidos" required ><strong>* El apellido debe comenzar por mayúscula. Ej.: Fernández</strong></td></tr>
                            
                            <?PHP
                                }else{
                                    ?>
                                    <tr><td>Apellidos: </td><td><input type="text" name="apellidos" required ><strong>*</strong></td></tr>
                                    <?PHP
                                }
                            }else{
                            ?>
                            <tr><td>Apellidos: </td><td><input type="text" name="apellidos" required ><strong>*</strong></td></tr>

                            <?PHP
                            } 
                            ?>
                            
                            <tr><td>Email:</td><td> <input type="email" name="email" required ><strong>*</strong></td></tr>

                           <?PHP 
                            if(isset($_POST['twitter'])){
                                if(!preg_match("/^@[[:alpha:]]*/", $_POST['twitter'])){
                                    ?>
                            <tr><td>Twitter:</td><td> <input style="background-color: #f84c4c" type="text" name="twitter" placeholder="@..." required ><strong>* El twitter debe comenzar por @. Ej.: @Sevilla</strong></td> </tr>
                            
                            <?PHP
                                }else{
                                    ?>
                                    <tr><td>Twitter:</td><td> <input type="text" name="twitter" placeholder="@..." required ><strong>*</strong></td> </tr>
                                    <?PHP
                                }
                            }else{
                            ?>
                                    <tr><td>Twitter:</td><td> <input type="text" name="twitter" placeholder="@..." required ><strong>*</strong></td> </tr>
                            
                            <?PHP
                                
                            }
                            
                            if(isset($_POST['telefono'])){
                                if(!preg_match("/^9[[:digit:]]{8}/", $_POST['telefono'])){
                            ?>
                            <tr><td>Teléfono: </td><td><input style="background-color: #f84c4c" type="tel" name="telefono" required ><strong>* El tel&eacute;fono debe comenzar por 9 y tener 9 dígitos. Ej.: 958653214</strong></td> </tr>
                            <?PHP
                                }else{
                                    ?>
                                    <tr><td>Teléfono: </td><td><input type="tel" name="telefono" required ><strong>*</strong></td> </tr>
                                    <?PHP
                                }
                            }else{
                            ?>
                            <tr><td>Teléfono: </td><td><input type="tel" name="telefono" required ><strong>*</strong></td> </tr>
                             
                            <?PHP
                                }
                                
                                if(isset($_POST['movil'])){
                                if(!preg_match("/^6[[:digit:]]{8}/", $_POST['movil'])){
                                ?>
                            
                            <tr><td>M&oacute;vil:</td><td> <input style="background-color: #f84c4c" type="tel" name="movil" required ><strong>* El m&oacute;vil debe comenzar por 9 y tener 9 dígitos. Ej.: 958653214</strong></td> </tr> 
                            
                            <?PHP
                                }else{
                                    ?>
                                    <tr><td>M&oacute;vil:</td><td> <input type="tel" name="movil" required ><strong>*</strong></td> </tr> 
                                    <?PHP
                                }
                            }else{
                            ?>
                            <tr><td>M&oacute;vil:</td><td> <input type="tel" name="movil" required ><strong>*</strong></td> </tr> 
                            <?PHP
                                }
                                ?>
                            
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


                            <tr><td>Descripci&oacute;n ruta:</td><td> <textarea name="descripcion" maxlength="200" placeholder="Escriba aqui..." required></textarea><strong>*</strong> </td> </tr>

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
