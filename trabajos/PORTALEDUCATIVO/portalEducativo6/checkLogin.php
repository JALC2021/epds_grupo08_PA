<?php
session_start();

include 'dbcon.php';

$email = $_POST['email'];
$pass = $_POST['password'];

$link = mysqli_connect($servername, $username, $password, $dbname);



$query = "SELECT * FROM student WHERE email = '$email'";

if ($result = mysqli_query($link, $query)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (strcmp(md5($pass), $row['password']) == 0) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $row['firstName'];
                $_SESSION['usertype'] = 's';
                $_SESSION['userid'] = $row['id'];

                setcookie('username', $email, time() + 60 * 60 * 24 * 30, '/', null, false);

                header("Location: studentHome.php");
                exit();
            } else {
                ?><br /> LA CONTRASE&Ntilde;A NO ES CORRECTA!<br /><a href="login.php">VOLVER</a><br /><?php
            }
        }
    } else {
        $query2 = "SELECT * FROM teacher WHERE email = '$email'";

        if ($result2 = mysqli_query($link, $query2)) {
            if (mysqli_num_rows($result2) > 0) {
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    if (strcmp(md5($pass), $row2['password']) == 0) {
                        $_SESSION['loggedin'] = true;
                        $_SESSION['username'] = $row2['firstName'];
                        $_SESSION['usertype'] = 't';
                        $_SESSION['userid'] = $row2['id'];


                        setcookie('username', $email, time() + 60 * 60 * 24 * 30, '/', null, false);

                        if ($row2['admin'] == 'Y') {
                            header("Location: adminHome.php");
                        } else {
                            header("Location: teacherHome.php");
                        }
                        exit();
                    } else {
                        ?><br /> LA CONTRASE&Ntilde;A NO ES CORRECTA!<br /><a href="login.php">VOLVER</a><br /><?php
                    }
                }
            }
            ?><br /> EL USUARIO NO EXISTE!<br /><a href="login.php">VOLVER</a><br /><?php
        }
    }
}

mysqli_close($link);
