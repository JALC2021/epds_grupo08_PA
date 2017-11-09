<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include 'func\funciones.php';
?>
<html lang='es'>
    <head>
        <meta charset="UTF-8">
        <title>P3-EPD5</title>
    </head>
    <body>

        <form action="index.php" method="POST"><br /><br /><br />
            Usuario *: <input type="text" name="loginUsuario"><br /><br />
            Contrase&ntilde;a *: <input type="Password" name="loginContrasenia">
            <input type="submit" name="loginEnvio" value="Enviar">
        </form>
        <?php
        $errores = "";
        if (isset($_POST['loginEnvio']) && filter_has_var(INPUT_POST, 'loginEnvio')) {

            if (isset($_POST['loginUsuario']) && $_POST['loginUsuario'] != "" && filter_has_var(INPUT_POST, 'loginUsuario')) { // Usuario
                $loginUsuario = filter_input(INPUT_POST, 'loginUsuario', FILTER_SANITIZE_STRING);
            } else {
                $loginUsuario = "";
                $errores .= '<p>Error. No ha introducido un usuario en el campo correspondiente</p>';
            }
            if (isset($_POST['loginContrasenia']) && $_POST['loginContrasenia'] != "" && filter_has_var(INPUT_POST, 'loginContrasenia')) { // Contraseña
                $loginContrasenia = filter_input(INPUT_POST, 'loginContrasenia', FILTER_SANITIZE_STRING);
            } else {
                $loginContrasenia = "";
                $errores .= '<p>Error. No se ha introducido una contraseña en el campo correspondiente</p>';
            }
            if ((strlen($errores)) == "") {//si no hay errores(si no hay campos vacíos) que verifique si existe el usuario en el fichero etc
                if (existenciaUsuario($loginUsuario) == 1) {//el usuario está registrado en la página
                    
                    
                    if (comprobarUsuario($loginUsuario, $loginContrasenia) == 0) {//comprobamos que el usuario y contraseña son correctos
                        echo "El usuario y su contraseña es correcto <br />"; 
                       entradaAlSistema();
                    } else {
                        echo '<p>Error. Las credenciales no son correctas</p>';      //si las credenciales no son correctas, muestro error
                    }
                } else {                         //si el usuario no existe en el fichero, muestro el formulario de registro
                    echo '<p>No se encuentra dado de alta. Reg&iacute;strese por favor.</p>';
                    ?>
                    <form action ="" method="POST">
                        Nombre*: <input type="text" name="registroNombre"><br /><br />
                        Contrase&ntilde;a*: <input type="password" name="registroContrasenia" required><br /><br />
                        Email*: <input type="email" name="email"><br /><br />
                        Seleccione universidad*: 
                        <select name="registroUniversidad" >
                            <option value="US">Universidad de Sevilla</option>
                            <option value="UM">Universidad de Malaga</option>
                            <option value="UG">Universidad de Granada</option>
                            <option value="UC">Universidad de C&aacute;diz</option>
                            <option value="UH">Universidad de Huelva</option>
                            <option value="UJ">Universidad de Jaen</option>
                            <option value="UC">Universidad de C&oacute;rdoba</option>
                            <option value="UA">Universidad de Almer&iacute;a</option>
                            <option value="UPO">Universidad Pablo de Olavide</option>
                            <option value="UIA">Universidad Internacional de Andaluc&iacute;a</option>

                        </select>
                        <input type="submit" name="registroEnvio" value="Enviar">
                    </form>
                    <?php
                }
            } else {
                echo $errores;
            }
        }


        $errors = "";
        if (isset($_POST['registroEnvio']) && filter_has_var(INPUT_POST, 'registroEnvio')) {
            if (isset($_POST['registroNombre']) && $_POST['registroNombre'] != "" && filter_has_var(INPUT_POST, 'registroNombre')) { // Usuario
                $registroUsuario = filter_input(INPUT_POST, 'registroNombre', FILTER_SANITIZE_STRING);
            } else {
                $registroUsuario = "";
                $errors .= '<p>Error. El campo Nombre est&aacute; vac&iacute;o</p>';
            }if (isset($_POST['registroContrasenia']) && filter_has_var(INPUT_POST, 'registroContrasenia')) { //Contraseña
                $registroContrasenia = filter_input(INPUT_POST, 'registroContrasenia', FILTER_SANITIZE_STRING);
            } else {
                $errors .= '<p>Error. El campo contrase&ntilde;a est&aacute; vac&iacute;o</p>';
            } if (isset($_POST['email']) && $_POST['email'] != "" && filter_has_var(INPUT_POST, 'email')) { //Email
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            } else {
                $errors .= '<p>Error. El campo email est&aacute; vac&iacute;o</p>';
            }
            if (isset($_POST['registroUniversidad']) && $_POST['registroUniversidad'] != "" && filter_has_var(INPUT_POST, 'registroUniversidad')) {
                $registroUniversidad = filter_input(INPUT_POST, 'registroUniversidad', FILTER_SANITIZE_STRING);
            } else {
                $errors .= '<p>Error. Debe seleccionar una Universidad de la lista</p>';
            }
        

            if ((strlen($errors)) == "") {
                
                if(existenciaUsuario($registroUsuario)==0){ //si el usuario no existe
                    aniadirUsuario($registroUsuario, $registroContrasenia, $email, $registroUniversidad);//escribo usuario en fichero usuarios
                    entradaAlSistema($registroUsuario,$registroUniversidad);
                    
                    
                }else{//si el nombre de usuario ya existe en el fichero
                    echo 'El usuario introducido no es v&aacute;lido. Introduzca un usuario diferente por favor';
                }
                                                        
            } else {
                echo $errors;
            }
        }
        ?>
       
       
    </body>
</html>
