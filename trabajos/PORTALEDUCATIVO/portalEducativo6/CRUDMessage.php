<?php

function createMessage($subjectId, $studentId, $title, $text) {
    include 'dbcon.php';
    $link = mysqli_connect($servername, $username, $password, $dbname);

    if (mysqli_connect_errno()) {
        echo 'Failed connection: ' . mysqli_connect_error();
        exit();
    } else {
        $sql = "INSERT INTO message (subjectId, studentId, title, text) VALUES('$subjectId', '$studentId', '$title', '$text')";
        $result = mysqli_query($link, $sql);

        if (!$result) {
            echo "Error executing query: " . mysqli_error($link);
            exit();
        }
    }
    mysqli_close($link);
    return true;
}

function createTeacherMessage($subjectId, $studentId, $teacherId, $title, $text) {
    include 'dbcon.php';
    $link = mysqli_connect($servername, $username, $password, $dbname);

    if (mysqli_connect_errno()) {
        echo 'Failed connection: ' . mysqli_connect_error();
        exit();
    } else {
        $sql = "INSERT INTO message (subjectId, studentId, teacherId, title, text) VALUES('$subjectId', '$studentId', '$teacherId', '$title', '$text')";
        $result = mysqli_query($link, $sql);

        if (!$result) {
            echo "Error executing query: " . mysqli_error($link);
            exit();
        }
    }
    mysqli_close($link);
    return true;
}

function getMessages($subjectId, $studentId) {
    include 'dbcon.php';
    $link = mysqli_connect($servername, $username, $password, $dbname);

    if (mysqli_connect_errno()) {
        echo 'Failed connection: ' . mysqli_connect_error();
        exit();
    } else {
        $sql = "SELECT * FROM message WHERE subjectId = $subjectId AND studentId = $studentId";
        $result = mysqli_query($link, $sql);

        if (!$result) {
            echo "Error executing query: " . mysqli_error();
        } else {
            $array = array();
            if (mysqli_num_rows($result) == 0) {
                echo "<p>No hay mensajes</p>";
            } else {
                while ($row = mysqli_fetch_array($result)) {
                    array_push($array, $row);
                }
            }
            mysqli_close($link);
        }
    }
    return $array;
}