<?php
    session_start();
    include ("includes/connection.php");
    if (isset($_POST['login'])){
        
        $email = htmlentities(mysqli_real_escape_string($connect, $_POST['user_email']));
        $password = htmlentities(mysqli_real_escape_string($connect, $_POST['user_password']));
        
        $select_user = "SELECT * FROM users WHERE user_email = '$email' AND user_password = '$password' AND
                        status = 'verified'";
        $query = mysqli_query($connect, $select_user);
        $check_user = mysqli_num_rows($query);
        // die(var_dump($check_user));
        if ($check_user > 0){
            $_SESSION['user_email'] = $email;
            
            echo "<script>window.open('home.php', '_self')</script>";
        }
        else {
            echo "<script>alert('Your Email or Password is incorrect!')</script>";
        }  
    }

