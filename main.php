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
            #centered1{
                position: absolute;
                font-size: 10vw;
                top: 30%;
                left: 30%;
                transform: translate(-50%, -50%);
            }
            #centered2{
                position: absolute;
                font-size: 10vw;
                top: 50%;
                left: 35%;
                transform: translate(-50%, -50%);
            }
            #centered3{
                position: absolute;
                font-size: 10vw;
                top: 70%;
                left: 32%;
                transform: translate(-50%, -50%);
            }
            #signup{
                width: 60%;
                background: #187FAB;
                border-radius: 30px;
                margin-bottom: 10px;
                border-color: #187FAB;
            }
            #signup:hover{
                background: rgb(51,103,214);
                border: 1px solid rgb(51,103,214);
            }
            #login{
                width: 60%;
                background: #fff;
                color: #187FAB;
                border: 1px solid #187FAB;
                border-radius: 30px;
            }
            #login:hover{
                background: #fff;
                color: rgb(51,103,214);
                border: 1px solid rgb(51,103,214);
            }
            .well{
                background: rgb(51,103,214);
            }
            .img-logo{
                margin-left: 15%;
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
            <div class="col-sm-6" style="left: 1%">
                <img src="images/social_network.jpg" class="img-rounded" title="AA Social Network" width="650px" height="565px"/>
                <div id="centered1" class="centered">
                    <h3 style="color: orange;">
                        <span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;<strong>Follow Your Interest.</strong>
                    </h3>
                </div>
                <div id="centered2" class="centered">
                    <h3 style="color: orange;">
                        <span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;<strong>See what People are doing.</strong>
                    </h3>
                </div>
                <div id="centered3" class="centered">
                    <h3 style="color: orange;">
                        <span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;<strong>Join the Conversation.</strong>
                    </h3>
                </div>
            </div>
            <div class="col-sm-6" style="left: 8%">
                <img src="images/logo.png" class="img-rounded img-logo" title="AA Social Network" width="150px" height="150px"/>
                <h2><strong>See what's happening in<br> the world right now.</strong></h2><br><br>
                <h4>Join<strong> AA Social Network </strong>Today.</h4><br><br>
                <form action="" method="POST">
                    <button id="signup" class="btn btn-info btn-lg" name="signup">Signup</button>
                        <?php
                            if (isset($_POST['signup'])){
                                echo "<script>window.open('signup.php','_self')</script>";
                            }                      
                        ?>
                    <button id="login" class="btn btn-info btn-lg" name="login">Login</button>
                         <?php
                            if (isset($_POST['login'])){
                                echo "<script>window.open('signin.php','_self')</script>";
                            }                      
                        ?>
                </form>
            </div>
        </div>
    </body>
</html>
