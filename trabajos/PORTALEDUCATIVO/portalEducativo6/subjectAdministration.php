<?php

if (isset($_POST['subjectName'])) {
    deleteSubject($_POST['subjectName']);
    echo "<script type='text/javascript'>alert('Asignatura borrada con éxito');</script>";
} else if (isset($_GET['added'])) {
    echo "<script type='text/javascript'>alert('Asignatura añadida con éxito');</script>";
}
?>

<h2>A&ntilde;adir asignatura</h2>
<?php
if (!isset($_POST['submitRegister'])) {
    ?>
    <form action="#" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>A&ntilde;adir asignatura</legend>
            <label>Nombre:</label><br /><input type="text" name="name" required="required" placeholder="Obligatorio" /><br /><br />
            <label>Descripci&oacute;n:</label><br /><input type="text" name="description" required="required" placeholder="Obligatorio" /><br /><br />
            <select name="teacherId">
                <?php
                $teachers = getAllTeachers();

                for ($i = 0; $i < count($teachers); $i++) {
                    echo '<option value="' . $teachers[$i]['id'] . '">' . $teachers[$i]['firstName'] . ' ' . $teachers[$i]['lastName'] . '</option>';
                }
                ?>
            </select>
            <input type="submit" name="submitRegister" value="Enviar" />
        </fieldset>
    </form>

    <?php
} else {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $teacherId = $_POST['teacherId'];

    if (createSubject($name, $description, $teacherId)) {
        header("Location: administrationView.php?section=asignaturas&added=true");
        exit;
    }
}
?>
<hr>
<h2>Eliminar asignatura</h2>

<form action="./administrationView.php?section=asignaturas" method="POST">
    <select name="subjectName">
        <?php
        $subject = getAllSubjects();

        for ($i = 0; $i < count($subject); $i++) {
            echo '<option value="' . $subject[$i]['name'] . '">' . $subject[$i]['name'] . '</option>';
        }
        ?>
    </select>
    <input type="submit" value="Borrar asignatura">
</form>