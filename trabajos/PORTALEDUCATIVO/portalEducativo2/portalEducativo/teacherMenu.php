<?php
include './CRUDSubject.php';
?>
<div class="container">
    <ul id="nav">
        <li><a class="hsubs" href="#">Mis Asignaturas</a>
            <ul class="subs">
                <?php
                $array = readSubjectByTeacherId($_SESSION['userid']);

                for ($i = 0; $i < count($array); $i++) {
                    ?><li><a href="subjectView.php?subjectId=<?php echo $array[$i]['id']; ?>&subjectName=<?php echo $array[$i]['name']; ?>"><?php echo ucwords($array[$i]['name']); ?></a></li>
                    <?php
                }
                ?>
            </ul>
        </li>
        <li><a href="#">Mis Datos</a></li>
        <li><a href="http://www.script-tutorials.com/pure-css3-lavalamp-menu/">Cerrar Sesi&oacute;n</a></li>
        <div id="lavalamp"></div>
        <div class="greeting"> Hola Profesor <strong><?php echo ucwords($_SESSION['username']); ?></strong>!</div>
    </ul>
</div>