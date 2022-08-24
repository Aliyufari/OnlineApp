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
        <title>Find People</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="fonts/font-awesome.min.css" type="text/css" media="all"/>
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
        <script src="bootstrap/jquery.min.js"></script>
        <script src="bootstrap/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="styles/home_style.css"/>
        <style>
            #own_post{
                border: 3px solid #e6e6e6;
                padding: 20px 20px 40px 30px;
            }
            #post-img{
                height: 380px;
                width: 100%;
            }
        </style>
    </head>
    <body>
        <div class="row">
            <?php 
                if (isset($_GET['user_id'])){
                    $user_id = $_GET['user_id'];
                }
                if ($user_id < 0 || $user_id == ""){
                    echo "<script>window.open('home.php', '_self')</script>";
                }
                else{
            ?>
            <div class="col-sm-12">
                <?php 
                    if (isset($_GET['user_id'])){
                        global $connect;
                        $user_id = $_GET['user_id'];
                        
                        $select_user = "SELECT * FROM users WHERE user_id = '$user_id'";
                        $run_user = mysqli_query($connect, $select_user);
                        $row_user = mysqli_fetch_array($run_user);
                        
                        $use_rname = $row_user['user_name'];
                    }
                ?>
                <?php 
                    if (isset($_GET['user_id'])){
                        global $connect;
                        $user_id = $_GET['user_id'];
                        
                        $select_user = "SELECT * FROM users WHERE user_id = '$user_id'";
                        $run_user = mysqli_query($connect, $select_user);
                        $row_user = mysqli_fetch_array($run_user);
                        
                        $user_id = $row_user['user_id'];
                        $use_rname = $row_user['user_name'];
                        $user_image = $row_user['user_image'];
                        $first_name = $row_user['f_name'];
                        $last_name = $row_user['l_name'];
                        $user_description = $row_user['user_description'];
                        $country = $row_user['user_country'];
                        $gender = $row_user['user_gender'];
                        $user_reg_date = $row_user['user_reg_date'];
                        
                        echo "
                            <div class='row'>
                                <div class='col-sm-1'>
                                </div>
                                <center>
                                    <div style='background:#e6e6e6;' class='col-sm-3'>
                                       <h2>Information About</h2>
                                       <img class='img-circle' src='users/$user_image' width='150px' height='150px'>
                                       <br><br>
                                       <ul class='list-group'>
                                           <li class='list-group-item' title='Username'><strong>$first_name $last_name</strong></li>
                                           <li class='list-group-item' style='color:grey;' title='User Status'><strong>$user_description</strong></li>
                                           <li class='list-group-item' title='User Gender'><strong>$gender</strong></li>
                                           <li class='list-group-item' title='User Country'><strong>$country</strong></li>
                                           <li class='list-group-item' title='User Registration Date'><strong>$user_reg_date</strong></li>
                                       </ul>
                        ";
                        $user = $_SESSION['user_email'];
                        $select_user = "SELECT * FROM users WHERE user_email = '$user'";
                        $run_user = mysqli_query($connect, $select_user);
                        $row_user = mysqli_fetch_array($run_user);
                        
                        $user_own_id = $row_user['user_id'];
                        
                        if ($user_id == $user_own_id){
                            echo "
                              <a href='edit_profile.php?user_id=$user_own_id' class='btn btn-success'>Edit Profile</a><br><br><br>
                            ";
                        }
                                echo "
                                        </div>
                                    </center>
                                ";
                    }
                ?>
                <div class="col-sm-7">
                    <center><h1><strong><?php echo"$first_name $last_name"; ?></strong> Posts</h1></center>
                    <?php 
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
                        $first_name = $row_user['f_name'];
                        $last_name = $row_user['l_name'];
                        $user_image = $row_user['user_image'];
                        
                        if ($content == 'No' && strlen($upload_image) >= 1){
                            echo "
                                <div id='own_post'>
                                    <div class='row'>
                                        <div class='col-sm-2'>
                                            <p><img src='users/$user_image' class='img-circle' width='100px' height='100px'/></p>
                                        </div>
                                        <div class='col-sm-6'>
                                            <h3><a style='tect-decoration:none; corsor:pointer; color:#3897f0;' href='user_profile?user_id=$user_id'>$use_rname</a></h3>
                                            <h4 style='color:#000;'><small>Updated a post on</small><strong>$post_date</strong></h4>
                                        </div>
                                        <div class='col-sm-4'>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-sm-12'>
                                            <img id='post-img' src='imagepost/$upload_image' style='height:350px;'/>
                                        </div>
                                    </div><br>
                                ";
                                    $user = $_SESSION['user_email'];
                                    $select_user = "SELECT * FROM users WHERE user_email = '$user'";
                                    $run_user = mysqli_query($connect, $select_user);
                                    $row_user = mysqli_fetch_array($run_user);

                                    $user_own_id = $row_user['user_id'];
                                    if ($user_id == $user_own_id){
                                        echo "
                                          <a href='functions/delete_post.php?delete=$post_id' class='btn btn-danger' style='float:right;'>Delete</a>
                                          <a href='single.php?post_id=$post_id' class='btn btn-success' style='float:right; margin-right:5px;'>View</a>
                                        ";
                                    }
                                    else{
                                        echo "
                                           <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn  btn-info'>Comments</button></a>
                                        ";
                                    }
                               echo"    
                                </div><br><br>
                               ";
                        }
                        else if (strlen($content) == 1 && strlen($upload_image) >=1){
                            echo "
                                <div id='own_post' >
                                    <div class='row'>
                                        <div class='col-sm-2'>
                                            <p><img src='users/$user_image' class='img-circle' width='100px' height='100px'/></p>
                                        </div>
                                        <div class='col-sm-8'>
                                            <h3><a style='text-decoration:none: color:#3897f0;' href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
                                            <h4><small style='color:#000;'>Updated on: <strong> $post_date</strong></small></h4>
                                        </div>
                                        <div class='col-sm-4'>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-sm-12'>
                                            <p><h3>$content</h3></p>
                                            <img id='post-img' src='imagepost/$upload_image' style='height:350px;'/>
                                        </div>
                                    </div><br>
                                ";
                                    $user = $_SESSION['user_email'];
                                    $select_user = "SELECT * FROM users WHERE user_email = '$user'";
                                    $run_user = mysqli_query($connect, $select_user);
                                    $row_user = mysqli_fetch_array($run_user);

                                    $user_own_id = $row_user['user_id'];
                                    if ($user_id == $user_own_id){
                                        echo "
                                          <a href='functions/delete_post.php?delete=$post_id' class='btn btn-danger' style='float:right;'>Delete</a>
                                          <a href='edit_post.php?edit=$post_id' class='btn btn-info' style='float:right; margin-right:5px;'>Edit</a>
                                          <a href='single.php?post_id=$post_id' class='btn btn-success' style='float:right; margin-right:5px;'>View</a>
                                        ";
                                    }
                                    else{
                                        echo "
                                           <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn  btn-info'>Comments</button></a>
                                        ";
                                    }
                               echo"    
                                </div><br><br>
                               ";
                        }
                        else{
                            echo "
                                <div id='own_post' >
                                    <div class='row'>
                                        <div class='col-sm-2'>
                                            <p><img src='users/$user_image' class='img-circle' width='100px' height='100px'/></p>
                                        </div>
                                        <div class='col-sm-8'>
                                            <h3><a style='text-decoration:none: color:#3897f0;' href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
                                            <h4><small style='color:#000;'>Updated on: <strong> $post_date</strong></small></h4>
                                        </div>
                                        <div class='col-sm-4'>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-sm-12'>
                                            <p><h3>$content</h3></p>
                                        </div>
                                    </div><br>
                            ";
                                $user = $_SESSION['user_email'];
                                $select_user = "SELECT * FROM users WHERE user_email = '$user'";
                                $run_user = mysqli_query($connect, $select_user);
                                $row_user = mysqli_fetch_array($run_user);

                                $user_own_id = $row_user['user_id'];
                                if ($user_id == $user_own_id){
                                    echo "
                                        <a href='functions/delete_post.php?delete=$post_id' class='btn btn-danger' style='float:right;'>Delete</a>
                                        <a href='edit_post.php?edit=$post_id' class='btn btn-info' style='float:right; margin-right:5px;'>Edit</a>
                                        <a href='single.php?post_id=$post_id' class='btn btn-success' style='float:right; margin-right:5px;'>View</a>
                                    ";
                                }
                                else{
                                    echo "
                                        <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn  btn-info'>Comments</button></a>
                                    ";
                                }
                            echo"    
                            </div><br><br>
                            ";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
            <?php } ?>
    </body>
</html>
