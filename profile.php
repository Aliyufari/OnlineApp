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
        <?php
            $user = $_SESSION['user_email'];
            $get_user = "SELECT * FROM users WHERE user_email = '$user'";
            $run_user = mysqli_query($connect, $get_user);
            $row = mysqli_fetch_array($run_user);
            
            $user_name = $row['user_name'];
        ?>
        <title><?php echo "$user_name"; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="fonts/font-awesome.min.css" type="text/css" media="all"/>
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
        <script src="bootstrap/jquery.min.js"></script>
        <script src="bootstrap/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="styles/home_style.css"/>
    </head>
    <style>
        #cover-img{
            height: 400px;
            width:  100%; 
        }
        #profile-img{
            position: absolute;
            top: 160px;
            left: 40px;
        }
        #update_profile{
            position: relative;
            top: -33px;
            left: 93px;
            cursor: pointer;
            border-radius: 4px;
            background: rgba(0,0,0,0.1);
            transform: translate(-50%,-50%);
        }
        #button_profile{
            position: absolute;
            top: 80%;
            left: 50%;
            cursor: pointer;
            transform: translate(-50%,-50%);
        }
        #own_posts{
            border: 3px solid #e6e6e6;
            padding: 20px 20px 40px 20px;
        }
        #posts-img{
            padding: 5px 10px 0 0;
            min-width: 102%;
            max-width: 50%; 
        }
    </style>
    <body>
        <div class="row">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8">
                <?php
                    echo"
                       <div>
                            <div><img id='cover-img' class='img-rounded' src='cover/$user_cover' alt='cover'/></div>
                            <form action='profile.php?user_id = $user_id' method='POST' enctype='multipart/form-data'>
                                <ul class='nav pull-left' style='position:absolute; top:10px; left:40px;'>
                                    <li class='dropdown'>
                                        <button class='dropdown-toggle btn btn-default' data-toggle='dropdown'>Change Cover</button>
                                        <div class='dropdown-menu'>
                                            <center>
                                                <p>Click <strong>Select Cover</strong> and then click the <br> <strong></strong>Update Cover</strong></p>
                                                <label class='btn btn-info'>Select Cover <input type='file' name='user_cover' size='60'/></label>
                                                <br><br>
                                                <button name='submit' class='btn btn-info'>Update Cover</button>
                                            </center>
                                        </div>
                                    </li>
                                </ul>
                            </form>
                       </div>
                       <div id='profile-img'>
                            <img src='users/$user_image' alt='Profile' class='img-circle' width='180px' height='185px' style='border:3px solid #999;'/>
                            <form action='profile.php?user_id = $user_id' method='POST' enctype='multipart/form-data'>
                                <label id='update_profile'>Select Profile <input type='file' name='user_image' size='60'/></label>
                                <br><br>
                                <button id='button_profile' name='update' class='btn btn-info'>Update Profile</button>
                            </form>
                       </div><br>
                    ";
                ?>
                <?php   //Update Cover Image
                    if (isset($_POST['submit'])){
                        
                        $user_cover = $_FILES['user_cover']['name'];
                        $image_tmp = $_FILES['user_cover']['tmp_name'];
                        $random_number = rand(1, 100);
                        
                        if ($user_cover == ''){
                            echo "<script>alert('Please Select a Cover Image!')</script>";
                            echo "<script>window.open('profile.php?user_id = $user_id', '_self')</script>";
                            exit();
                        }
                        else {
                            move_uploaded_file($image_tmp, "cover/$user_cover.$random_number");
                            $update = "UPDATE users SET user_cover = '$user_cover.$random_number' WHERE user_id = '$user_id'";
                            $run_update = mysqli_query($connect, $update);
                            
                            if ($run_update){
                                echo "<script>alert('Your Cover Image has been Updated Successfully!')</script>";
                                echo "<script>window.open('profile.php?user_id = $user_id', '_self')</script>";
                            }
                        }
                    }
                ?>
            </div>
            <?php   //Update Profile Image
                if (isset($_POST['update'])){
                        
                    $user_image = $_FILES['user_image']['name'];
                    $image_tmp = $_FILES['user_image']['tmp_name'];
                    $random_number = rand(1, 100);
                        
                    if ($user_image == ''){
                        echo "<script>alert('Please Select a Profile Image by Clicking on Your Profile Image!')</script>";
                        echo "<script>window.open('profile.php?user_id = $user_id', '_self')</script>";
                        exit();
                    }
                    else {
                    move_uploaded_file($image_tmp, "users/$user_image.$random_number");
                    $update = "UPDATE users SET user_image = '$user_image.$random_number' WHERE user_id = '$user_id'";
                    $run_update = mysqli_query($connect, $update);
                            
                        if ($run_update){
                            echo "<script>alert('Your Profile Image has been Updated Successfully!')</script>";
                            echo "<script>window.open('profile.php?user_id = $user_id', '_self')</script>";
                        }
                    }
                }
                ?>
            <div class="col-sm-2">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-2" style="background:#e6e6e6; text-align:center; left:1.8%; border-radius:0px 30px 0px 30px;">
                <?php
                   echo"
                      <center><h2><strong>About</strong></h2></center><hr>  
                      <center><h4><strong>$first_name $last_name</strong></h4></center>
                      <p><strong><i style='color:grey;'>$user_description</i></strong></p><br>
                      <p><strong>Relationship: </strong>$user_relationship</p><br>
                      <p><strong>Gender: </strong>$user_gender</p><br>
                      <p><strong>Lives In: </strong>$user_country</p><br>
                      <p><strong>Date of Birth: </strong>$user_dob</p><br>
                      <p><strong>Member Since: </strong>$user_reg_date</p><br>
                   ";                 
                ?>
            </div>
            <div class="col-sm-6" style="margin-left:0.9%">
                <!--Displaying user posts-->
                <?php
                    global $connect;
      /*  $per_page = 4;
        
        if (isset($_GET['page'])){
            $page = $_GET['page'];
        }
        else {
            $page = 1;
        }
        
        $start_from = ($page-1) * $per_page;
       */
                    if (isset($_GET['user_id'])){
                        $user_id = $_GET['user_id'];
                    }
                    
                    $get_posts = "SELECT * FROM posts WHERE user_id = '$user_id' ORDER by 1 DESC LIMIT 4";
                    $run_posts = mysqli_query($connect, $get_posts);
                    
                    while ($row_posts = mysqli_fetch_array($run_posts)){
                        
                        $post_id = $row_posts['post_id'];
                        $user_id = $row_posts['user_id'];
                        $content = $row_posts['post_content'];
                        $upload_image = $row_posts['upload_image'];
                        $post_date = $row_posts['post_date'];
                        
                        $user = "SELECT * FROM users WHERE user_id = '$user_id' AND posts = 'yes'";
                        $run_user = mysqli_query($connect, $user);
                        $row_user = mysqli_fetch_array($run_user);
                        
                        $user_name = $row_user['user_name'];
                        $user_image = $row_user['user_image'];
                        
                        //Displaying the posts
                        if ($content == "No" && strlen($upload_image) >=1){
                            echo "
                                <div id='own_posts' >
                                    <div class='row'>
                                        <div class='col-sm-2'>
                                            <p><img src='users/$user_image' class='img-circle' width='100px' height='100px'/></p>
                                        </div>
                                        <div class='col-sm-8'>
                                            <h3><a style='text-decoration:none: color:#3897f0;' href='user_profile.php?user_id = $user_id'>$user_name</a></h3>
                                            <h4><small style='color:#000;'>Updated on: <strong> $post_date</strong></small></h4>
                                        </div>
                                        <div class='col-sm-4'>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-sm-12'>
                                            <img id='posts-img' src='imagepost/$upload_image' style='height:350px;'/>
                                        </div>
                                    </div><br>
                                    <a href='functions/delete_post.php?delete=$post_id' class='btn btn-danger' style='float:right;'>Delete</a>
                                    <a href='single.php?post_id=$post_id' class='btn btn-success' style='float:right; margin-right:5px;'>View</a>
                                </div><br><br><br>
                            ";
                        }
                        else if (strlen($content) == 1 && strlen($upload_image) >=1){
                            echo "
                                <div id='own_posts' >
                                    <div class='row'>
                                        <div class='col-sm-2'>
                                            <p><img src='users/$user_image' class='img-circle' width='100px' height='100px'/></p>
                                        </div>
                                        <div class='col-sm-8'>
                                            <h3><a style='text-decoration:none: color:#3897f0;' href='user_profile.php?user_id = $user_id'>$user_name</a></h3>
                                            <h4><small style='color:#000;'>Updated on: <strong> $post_date</strong></small></h4>
                                        </div>
                                        <div class='col-sm-4'>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-sm-12'>
                                            <p><h3>$content</h3></p>
                                            <img id='posts-img' src='imagepost/$upload_image' style='height:350px;'/>
                                        </div>
                                    </div><br>
                                    <a href='functions/delete_post.php?delete=$post_id' class='btn btn-danger' style='float:right;'>Delete</a>
                                    <a href='edit_post.php?edit=$post_id' class='btn btn-info' style='float:right; margin-right:5px;'>Edit</a>
                                    <a href='single.php?post_id=$post_id' class='btn btn-success' style='float:right; margin-right:5px;'>View</a>
                                </div><br><br><br>
                            ";
                        }
                        else{
                            echo "
                                <div id='own_posts' >
                                    <div class='row'>
                                        <div class='col-sm-2'>
                                            <p><img src='users/$user_image' class='img-circle' width='100px' height='100px'/></p>
                                        </div>
                                        <div class='col-sm-8'>
                                            <h3><a style='text-decoration:none: color:#3897f0;' href='user_profile.php?user_id = $user_id'>$user_name</a></h3>
                                            <h4><small style='color:#000;'>Updated on: <strong> $post_date</strong></small></h4>
                                        </div>
                                        <div class='col-sm-4'>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-sm-2'>
                                        </div>
                                        <div class='col-sm-12'>
                                            <p><h3>$content</h3></p>
                                        </div>
                                        <div class='col-sm-4'>
                                        </div>
                                    </div><br><br>
                            ";
                           
                            global $connect;  
                            if (isset($_GET['user_id'])){
                                $user_id = $_GET['user_id'];
                            }

                            $get_posts = "SELECT user_email FROM users WHERE user_id = '$user_id'";
                            $run_user = mysqli_query($connect, $get_posts);
                            $row = mysqli_fetch_array($run_user);
                            
                            $user_email = $row['user_email'];
                            
                            $user = $_SESSION['user_email'];
                            $get_user = "SELECT * FROM users WHERE user_email = '$user'";
                            $run_user = mysqli_query($connect, $get_user);
                            $row = mysqli_fetch_array($run_user);
                            
                            $user_id = $row['user_id'];
                            $u_email = $row['user_email'];
                            
                            if ($u_email != $user_email){
                                echo "<script>window.open('profile.php?user_id = $user_id', '_self')</script>";
                            }
                            else{ 
                                echo "
                                <a href='functions/delete_post.php?delete=$post_id' class='btn btn-danger' style='float:right;'>Delete</a>
                                <a href='edit_post.php?edit=$post_id' class='btn btn-info' style='float:right; margin-right:5px;'>Edit</a>
                                <a href='single.php?post_id=$post_id' class='btn btn-success' style='float:right; margin-right:5px;'>View</a>
                                </div><br><br><br>
                                ";
                            }
                        }
                        
                    } 
                    //include("functions/pagination.php");
                ?>
            </div>
            <div class="col-sm-2">
            </div>
        </div>
        </div
    </body>
</html>
                    
