<?php
include 'consultasSql.php';
include 'seguridad.php';
$_SESSION['currentPage'] = 'registro';
include 'cabecera.php';
include 'navegador.php';
//include 'menu.php';
?>
<script type="text/javascript">
    function validar() {
        var user = document.getElementById("user");
        var pass = document.getElementById("password");
        var confpass = document.getElementById("confpassword");
        var email = document.getElementById("email");

        var errorRegistro = document.getElementById("errorRegistro");
        errorRegistro.innerHTML = '';
        
        var RegExPatternPassword = /[a-zA-Z0-9]$/;
        var RegExPatternEmail = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

        if (user.value === '' || pass.value === '' || confpass.value === '' || email.value === '') {
            errorRegistro.innerHTML = '<h3>Falta algun campo</h3>';
            return false;
        } else if (!RegExPatternPassword.test(pass.value)){
            errorRegistro.innerHTML = '<h3>Contrase&ntilde;a no es segura</h3>';
            return false;
        } else if (pass.value !== confpass.value) {
            errorRegistro.innerHTML = '<h3>Las contrase&ntilde;as no coinciden</h3>';
            return false;
        } else if(!RegExPatternEmail.test(email.value)){
            errorRegistro.innerHTML = '<h3>Necesitamos un correo v&aacute;lido</h3>';
            return false;
        } else {
            return true;
        }
    }
</script>
<section id="content" class="login">
    <div id="divForm" class="formLogin">
        <form id="form" name="form" method="post" action="registroIn.php" onsubmit="return validar()">
            <ul>
                <li>
                    <h1>Registro</h1>
                </li>
                <li>
                <label>Usuario</label>
                <input type="text" name="user" id="user" placeholder="usuario" required/>
                </li>
                <li>
                <label>Contrase&ntilde;a</label>
                <input type="password" name="password" id="password" placeholder="password" required />
                <label class="tipocontrasenya">N&uacute;meros y letras (mayusculas y minusculas)</label>
                <div style="clear:both;"></div>
                </li>
                
                <li>
                <label>Confirmar Contrase&ntilde;a</label>
                <input type="password" name="confpassword" id="confpassword" placeholder="password" required/>   
                </li>
                <li>
                <label>E-Mail</label>
                <input type="email" name="email" id="email" placeholder="sucorreo@gmail.com" required/>
                <button class="submit" type="submit" value="Registrar" name="enviarRegistro">Registrar</button>
                </li>
                <li>
                <label class="error" id="errorRegistro"></label>
                </li>
                <?php
                if (isset($_SESSION['errorRegistro']) && $_SESSION['errorRegistro'] == TRUE) {
                    echo '<label class="error id="errorLogin"><h3>El usuario ya est&aacute; registrado</h3></label>';
                    $_SESSION['errorRegistro'] = FALSE;
                }
                ?>
            </ul>
        </form>
    </div>
</section>
<?php
include 'pie.php';
?>

