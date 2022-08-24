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
        <title>View your Post</title>
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
            <div class="col-sm-12">
                <center><h2>Comments</h2></center>
                <?php single_post(); ?>
            </div>
        </div> 
    </body>
</html>