<style>
    .pagination a{
        color: #000;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
        transition: background-color 0.3s;
    }
    .pagination a:hover:not(.active){
        background-color: #ddd;
    }
</style>
<?php
    $query = "SELECT * FROM posts";
    $result = mysqli_query($connect, $query);
    
    $total_posts = mysqli_num_rows($result);
    $total_pages = ceil($total_posts / $per_page); 
    
    echo"
        <center>
            <div class='pagination'>
                <a href='home.php?page=1'>First Page</a>
    ";
    for ($i = 1; $i <= $total_pages; $i++){
     echo "<a href='home.php?page=$i'>$i</a>";
    }
    echo "
                <a href='home.php?page=$total_pages'>Last Page</a>
            </div>
        </center>    
    ";

