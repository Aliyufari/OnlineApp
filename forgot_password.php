<!doctype html>
<html>
    <head>
        <title>Forgot Password</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
                margin-botom: 5px;
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
                        <h3 style="text-align: center;"><strong>Forgot Password</strong></h3><hr>
                    </div>
                    <div class="l_pass">
                        <form action="" method="POST">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="email" name="email" placeholder="Enter Your Email" required class="form-control" id="email"/>
                            </div><br/>
                            <hr/>
                            <pre class="text">Enter your Best Friend name down below!</pre>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                <input type="text" name="recovery_account" placeholder="Someone" required class="form-control" id="msg"/>
                            </div><br/>
                            <a href="signin.php" style="text-decoration: none; float: right; color: #187FAB;" data-toggle="tooltip" title="Signin">Back to Signin?</a><br/><br/>
                            <center><button name="submit" id="signup" class="btn btn-info btn-lg">Submit</button></center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
    session_start();
    include ("includes/connection.php");
    if (isset($_POST['submit'])){
        
        $email = htmlentities(mysqli_real_escape_string($connect, $_POST['email']));
        $recovery_account = htmlentities(mysqli_real_escape_string($connect, $_POST['recovery_account']));
        
        $select_user = "SELECT * FROM users WHERE user_email = '$email' AND recovery_account = '$recovery_account'";
        $query = mysqli_query($connect, $select_user);
        $check_user = mysqli_num_rows($query);
        
        if ($check_user == 1){
            $_SESSION['user_email'] = $email;
            
            echo "<script>window.open('change_password.php', '_self')</script>";
        }
        else {
            echo "<script>alert('Your Email or Best Friend name is incorrect!')</script>";
        }  
    }
?>
