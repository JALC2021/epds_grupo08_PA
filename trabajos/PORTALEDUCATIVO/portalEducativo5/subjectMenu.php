<?php
include './dbcon.php';
?>
<div class="afterMenuSubj">
    <div class="container">

        <ul id="nav">
            <li><a class="hsubs" href="#">Alumnos</a>
                <ul class="subs">
                    <?php
                    $link = mysqli_connect($servername, $username, $password, $dbname);

                    if (mysqli_connect_errno()) {
                        echo 'Failed connection: ' . mysqli_connect_error();
                        exit();
                    } else {
                        $subjectId = $_GET['subjectId'];
                        $sql = "SELECT s.*, ss.active FROM student s, student_subject ss WHERE s.id = ss.studentId AND ss.subjectId = $subjectId";
                        $result = mysqli_query($link, $sql);

                        if (!$result) {
                            echo "Error executing query: " . mysqli_error();
                        } else {
                            $array = array();
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <li><a class="studentlink" href="studentView.php?studentId=<?php echo $row['id']; ?>&subjectId=<?php echo $subjectId ?>&subjectName=<?php echo $_GET['subjectName'] ?>">
                                            <?php
                                            echo ucwords($row['firstName']) . " " . ucwords($row['lastName']);
                                            if ($row['active'] == 'N') {
                                                ?><a class="studentlinklogo" href="activeStudent.php?subjectId=<?php echo $subjectId; ?>&studentToActiveId=<?php echo $row['id'] ?>&subjectName=<?php echo $_GET['subjectName'] ?>"><img class="acceptlogo" src="img/accept.png" /></a><?php
                                            }
                                            ?>
                                        </a>
                                    </li>
                                    <?php
                                }
                            }
                            mysqli_close($link);
                        }
                    }
                    ?>
                </ul>
            </li>
            <li><a href="noticesView.php?subjectId=<?php echo $subjectId; ?>">Anuncios</a></li>
            <li><a href="docsView.php?subjectId=<?php echo $subjectId; ?>">Documentos</a></li>
            <li><a class="hsubs" href="#">Mensajer&iacute;a</a></li>
            <div class="greeting"> Asignatura <strong><?php echo strtoupper($_GET['subjectName']); ?></strong></div>
        </ul>
    </div>
</div>