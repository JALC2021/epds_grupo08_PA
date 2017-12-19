<?php

include './dbcon.php';

$link = mysqli_connect($servername, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    echo 'Failed connection: ' . mysqli_connect_error();
    exit();
} else {
    $studentId = $_GET['studentToActiveId'];
    $subjectId = $_GET['subjectId'];
    $sql = "UPDATE student_subject SET active = 'Y' WHERE studentId = $studentId AND subjectId = $subjectId";
    $result = mysqli_query($link, $sql);

    if (!$result) {
        echo "Error executing query: " . mysqli_error();
    }
    mysqli_close($link);
    header("Location: subjectView.php?subjectId=$subjectId");
}