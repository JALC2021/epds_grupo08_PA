<?php
session_start();
include './CRUDStudent.php';

include './htmlToBody.php';
include './teacherMenu.php';
include './subjectMenu.php';

$studentInfo = readStudentById($_GET['studentId']);
?>
<h2>Visualizar/Modificar Alumno</h2>

<?php
if (!isset($_POST['submitUpdate'])) {
    ?>
    <div class="content">
        <form action="#" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend><?php echo 'Info de ' . $studentInfo['firstName']; ?></legend>
                <label>Nombre:</label><br /><input type="text" name="firstName" required="required" value="<?php echo $studentInfo['firstName']; ?>" /><br /><br />
                <label>Apellidos:</label><br /><input type="text" name="lastName" required="required" value="<?php echo $studentInfo['lastName']; ?>" /><br /><br />
                <label>DNI:</label><br /><input type="text" name="dni" required="required" value="<?php echo $studentInfo['dni']; ?>" /><br /><br />
                <label>Email:</label><br /><input type="text" name="email" required="required" value="<?php echo $studentInfo['email']; ?>" /><br /><br />
                <input type="hidden" name="studentId" value="<?php echo $_GET['studentId']; ?>" /><br /><br />
                <input type="submit" name="submitUpdate" value="Enviar" />
            </fieldset>
        </form>
    </div>
    <?php
} else {

    $studentId = $_POST['studentId'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dni = $_POST['dni'];
    $email = $_POST['email'];

    if (updateStudent($studentId, $firstName, $lastName, $dni, $email)) {
        echo "<script type='text/javascript'>alert('Alumno modificado con éxito');</script>";
    } else {
        echo "<script type='text/javascript'>alert('El alumno no ha sido modificado');</script>";
    }
}
include './bodyToHtml.php';
