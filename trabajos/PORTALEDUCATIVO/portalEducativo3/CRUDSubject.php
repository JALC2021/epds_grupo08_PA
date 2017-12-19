<?php
function readSubject() {
    include 'dbcon.php';
    $link = mysqli_connect($servername, $username, $password, $dbname);

    if (mysqli_connect_errno()) {
        echo 'Failed connection: ' . mysqli_connect_error();
        exit();
    } else {
        $sql = "SELECT * FROM subject";
        $result = mysqli_query($link, $sql);

        if (!$result) {
            echo "Error executing query: " . mysqli_error();
        } else {
            $array = array();
            if (mysqli_num_rows($result) == 0) {
                echo "<tr><td colspan='5'>No hay asignaturas</td></tr>";
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

function readSubjectByTeacherId($teacherId) {
    include 'dbcon.php';
    $link = mysqli_connect($servername, $username, $password, $dbname);

    if (mysqli_connect_errno()) {
        echo 'Failed connection: ' . mysqli_connect_error();
        exit();
    } else {
        $sql = "SELECT * FROM subject WHERE teacherId = $teacherId";
        $result = mysqli_query($link, $sql);

        if (!$result) {
            echo "Error executing query: " . mysqli_error();
        } else {
            $array = array();
            if (mysqli_num_rows($result) == 0) {
                echo "<tr><td colspan='5'>No hay asignaturas</td></tr>";
            } else {
                while ($row = mysqli_fetch_array($result)) {
                    array_push($array, $row);
                }
            }
        }
        mysqli_close($link);
    }
    return $array;
}

function createSubject($name, $description, $teacherId) {
    include 'dbcon.php';
    $link = mysqli_connect($servername, $username, $password, $dbname);

    if (mysqli_connect_errno()) {
        echo 'Failed connection: ' . mysqli_connect_error();
        exit();
    } else {
        $sql = "INSERT INTO subject (name, description, teacherId) VALUES('$name', '$description', '$teacherId')";
        $result = mysqli_query($link, $sql);

        if (!$result) {
            echo "Error executing query: " . mysqli_error($link);
            exit();
        }
    }
    mysqli_close($link);
    return true;
}

function deleteSubject($name) {
    include 'dbcon.php';
    $link = mysqli_connect($servername, $username, $password, $dbname);
    
    $name2 = strtolower($name);
    
    if (mysqli_connect_errno()) {
        echo 'Failed connection: ' . mysqli_connect_error();
        exit();
    } else {
        $sql = "DELETE FROM subject WHERE name='$name2'";
        $result = mysqli_query($link, $sql);
        
        if (!$result) {
            echo "Error executing query: " . mysqli_error($link);
            exit();
        }
    }
    
    mysqli_close($link);
    return true;
}

function getAllSubjects() {
    include 'dbcon.php';
    $link = mysqli_connect($servername, $username, $password, $dbname);
    
    if (mysqli_connect_errno()) {
        echo 'Failed connection: ' . mysqli_connect_error();
        exit();
    } else {
        $sql = "SELECT * FROM subject";
        $result = mysqli_query($link, $sql);

        if (!$result) {
            echo "Error executing query: " . mysqli_error();
        } else {
            $array = array();
            if (mysqli_num_rows($result) == 0) {
                echo "<tr><td colspan='5'>No hay asignaturas</td></tr>";
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