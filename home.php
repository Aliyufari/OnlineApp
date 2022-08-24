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
    <body>
        <div class="row">
            <div class="col-sm-12" id="insert_post">
                <center>
                    <form action="home.php?id=<?php echo $user_id?>" method="POST" id="f" enctype="multipart/form-data">
                        <textarea class="form-control" id="conntent" rows="4" name="content" placeholder="What's in your mind?"></textarea>
                        <label class="btn btn-warning" id="uploard_image_button"><input type="file" name="upload_image" size="30"/>Select Image</label>
                        <button id="btn-post" class="btn btn-success" name="post">Post</button>
                    </form>
                    <?php insertPost(); ?>
                </center>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <center><h2><strong>News Feed</strong></h2></center>
                <?php echo get_posts(); ?>
            </div>
        </div>
    </body>
</html>
