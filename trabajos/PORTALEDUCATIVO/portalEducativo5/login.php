<?php
include './htmlToBody.php';
if (!isset($_POST['']))
    
    ?>
<div class='content'>
    <form action="checkLogin.php" method="post">
        <fieldset>
            <legend>Login</legend>
            <label>Email:</label><br /><input type="text" name="email" required="required" value="<?php if (isset($_COOKIE['username'])) {
    echo $_COOKIE['username'];
} ?>" /><br /><br />
            <label>Contrase&ntilde;a:</label><br /><input type="password" name="password" required="required" /><br /><br />
            <input type="submit" name="submitLogin" value="Enviar" />
            <input type="reset" name="resetLogin" value="Cancelar"/>
        </fieldset>
    </form>
</div>
<?php
include './bodyToHtml.php';
