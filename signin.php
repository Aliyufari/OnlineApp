<!doctype html>
<html>
    <head>
        <title>AA Social Network</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="fonts/font-awesome.min.css" type="text/css" media="all"/>
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
        <script src="bootstrap/jquery.min.js"></script>
        <script src="bootstrap/bootstrap.min.js"></script>
        <style>
             body{
                overflow-x: hidden;
            }
            .main-content{
                width: 50%;
                height: 40%;
                margin: 10px auto;
                color: #fff;
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
            #login{
                width: 60%;
                border-radius: 30px;
                background: #187FAB;
                border-color: #187FAB;
            }
            #login:hover{
                background: rgb(51,103,214);
                border-color: rgb(51,103,214);
            }
            .overlap-text{
                position: relative;
            }
            .overlap-text a{
                position: absolute;
                top: 10px;
                right: 10px;
                font-size: 14px;
                color: red;
                text-decoration: none;
                font-family: 'Overpass Mono', monospace;
                letter-spacing: -1px;
            }
        </style>
        </head>
    <body>
        <div class="row">
            <div class="col-sm-12">
                <div class="well">
                    <center><h1 style="color: #fff">AA Social Network</h1></center>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="main-content">
                    <div class="header">
                        <h3 style="text-align:center;"><strong>Login to AA Social Network</strong></h3><hr>
                        <div class="1-part">
                             <form action="" method="POST">
                                <!--<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>-->
                                <input type="email" id="email" class="form-control input-md" placeholder="Email" name="user_email" required="required">
                                <br>
                                <div class="overlap-text">
                                    <!--<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>-->
                                    <input type="password" id="password" class="form-control input-md" placeholder="Password" name="user_password" required="required">
                                    <a href="forgot_password.php" style="text-decoration: none; float: right; color: #187FAB;" data-toggle="tooltip" title="Reset Password">Forgot?</a>
                                 <br>
                                </div><br>
                                 <a href="signup.php" style="text-decoration: none; float: right; color: #187FAB;" data-toggle="tooltip" title="Create Account!">Don't have an account?</a>
                                 <br><br>
                                 <center><button id="login" class="btn btn-info btn-lg" name="login">Login</button></center>
                                 <?php include("login.php"); ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

