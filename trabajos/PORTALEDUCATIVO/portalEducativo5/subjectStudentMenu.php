<?php
include './dbcon.php';
?>
<div class="afterMenuSubj">
    <div class="container">

        <ul id="nav">
            <li><a href="noticesView.php?subjectId=<?php echo $_GET['subjectId']; ?>&subjectName=<?php echo $_GET['subjectName']; ?>">Anuncios</a></li>
            <li><a href="docsView.php?subjectId=<?php echo $_GET['subjectId']; ?>">Documentos</a></li>
            <li><a class="hsubs" href="#">Mensajer&iacute;a</a></li>
            <div class="greeting"> Asignatura <strong><?php echo strtoupper($_GET['subjectName']); ?></strong></div>
        </ul>
    </div>
</div>