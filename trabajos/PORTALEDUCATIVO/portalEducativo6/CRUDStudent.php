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

function deleteStudent($dni) {
    include 'dbcon.php';
    $link = mysqli_connect($servername, $username, $password, $dbname);

    $dni2 = strtolower($dni);

    if (mysqli_connect_errno()) {
        echo 'Failed connection: ' . mysqli_connect_error();
        exit();
    } else {
        $sql = "DELETE FROM student WHERE dni='$dni2'";
        $result = mysqli_query($link, $sql);

        if (!$result) {
            echo "Error executing query: " . mysqli_error($link);
            exit();
        }
    }

    mysqli_close($link);
    return true;
}

function getAllStudents() {
    include 'dbcon.php';
    $link = mysqli_connect($servername, $username, $password, $dbname);

    if (mysqli_connect_errno()) {
        echo 'Failed connection: ' . mysqli_connect_error();
        exit();
    } else {
        $sql = "SELECT * FROM student";
        $result = mysqli_query($link, $sql);

        if (!$result) {
            echo "Error executing query: " . mysqli_error();
        } else {
            $array = array();
            if (mysqli_num_rows($result) == 0) {
                echo "<tr><td colspan='5'>No hay alumnos</td></tr>";
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

function getStudentSubjects($studentId) {
    include 'dbcon.php';
    $link = mysqli_connect($servername, $username, $password, $dbname);

    if (mysqli_connect_errno()) {
        echo 'Failed connection: ' . mysqli_connect_error();
        exit();
    } else {
        $sql = "SELECT * FROM student_subject WHERE studentId = $studentId AND active = 'Y'";
        $result = mysqli_query($link, $sql);

        if (!$result) {
            echo "Error executing query: " . mysqli_error();
        } else {
            $subjects = array();

            if (mysqli_num_rows($result) != 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $sql2 = "SELECT * FROM subject WHERE id = " . $row['subjectId'];
                    $result2 = mysqli_query($link, $sql2);
                    $array = mysqli_fetch_array($result2);

                    array_push($subjects, $array);
                }
            }
        }
        mysqli_close($link);
    }
    return $subjects;
}

function readStudentById($studentId) {
    include 'dbcon.php';
    $link = mysqli_connect($servername, $username, $password, $dbname);

    if (mysqli_connect_errno()) {
        echo 'Failed connection: ' . mysqli_connect_error();
        exit();
    } else {
        $sql = "SELECT * FROM student WHERE id = $studentId";
        $result = mysqli_query($link, $sql);

        if (!$result) {
            echo "Error executing query: " . mysqli_error();
        } else {
            $array = array();
            if (mysqli_num_rows($result) == 0) {
                echo "<p>No hay datos</p>";
            } else {
                while ($row = mysqli_fetch_array($result)) {
                    $array = $row;
                }
            }
        }
        mysqli_close($link);
    }
    return $array;
}

function updateStudent($studentId, $firstName, $lastName, $dni, $email) {
    include 'dbcon.php';
    $link = mysqli_connect($servername, $username, $password, $dbname);

    $dni2 = strtolower($dni);

    if (mysqli_connect_errno()) {
        echo 'Failed connection: ' . mysqli_connect_error();
        exit();
    } else {
        $sql = "UPDATE student SET firstName='$firstName', lastName='$lastName', dni='$dni', email='$email' WHERE id=$studentId";
        $result = mysqli_query($link, $sql);

        if (!$result) {
            echo "Error executing query: " . mysqli_error($link);
            exit();
        }
    }

    mysqli_close($link);
    return true;
}