<?php

if (isset($_POST['teacherEmail'])) {
    deleteTeacher($_POST['teacherEmail']);
    echo "<script type='text/javascript'>alert('Profesor borrado con éxito');</script>";
} else if (isset($_GET['added'])) {
    echo "<script type='text/javascript'>alert('Profesor añadido con éxito');</script>";
}
?>

<h2>A&ntilde;adir profesor</h2>
<?php
if (!isset($_POST['submitRegister'])) {
    ?>
    <form action="#" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>A&ntilde;adir profesor</legend>
            <label>Nombre:</label><br /><input type="text" name="firstName" required="required" placeholder="Obligatorio" /><br /><br />
            <label>Apellidos:</label><br /><input type="text" name="lastName" required="required" placeholder="Obligatorio" /><br /><br />
            <label>Email:</label><br /><input type="text" name="email" required="required" placeholder="Obligatorio" /><br /><br />
            <label>Contrase&ntilde;a:</label><br /><input type="password" name="password" required="required" placeholder="Obligatorio" /><br /><br />
            <label>Administrador:</label>
            <select name="admin">
                <option value="Y">Si</option>
                <option value="N">No</option>
            </select><br /><br />
            <input type="submit" name="submitRegister" value="Enviar" />
        </fieldset>
    </form>

    <?php
} else {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $admin = $_POST['admin'];
    
    if ($admin == "Y") {
        $admin2 = true;
    } else {
        $admin2 = false;
    }

    if (createTeacher($firstName, $lastName, $password, $email, $admin2)) {
        header("Location: administrationView.php?section=profesores&added=true");
        exit;
    }
}
?>
<hr>
<h2>Eliminar profesor</h2>

<form action="./administrationView.php?section=profesores" method="POST">
    <select name="teacherEmail">
        <?php
        $teachers = getAllTeachers();

        for ($i = 0; $i < count($teachers); $i++) {
            echo '<option value="' . $teachers[$i]['email'] . '">' . $teachers[$i]['firstName'] . ' ' . $teachers[$i]['lastName'] . '</option>';
        }
        ?>
    </select>
    <input type="submit" value="Borrar profesor">
</form>