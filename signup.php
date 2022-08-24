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
                    <center><h1 style="color: #fff">AA Social Network</h1></center>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="main-content">
                    <div class="header">
                        <h3 style="text-align:center;"><strong>Join AA Social Network</strong></h3><hr>
                        <div class="1-part">
                            <form action="" method="POST">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                    <input type="text" class="form-control" placeholder="First Name" name="first_name" required="required">
                                </div><br>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                    <input type="text" class="form-control" placeholder="Last Name" name="last_name" required="required">
                                </div><br>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input type="text" class="form-control" placeholder="Username" name="username" required="required">
                                </div><br>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input type="password" id="password" class="form-control" placeholder="Password" name="user_password" required="required">
                                </div><br>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input type="email" id="email" class="form-control" placeholder="Email" name="user_email" required="required">
                                </div><br>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                    <select class="form-control" name="user_country" required="required">
                                        <option>Nigeria</option>
                                        <option>Sudan</option>
                                        <option>Saudi Arabia</option>
                                        <option>India</option>
                                        <option>UK</option>
                                        <option>Pakistan</option>
                                        <option>US</option>
                                    </select>
                                </div><br>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                    <select class="form-control input-md" name="user_gender" required="required">
                                        <option>Male</option>
                                        <option>Female</option>
                                        <option>Other</option>
                                    </select>
                                </div><br>
                                 <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    <input type="date" class="form-control input-md" placeholder="Date of Birth" name="user_dob" required="required">
                                 </div><br>
                                 <a href="signin.php" style="text-decoration: none; float: right; color: 187FAB;" data-toggle="tooltip" title="Signin">Already have an account?</a>
                                 <br><br>
                                 <center><button id="signup" class="btn btn-info btn-lg" name="sign_up">Signup</button></center>
                                 <?php include("insert_user.php"); ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

