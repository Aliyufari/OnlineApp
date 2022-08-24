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
    </head>
    <body>
        <div class="row">
            <div class="col-sm-12">
                <center><h2>Find New People</h2></center><br><br>
                <div class="row">
                    <div class="col-sm-4">    
                    </div>
                    <div class="col-sm-4">
                        <form class="search-form" action="">
                            <input type="text" placeholder="Search Friend" name="search_user"/>
                            <button class="btn btn-info" type="submit" name="search_user_btn">Search</button>
                        </form>
                    </div>
                    <div class="col-sm-4">    
                    </div>
                </div><br><br>
                <?php search_user(); ?>
            </div>
        </div>
    </body>
</html>
