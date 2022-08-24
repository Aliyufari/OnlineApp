<?php
    include ("includes/connection.php");

    if (isset($_POST['sign_up'])){
        $first_name = htmlentities(mysqli_real_escape_string($connect, $_POST['first_name']));
        $last_name = htmlentities(mysqli_real_escape_string($connect,$_POST['last_name']));
        $username = htmlentities(mysqli_real_escape_string($connect,$_POST['username']));
        $password = htmlentities(mysqli_real_escape_string($connect,$_POST['user_password']));
        $email = htmlentities(mysqli_real_escape_string($connect,$_POST['user_email']));
        $country = htmlentities(mysqli_real_escape_string($connect,$_POST['user_country']));
        $gender = htmlentities(mysqli_real_escape_string($connect,$_POST['user_gender']));
        $dob = htmlentities(mysqli_real_escape_string($connect,$_POST['user_dob']));
        $status = "verified";
        $posts = "no";

        $newgid = sprintf('%05d', rand(0, 999999));
        
        $username = strtolower($first_name.'_'.$newgid);
        $check_username = "SELECT user_name FROM users WHERE user_email = '$username'";
        $run_username = mysqli_query($connect, $check_username);

        if ($check > 0){
            echo "<script>alert('Username already taken!')</script>";
            echo "<script>window.open('signup.php', '_self')</script>";
            exit();
        }

        $check_email =  "SELECT * FROM users WHERE user_name = '$email'";
        $run_email = mysqli_query($connect, $check_email);
        $check = mysqli_num_rows($run_email);
        
        if ($check > 0){
            echo "<script>alert('Email already exist please try another!')</script>";
            echo "<script>window.open('signup.php', '_self')</script>";
            exit();
        }
        
        if (strlen($password) < 8){
            echo "<script>alert('Passwor should be minimun 8 characters!')</script>";
            exit(); 
        }
        
        $check_email =  "SELECT * FROM users WHERE user_email = '$email'";
        $run_email = mysqli_query($connect, $check_email);
        $check = mysqli_num_rows($run_email);
        
        if ($check == 1){
            echo "<script>alert('Email already exist please try another!')</script>";
            echo "<script>window.open('signup.php', '_self')</script>";
            exit();
        }
        
        //Profile pic b/w M and F
        if ($gender == "Male")
            $profile_pic = "user1.jpg";
        else
            $profile_pic = "user2.jpg";
        
        
        $insert = "INSERT INTO users (
                fname, 
                lname,
                user_name, 
                user_description, 
                relationship, 
                user_password, 
                user_email,
                user_country, 
                user_gender, 
                user_dob, 
                user_image, 
                user_cover, 
                user_reg_date, 
                status, 
                posts, 
                recovery_account
            ) 
                    
            VALUES (
                '$first_name', 
                '$last_name', 
                '$username', 
                'Hello AA Social Network. This is my default status!', 
                '.....',
                '$password', 
                '$email', 
                '$country', 
                '$gender', 
                '$dob', 
                '$profile_pic', 
                'default_cover.jpg', 
                 NOW(), 
                '$status', 
                '$posts', 
                'GoogleAccount'
            )";

        $query = mysqli_query($connect, $insert);
        if ($query){
            echo "<script>alert('Congratulation $first_name you are good to go!')</script>";
            echo "<script>window.open('signin.php', '_self')</script>";
        }
        else {
           echo "<script>alert('Registration failed try again!')</script>";
           echo "<script>window.open('signup.php', '_self')</script>"; 
        }
    }