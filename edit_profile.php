<!doctype html>
<?php 
    session_start();
    include("includes/header.php");
    if (!isset($_SESSION['user_email'])){
        header("location: index.php");
    }
?>
<html>
    <head>
        <title>Edit Account Settings</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="fonts/font-awesome.min.css" type="text/css" media="all"/>
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
        <script src="bootstrap/jquery.min.js"></script>
        <script src="bootstrap/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="styles/home_style.css"/>
    </head>
    <body>
        <div class="row">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8">
                <form action="" method="POST" enctype="multipart/form-data">
                    <table class="table table-bordered table-hover">
                        <tr align="center">
                            <td colspan="6" class="active"><h2>Edit Your Profile</h2></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Change Your First Name</td>
                            <td><input type="text" name="f_name" class="form-control" required value="<?php echo $first_name; ?>"></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Change Your Last Name</td>
                            <td><input type="text" name="l_name" class="form-control" required value="<?php echo $last_name; ?>"></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Change Your Username</td>
                            <td><input type="text" name="user_name" class="form-control" required value="<?php echo $user_name; ?>"></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Describtion</td>
                            <td><input type="text" name="user_description" class="form-control" required value="<?php echo $user_description; ?>"></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Relationship</td>
                            <td>
                                <select name="relationship" class="form-control">
                                    <option><?php echo $user_relationship; ?></option>
                                    <option>Single</option>
                                    <option>Engaged</option>
                                    <option>Married</option>
                                    <option>In a Relationship</option>
                                    <option>It's Complicated</option>
                                    <option>Separated</option>
                                    <option>Divorsed</option>
                                    <option>Widowed</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Password</td>
                            <td>
                                <input type="password" name="user_password" class="form-control" id="mypassword" required value="<?php echo $user_password; ?>">
                                <input type="checkbox" onclick="show_password();"><strong>Show Password</strong>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Email</td>
                            <td><input type="email" name="user_email" class="form-control" required value="<?php echo $user_email; ?>"></td>
                        </tr>
                         <tr>
                            <td style="font-weight: bold;">Country</td>
                            <td>
                                <select name="user_country" class="form-control">
                                    <option><?php echo $user_country; ?></option>
                                    <option>Nigeria</option>
                                    <option>Sudan</option>
                                    <option>Saudi Arabia</option>
                                    <option>India</option>
                                    <option>UK</option>
                                    <option>Pakistan</option>
                                    <option>US</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Gender</td>
                            <td>
                                <select name="user_gender" class="form-control">
                                    <option><?php echo $user_gender; ?></option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Other</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Date of  Birth</td>
                            <td><input type="date" name="user_dob" class="form-control input-md" required value="<?php echo $user_dob; ?>"></td>
                        </tr>
                        <!--Recover Password Option-->
                        <tr>
                            <td style="font-weight: bold;">Forgotten Password</td>
                            <td>
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Turn On</button>
                                <div id="myModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h2 class="modal-title">Password Recovery</h2>
                                            </div>
                                            <div class="modal-body">
                                                <form action="recovery.php?id=<?php echo $user_id; ?>" method="POST" id="f">
                                                    <strong>What is Your School Best Friend Name?</strong>
                                                    <textarea name="content" cols="83" rows="4" class="form-control" placeholder="Someone"></textarea><br>
                                                    <input type="submit" name="sub"  class="btn btn-default" value="Submit" style="width: 100px;"><br><br>
                                                    <pre>Answer the above question we will ask this question if you forgort your <br>Password!</pre>
                                                </form>
                                                <?php
                                                    if(isset($_POST['sub'])){
                                                        $bf_name = htmlentities($_POST['content']);
                                                        if ($bf_name == ""){
                                                            echo "<script>alert('Please enter your Best Friend Name!')</script>";
                                                            echo "<script>window.open('edit_profile.php?user_id=$user_id', '_self')</script>";
                                                        }
                                                        else{
                                                            $update = "UPDATE users SET recovery_account = '$bf_name' WHERE user_id = '$user_id'";
                                                            $run_update = mysqli_query($connect, $update);
                                                            if($run_update){
                                                                echo "<script>alert('Working...!')</script>";
                                                                echo "<script>window.open('edit_profile.php?user_id=$user_id', '_self')</script>";
                                                            }
                                                            else{
                                                                echo "<script>alert('Error While Updating Information!')</script>";
                                                                echo "<script>window.open('edit_profile.php?user_id=$user_id', '_self')</script>";
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr align="center">
                            <td colspan="6"><button name="update" type="submit" class="btn btn-info" style="width: 250px;">Update</button></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="col-sm-2">
            </div>
        </div>
    </body>
</html>
<script>
    //Showing Passwor Using JavaScript
    function show_password(){
        var x = document.getElementById("mypassword");
        if(x.type === "password"){
            x.type = "text";
        }
        else{
            x.type = "password";
        }
    }
</script>
<?php
   if(isset($_POST['update'])){
        $first_name = htmlentities($_POST['f_name']);
        $last_name = htmlentities($_POST['l_name']);
        $user_name = htmlentities($_POST['user_name']);
        $user_description = htmlentities($_POST['user_description']);
        $user_relationship = htmlentities($_POST['relationship']);
        $user_password = htmlentities($_POST['user_password']);
        $user_email = htmlentities($_POST['user_email']);
        $user_country = htmlentities($_POST['user_country']);
        $user_gender = htmlentities($_POST['user_gender']);
        $user_dob = htmlentities($_POST['user_dob']);
        
        $update = "UPDATE users SET f_name='$first_name',l_name='$last_name',user_name='$user_name',user_description='$user_description',relationship='$user_relationship',user_password='$user_password',user_email='$user_email', user_country='$user_country',user_gender='$user_gender',user_dob='$user_dob' WHERE user_id='$user_id'";
        $run_update = mysqli_query($connect, $update);
        if ($run_update){
           echo "<script>alert('Your Profile Updated Successfully!')</script>";
           echo "<script>window.open('edit_profile.php?user_id=$user_id', '_self')</script>"; 
        }
    }
?>
