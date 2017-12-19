<?php

if (isset($_POST['studentDNI'])) {
    deleteStudent($_POST['studentDNI']);
    echo "<script type='text/javascript'>alert('Alumno borrado con éxito');</script>";
} else if (isset($_GET['added'])) {
    echo "<script type='text/javascript'>alert('Alumno añadido con éxito');</script>";
}
?>

<h2>A&ntilde;adir alumno</h2>
<?php
if (!isset($_POST['submitRegister'])) {
    ?>
    <form action="#" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>A&ntilde;adir alumno</legend>
            <label>Nombre:</label><br /><input type="text" name="firstName" required="required" placeholder="Obligatorio" /><br /><br />
            <label>Apellidos:</label><br /><input type="text" name="lastName" required="required" placeholder="Obligatorio" /><br /><br />
            <label>DNI:</label><br /><input type="text" name="dni" required="required" placeholder="Obligatorio" /><br /><br />
            <label>Email:</label><br /><input type="text" name="email" required="required" placeholder="Obligatorio" /><br /><br />
            <label>Contrase&ntilde;a:</label><br /><input type="password" name="password" required="required" placeholder="Obligatorio" /><br /><br />
            <fieldset>
                <legend>Asignaturas (Obligat&oacute;rio)</legend>
                <?php
                $subjects = readSubject();
                for ($i = 0; $i < count($subjects); $i++) {
                    ?><input type="checkbox" name="subjects[]" value="<?php echo $subjects[$i]['name']; ?>" /><?php
                    echo " " . ucfirst($subjects[$i]['name']) . " ";
                    if ($i % 2 != 0) {
                        ?><br /><?php
                    }
                }
                ?>
            </fieldset><br />
            <label>Foto (Obligat&oacute;rio):</label><br /><input type="file" name="image" required="required" /><br /><br />
            <input type="submit" name="submitRegister" value="Enviar" />
        </fieldset>
    </form>

    <?php
} else {
    if ($_FILES['image']['error'] > 0) {
        echo "Error: " . $_FILES['image']['error'];
    } else {
        if ((($_FILES['image']['size'] / 1024) / 1024) > 2) {
            echo "Error: El archivo supera el limita de tamaño permitido.";
        } else if (!isset($_POST['subjects'])) {
            ?>
            <form action="#" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>A&ntilde;adir alumno</legend>
                    <label>Nombre:</label><br /><input type="text" name="firstName" required="required" value="<?php echo $_POST['firstName']; ?>" /><br /><br />
                    <label>Apellidos:</label><br /><input type="text" name="lastName" required="required" value="<?php echo $_POST['lastName']; ?>" /><br /><br />
                    <label>DNI:</label><br /><input type="text" name="dni" required="required" value="<?php echo $_POST['dni']; ?>" /><br /><br />
                    <label>Email:</label><br /><input type="text" name="email" required="required" value="<?php echo $_POST['email']; ?>" /><br /><br />
                    <label>Contrase&ntilde;a:</label><br /><input type="password" name="password" required="required" placeholder="Obligatorio" /><br /><br />
                    <fieldset>
                        <legend>Asignaturas (Obligat&oacute;rio)</legend>
                        <span style="color:red"><strong>Por favor elija al menos una asignatura.</strong></span><br />
                        <?php
                        $subjects = readSubject();
                        for ($i = 0; $i < count($subjects); $i++) {
                            ?><input type="checkbox" name="subjects[]" value="<?php echo $subjects[$i]['name']; ?>" /><?php
                            echo " " . ucfirst($subjects[$i]['name']) . " ";
                            if ($i % 2 != 0) {
                                ?><br /><?php
                            }
                        }
                        ?>
                    </fieldset><br />
                    <label>Foto (Obligat&oacute;rio):</label><br /><input type="file" name="image" required="required" /><br /><br />
                    <input type="submit" name="submit" value="Enviar" />
                </fieldset>
            </form>
            <?php
        } else {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $dni = $_POST['dni'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $imageName = time() . $_FILES['image']['name'];
            $subjectsChoosed = $_POST['subjects'];

            if (createStudent($firstName, $lastName, $dni, $password, $imageName, $email, $subjectsChoosed)) {
                header("Location: administrationView.php?section=alumnos&added=true");
                exit;
            }
        }
    }
}
?>
<hr>
<h2>Eliminar alumno</h2>

<form action="./administrationView.php?section=alumnos" method="POST">
    <select name="studentDNI">
        <?php
        $students = getAllStudents();

        for ($i = 0; $i < count($students); $i++) {
            echo '<option value="' . $students[$i]['dni'] . '">' . $students[$i]['firstName'] . ' ' . $students[$i]['lastName'] . '</p>';
        }
        ?>
    </select>
    <input type="submit" value="Borrar alumno">
</form>