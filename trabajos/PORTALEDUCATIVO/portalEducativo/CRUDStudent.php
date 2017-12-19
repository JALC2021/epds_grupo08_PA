<?php
function createStudent($firstName, $lastName, $dni, $passwordChoosed, $image, $email, $subjectsChoosed) {
    include 'dbcon.php';
    $link = mysqli_connect($servername, $username, $password, $dbname);

    $firstName2 = strtoupper($firstName);
    $lastName2 = strtoupper($lastName);
    $email2 = strtolower($email);
    $dni2 = strtolower($dni);
    $password2 = md5($passwordChoosed);
    

    if (mysqli_connect_errno()) {
        echo 'Failed connection: ' . mysqli_connect_error();
        exit();
    } else {
        $sql = "INSERT INTO student (firstName, lastName, dni, password, image, email) VALUES('$firstName2','$lastName2','$dni2','$password2','$image', '$email2')";
        $result = mysqli_query($link, $sql);

        if (!$result) {
            echo "Error executing query: " . mysqli_error($link);
            exit();
        } else {
            move_uploaded_file($_FILES['image']['tmp_name'], "img/" . $image);
        }

        for ($i = 0; $i < count($subjectsChoosed); $i++) {
            $sql = "SELECT id FROM subject WHERE name = '$subjectsChoosed[$i]'";
            $result = mysqli_query($link, $sql);

            if (!$result) {
                echo "Error executing query: " . mysqli_error($link);
            } else {
                while ($row = mysqli_fetch_array($result)) {
                    $subjectId = $row['id'];

                    $sql2 = "SELECT id FROM student WHERE dni = '$dni2'";
                    $result2 = mysqli_query($link, $sql2);

                    if (!$result2) {
                        echo "Error executing query: " . mysqli_error($link);
                    } else {
                        while ($row2 = mysqli_fetch_array($result2)) {
                            $studentId = $row2['id'];
                            $sql3 = "INSERT INTO student_subject (studentId, subjectId, active) VALUES('$studentId', '$subjectId', 'N')";

                            $result3 = mysqli_query($link, $sql3);

                            if (!$result3) {
                                echo "Error executing query: " . mysqli_error($link);
                            }
                        }
                    }
                }
            }
        }
    }
    mysqli_close($link);
    return true;
}