<?php
function createTeacher($firstName, $lastName, $passwordChoosed, $email, $admin) {
    include 'dbcon.php';
    $link = mysqli_connect($servername, $username, $password, $dbname);
    
    if ($admin == true) {
        $admin2 = "Y";
    } else {
        $admin2 = "N";
    }

    if (mysqli_connect_errno()) {
        echo 'Failed connection: ' . mysqli_connect_error();
        exit();
    } else {
        $sql = "INSERT INTO teacher (firstName, lastName, password, email, admin) VALUES('$firstName', '$lastName', '$password', '$email', '$admin')";
        $result = mysqli_query($link, $sql);

        if (!$result) {
            echo "Error executing query: " . mysqli_error($link);
            exit();
        }
    }
    mysqli_close($link);
    return true;
}

function deleteTeacher($email) {
    include 'dbcon.php';
    $link = mysqli_connect($servername, $username, $password, $dbname);
    
    $email2 = strtolower($email);
    
    if (mysqli_connect_errno()) {
        echo 'Failed connection: ' . mysqli_connect_error();
        exit();
    } else {
        $sql = "DELETE FROM teacher WHERE email='$email2'";
        $result = mysqli_query($link, $sql);
        
        if (!$result) {
            echo "Error executing query: " . mysqli_error($link);
            exit();
        }
    }
    
    mysqli_close($link);
    return true;
}

function getAllTeachers() {
    include 'dbcon.php';
    $link = mysqli_connect($servername, $username, $password, $dbname);
    
    if (mysqli_connect_errno()) {
        echo 'Failed connection: ' . mysqli_connect_error();
        exit();
    } else {
        $sql = "SELECT * FROM teacher";
        $result = mysqli_query($link, $sql);

        if (!$result) {
            echo "Error executing query: " . mysqli_error();
        } else {
            $array = array();
            if (mysqli_num_rows($result) == 0) {
                echo "<tr><td colspan='5'>No hay profesores</td></tr>";
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