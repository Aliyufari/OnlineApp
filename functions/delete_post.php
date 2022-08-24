<?php
    $connect = mysqli_connect("localhost", "root", "", "social_network") or die("Connection error");
    
    if (isset($_GET['delete'])){
        $post_id = $_GET['delete'];
        
        $delete_post = "DELETE FROM posts WHERE post_id = '$post_id'";
        $run_delete = mysqli_query($connect, $delete_post);
        
        if ($run_delete){
            echo "<script>alert('Your post has been deleted!')</script>";
            echo "<script>window.open('../home.php', '_self')</script>";
        }
    }


