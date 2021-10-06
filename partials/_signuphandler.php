<?php

$showerror = false;

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    require '_dbconnect.php';
    $user_email = $_POST['signupemail'];
    $signuppassword = $_POST['signuppassword'];
    $signupcpassword = $_POST['signupcpassword'];

    $sql = "SELECT * FROM `users` WHERE `user_email` = '$user_email'";
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);

    if ($num>0) {
        $showerror = "user already exist";

    }
    else{
        
            if ($signuppassword == $signupcpassword) {
                
                $sql = "INSERT INTO `users` (`user_email`, `user_password`, `timestamp`) VALUES ('$user_email', '$signuppassword', current_timestamp())";
                $result = mysqli_query($conn,$sql);
                
                if($result){
                    $showAlert = true;
                    header("Location: /phpprojects/iforum/index.php?signupsuccess=true");
                    exit();
                    
                }
            }
            else {
                $showerror = "Passwords donot Match";
            }
            
    }
    header("Location: /phpprojects/iforum/index.php?signupsuccess=false&error=$showerror");

}




?>