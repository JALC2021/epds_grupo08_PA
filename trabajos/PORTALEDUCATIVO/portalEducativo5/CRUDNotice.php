<?php

function createNotice($subjectId, $title, $text) {
    include 'dbcon.php';
    $link = mysqli_connect($servername, $username, $password, $dbname);

    if (mysqli_connect_errno()) {
        echo 'Failed connection: ' . mysqli_connect_error();
        exit();
    } else {
        $sql = "INSERT INTO notice (subjectId, title, text) VALUES('$subjectId','$title', '$text')";
        $result = mysqli_query($link, $sql);

        if (!$result) {
            echo "Error executing query: " . mysqli_error($link);
            exit();
        }
    }
    mysqli_close($link);
    return true;
}

function getNotices($subjectId) {
    include 'dbcon.php';
    $link = mysqli_connect($servername, $username, $password, $dbname);

    if (mysqli_connect_errno()) {
        echo 'Failed connection: ' . mysqli_connect_error();
        exit();
    } else {
        $sql = "SELECT * FROM notice WHERE subjectId = $subjectId";
        $result = mysqli_query($link, $sql);

        if (!$result) {
            echo "Error executing query: " . mysqli_error();
        } else {
            $array = array();
            if (mysqli_num_rows($result) == 0) {
                echo "<p>No hay anuncios</p>";
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