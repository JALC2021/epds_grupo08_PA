<div class="content">
    <?php
    echo "<h1>Gestión de " . $_GET["section"] . "</h1>";
    if ($_GET["section"] == "alumnos") {
        include "./studentAdministration.php";
    } else if ($_GET["section"] == "profesores") {
        include "./teacherAdministration.php";
    } else if ($_GET["section"] == "asignaturas") {
        include "./subjectAdministration.php";
    }
    ?>
</div>