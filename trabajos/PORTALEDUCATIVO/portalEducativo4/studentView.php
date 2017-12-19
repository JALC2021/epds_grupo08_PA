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
    <form action="#" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend><?php echo 'Info de ' . $studentInfo['firstName'];?></legend>
            <label>Nombre:</label><br /><input type="text" name="firstName" required="required" value="<?php echo $studentInfo['firstName']; ?>" /><br /><br />
            <label>Apellidos:</label><br /><input type="text" name="lastName" required="required" value="<?php echo $studentInfo['lastName']; ?>" /><br /><br />
            <label>DNI:</label><br /><input type="text" name="dni" required="required" value="<?php echo $studentInfo['dni']; ?>" /><br /><br />
            <label>Email:</label><br /><input type="text" name="email" required="required" value="<?php echo $studentInfo['email']; ?>" /><br /><br />
            <input type="submit" name="submitUpdate" value="Enviar" />
        </fieldset>
    </form>
    <?php
} else {
    if ($_FILES['image']['error'] > 0) {
        echo "Error: " . $_FILES['image']['error'];
    } else {
        if ((($_FILES['image']['size'] / 1024) / 1024) > 2) {
            echo "Error: El archivo supera el limita de tamaño permitido.";
        } else {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $dni = $_POST['dni'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $imageName = time() . $_FILES['image']['name'];
            $subjectsChoosed = $_POST['subjects'];

            if (createStudent($firstName, $lastName, $dni, $password, $imageName, $email, $subjectsChoosed)) {
                header("Location: registered.php");
                exit;
            }
        }
    }
}
include './bodyToHtml.php';
