<?php
include './CRUDSubject.php';
include './CRUDStudent.php';
include './CRUDTeacher.php';
?>
<div class="container">
    <ul id="nav">
        <li><a class="hsubs" href="#">Administración</a>
            <ul class="subs">
                <li><a href="./administrationView.php?section=profesores">Profesores</a></li>
                <li><a href="./administrationView.php?section=alumnos">Alumnos</a></li>
                <li><a href="./administrationView.php?section=asignaturas">Asignaturas</a></li>
            </ul>
        </li>
        <li><a href="closeSession.php">Cerrar Sesi&oacute;n</a></li>
        <div class="greeting"> Hola administrador <strong><?php echo ucwords($_SESSION['username']); ?></strong>!</div>
    </ul>
</div>
<?php
if (!isset($_GET["section"])) {
    ?>
    <div class="content">
        <?php
        $teachers = count(getAllTeachers());
        $subjects = count(getAllSubjects());
        $students = count(getAllStudents());
        ?>
        <h1>Estad&iacute;sticas</h1>
        <p>N&uacute;mero de profesores en el sistema: <?php echo $teachers ?></p>
        <p>N&uacute;mero de alumnos en el sistema: <?php echo $students ?></p>
        <p>N&uacute;mero de asignaturas en el sistema: <?php echo $subjects ?></p>
    </div>
    <?php
}
?>