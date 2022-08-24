<!doctype HTML>
<?php 
    session_start();
    include("includes/header.php");
    $post_content = '';
    if (!isset($_SESSION['user_email'])){
        header("location: index.php");
    }
?>
<html>
    <head>
        <title>Edit Post</title>
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
            <div class="col-sm-3">
            </div>
            <div class="col-sm-6">
                <?php
                    if (isset($_GET['edit'])){
                        $get_id = $_GET['edit'];
                        
                        $get_post = "SELECT * FROM posts WHERE post_id = '$get_id'";
                        $run_post = mysqli_query($connect, $get_post);
                        $row = mysqli_fetch_array($run_post);
                        
                        $post_content = $row['post_content'];
                    }
                ?>
                <form action="" method="POST" id="f">
                    <center><h2>Edit Your Post</h2></center><br>
                    <textarea class="form-control" cols="83" rows="4" name="content"><?php echo $post_content ?></textarea><br>
                    <input type="submit" name="update" value="Update Post" class="btn btn-info"/>
                </form>
                <?php 
                if (isset($_POST['update'])){
                    $content =  $_POST['content'];
                     
                    $update_post = "UPDATE posts SET post_content = '$content' WHERE post_id = '$get_id'";
                    $run_update = mysqli_query($connect, $update_post);
                    
                    if ($run_update == 1){
                        echo "<script>alert('Your post has been Updated!')</script>";
                        echo "<script>window.open('home.php', '_self')</script>";
                    }
                }
                ?>
            </div>
            <div class="col-sm-3">
            </div>
        </div>
    </body>
</html>
