<!doctype html>
<?php 
    session_start();
    include("includes/connection.php");
    if (!isset($_SESSION['user_email'])){
        header("location: index.php");
    }
?>
<html>
    <head>
        <title>Forgot Password</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" href="fonts/font-awesome.min.css" type="text/css" media="all"/>
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
        <script src="bootstrap/jquery.min.js"></script>
        <script src="bootstrap/bootstrap.min.js"></script>
        <style>
             body{
                overflow-x: hidden;
                background-color: #F8F8FF;
            }
            .main-content{
                width: 50%;
                height: 40%;
                margin: 10px auto;
                background-color: #fff;
                border: 1px solid #e6e6e6;
                padding: 40px 50px;
            }
            .header{
                color: #000;
                border: 0px solid #000;
                margin-bottom: 5px;
            }
            .well{
                background: rgb(51,103,214);
            }
            #signup{
                width: 60%;
                border-radius: 30px;
                background: #187FAB;
                border-color: #187FAB;
            }
            #signup:hover{
                background: rgb(51,103,214);
                border-color: rgb(51,103,214);
            }
        </style>
    </head>
    <body>
        <div class="row">
            <div class="col-sm-12">
                <div class="well">
                    <center><h1 style="color: #fff;"><strong>AA Social Network</strong></h1></center>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="main-content">
                    <div class="header">
                        <h3 style="text-align: center;"><strong>Change Your Password</strong></h3><hr>
                    </div>
                    <div class="l_pass">
                        <form action="" method="POST">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" name="password" placeholder="New Password" required class="form-control" id="email"/>
                            </div><br/>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" name="password1" placeholder="Comfirm Password" required class="form-control" id="msg"/>
                            </div><br/>
                            <center><button name="change" id="signup" class="btn btn-info btn-lg">Change Password</button></center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
    if (isset($_POST['change'])){
        $user = $_SESSION['user_email'];
        $get_user = "SELECT * FROM users WHERE user_email = '$user'";
        $run_user = mysqli_query($connect, $get_user);
        $row = mysqli_fetch_array($run_user);
            
        $user_id = $row['user_id'];
        
        $password = htmlentities(mysqli_real_escape_string($connect, $_POST['password']));
        $password1 = htmlentities(mysqli_real_escape_string($connect, $_POST['password1']));
        
        if ($password == $password1){
            if (strlen($password) >=6 && strlen($password) <= 60){
                $update = "UPDATE users SET user_password = '$password' WHERE user_id = '$user_id'";
                $run_update = mysqli_query($connect, $update);
                
                if ($run_update){
                    echo "<script>alert('Your Password Changed!')</script>";
                    echo "<script>window.open('signin.php', '_self')</script>";
                }
            }
            else{
                echo "<script>alert('Password Should be Minimum 6 Characters!')</script>";
                echo "<script>window.open('change_password.php', '_self')</script>";  
            }
        }
        else{
            echo "<script>alert('Your Password Did Not Match!')</script>";
            echo "<script>window.open('change_password.php', '_self')</script>";
        }
    }
?>