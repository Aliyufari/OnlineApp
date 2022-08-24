<?php
    include("includes/connection.php");
    include("functions/functions.php");
?>
<style>
    
</style>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
            </button>
            <a href="home.php" class="navbar-brand" id="logo"><strong>AA Social Network</strong></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                    $user = $_SESSION['user_email'];
                    $get_user = "SELECT * FROM users WHERE user_email = '$user'";
                    $run_user = mysqli_query($connect, $get_user);
                    $row = mysqli_fetch_array($run_user);
                    
                    $user_id = $row['user_id'];
                    $user_name = $row['user_name'];
                    $first_name = $row['fname'];
                    $last_name = $row['lname'];
                    $user_description = $row['user_description'];
                    $user_relationship = $row['relationship'];
                    $user_password = $row['user_password'];
                    $user_email = $row['user_email'];
                    $user_country = $row['user_country'];
                    $user_gender = $row['user_gender'];
                    $user_dob = $row['user_dob'];
                    $user_image = $row['user_image'];
                    $user_cover = $row['user_cover'];
                    $recovery_account = $row['recovery'];
                    $user_reg_date = $row['user_reg_date'];
                    
                    $user_posts = "SELECT * FROM posts WHERE user_id = '$user_id'";
                    $run_posts = mysqli_query($connect, $user_posts);
                    $posts = mysqli_num_rows($run_posts);
                ?>
                <li><a href='profile.php?<?php echo"user_id=$user_id"?>'><span class='glyphicon glyphicon-user'></span>&nbsp;<?php echo"$first_name"; ?></a></li>
                <li><a href='home.php'><span class='glyphicon glyphicon-home'></span>&nbsp;Home</a></li>
                <li><a href='members.php'><span class='glyphicon glyphicon-search'></span>&nbsp;Find People</a></li>
                <li><a href='messages.php?user_id=new'><span class='glyphicon glyphicon-envelope'></span>&nbsp;Messages</a></li>
                <?php 
                    echo"
                        <li class='dropdown'>
                            <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true'
                            aria-expanded='false'><span> <i class='glyphicon glyphicon-chevron-down'></i></span></a>
                            <ul class='dropdown-menu'>
                                <li><a href='my_posts.php?user_id=$user_id'><span class='glyphicon glyphicon-pencil'></span>&nbsp;My Posts <span class='badge badge-secondary'>$posts</span</a></li>
                                <li><a href='edit_profile.php?user_id=$user_id'><span class='glyphicon glyphicon-cog'></span>&nbsp;Edit Account</a></li>
                                <li role='separator' class='divider'></li>
                                <li><a href='logout.php'><span class='glyphicon glyphicon-log-out'></span>&nbsp;Logout</a></li>
                            </ul>
                        </li>
                    ";
                ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <form class="navbar-form navbar-left" action="search_result.php" method="GET">
                        <div class="form-group">
                            <input type="text" class="form-control" name="user_query" placeholder="Search"/>
                        </div>
                        <button type="submit" class="btn btn-info" name="search">Search</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

