<?php
include './htmlToBody.php';
if(!isset($_POST['']))
?>
<form action="#" method="post">
    <fieldset>
        <legend>Login</legend>
        <label>Email:</label><input type="text" name="email" required="required" /><br /><br />
        <label>Contrase&ntilde;a:</label><br /><input type="password" name="password" required="required" /><br /><br />
        <input type="submit" name="submitLogin" value="Enviar" />
    </fieldset>
</form>