<?php

$showalert = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require '_dbconnect.php';

    $user_email = $_POST["loginemail"];
    $luser_password = $_POST["loginpassword"];

    $lsql = "SELECT * FROM `users` WHERE `user_email` = '$user_email'";
    $lresult = mysqli_query($conn,$lsql);

    $rownum = mysqli_num_rows($lresult);
    if ($rownum == 1) {
        $row  = mysqli_fetch_assoc($lresult);
        if ($luser_password == $row['user_password']) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['useremail'] = $user_email;
            $_SESSION["sno"] = $row['sno'];
            echo 'You are logged in '.$user_email;
        }
        header("Location: /phpprojects/iforum") ;
    }
    header("Location: /phpprojects/iforum") ;

}



?>