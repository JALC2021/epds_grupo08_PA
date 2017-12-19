<?php
include 'consultasSql.php';
include 'seguridad.php';
$_SESSION['currentPage'] = 'login';
include 'cabecera.php';
include 'navegador.php';
//include 'menu.php';
?>
<script type="text/javascript">
    function validar() {
        var user = document.getElementById("user");
        var pass = document.getElementById("password");
        var error = document.getElementById("errorLogin");
        if (user.value === '' || pass.value === '') {
            error.innerHTML = '<h3>Falta algun campo</h3>';
            return false;
        } else {
            error.innerHTML = '';
            return true;
        }
    }
</script>
<section id="content" class="login">
    <div id="divForm" class="formLogin">
        <form id="form" name="form" method="post" action="loginIn.php" onsubmit="return validar()">
            <ul>
                <li>
                    <h1>Login</h1>
                </li>
                <li>
                    <label>Usuario</label>
                    <input type="text" name="user" id="user" placeholder="usuario" required/>
                </li>
                <li>
                    <label>Contrase&ntilde;a</label>
                    <input type="password" name="password" id="password" placeholder="password" required/>
                    <button class="submit" type="submit" value="Entrar" name="enviarLogin">Entrar</button>
                </li>
            </ul>
            <label class="error" id="errorLogin"></label>
            <?php
            if (isset($_SESSION['errorLogin']) && $_SESSION['errorLogin'] == TRUE) {
                echo '<label class="error id="errorLogin"><h3>Los datos no son correctos</h3></label>';
                $_SESSION['errorLogin'] = FALSE;
            }
            ?>
        </form>
        <form action="recuperar.php" method="POST" class="formLogin">
            <ul>
                <li>
                    <h1>Recuperar contraseña</h1>
                    <button class="submit" type="submit" value="Recuperar" name="enviarRegistro">Recuperar Contrase&ntilde;a</button>
                </li>
            </ul>
        </form>
    </div>
</section>

<?php
include 'pie.php';
?>

