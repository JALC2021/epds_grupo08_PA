<?php
include './CRUDStudent.php';
?>
<div class="container">
    <ul id="nav">
        <li><a class="hsubs" href="#">Mis Asignaturas</a>
            <ul class="subs">
                <?php
                $array = getStudentSubjects($_SESSION['userid']);

                for ($i = 0; $i < count($array); $i++) {
                    ?><li><a href="subjectStudentView.php?subjectId=<?php echo $array[$i]['id']; ?>&subjectName=<?php echo $array[$i]['name']; ?>"><?php echo ucwords($array[$i]['name']); ?></a></li>
                    <?php
                }
                ?>


            </ul>
        </li>
        <li><a href="profileView.php">Mis Datos</a></li>
        <li><a href="closeSession.php">Cerrar Sesi&oacute;n</a></li>
        
        <div class="greeting"> Hola alumno <strong><?php echo ucwords($_SESSION['username']); ?></strong>!</div>
    </ul>
</div>