<?php
    $connect = new mysqli("localhost", "root", "", "social_network") or die("Connection error");
    
    //function for inserting post
    
    function insertPost(){
        if (isset($_POST['post'])){
            global $connect;
            global $user_id;
            
            $content = htmlentities($_POST['content']);
            $upload_image = $_FILES['upload_image']['name'];
            $image_tmp = $_FILES['upload_image']['tmp_name'];
            $random_number = rand(1, 100);
            
            if (strlen($content) > 250){
                echo "<script>alert('Please use 250 0r below 250 characters!')</script>";
                echo "<script>window.open('home.php', '_self')</script>";
            }
            else {
                if (strlen($upload_image) >= 1 && strlen($content) >= 1){
                    move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
                    
                    $insert = "INSERT INTO posts (user_id, post_content, upload_image, post_date) VALUES('$user_id', '$content', '$upload_image.$random_number', NOW())";
                    $run_insert = mysqli_query($connect, $insert);
                    
                    if ($run_insert){                    
                        $update = "UPDATE users SET posts = 'yes' WHERE user_id = '$user_id'";
                        $run_update = mysqli_query($connect, $update);
                        
                        echo "<script>alert('Your Post Updated Successfully!')</script>";
                        echo "<script>window.open('home.php', '_self')</script>";
                    }    
                    exit();
                }
                else{
                    if ($content == '' && $upload_image == ''){
                        echo "<script>alert('Error Occured, Please Type a Post and or Upload Image!')</script>";
                        echo "<script>window.open('home.php', '_self')</script>"; 
                    }
                    else {
                        if ($content == ''){
                            move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
                            $insert = "INSERT INTO posts (user_id, post_content, upload_image, post_date) VALUES('$user_id', 'No', '$upload_image.$random_number', NOW())";
                            $run_insert = mysqli_query($connect, $insert);

                            if ($run_insert){
                                $update = "UPDATE users SET posts = 'yes' WHERE user_id = '$user_id'";
                                mysqli_query($connect, $update);
                                
                                echo "<script>alert('Your Post Updated Successfully!')</script>";
                                echo "<script>window.open('home.php', '_self')</script>";
                            } 
                            exit();
                        }
                        else {
                            $insert = "INSERT INTO posts (user_id, post_content, post_date) VALUES('$user_id', '$content', NOW())";
                            $run_insert = mysqli_query($connect, $insert);

                            if ($run_insert){
                                $update = "UPDATE users SET posts = 'yes' WHERE user_id = '$user_id'";
                                mysqli_query($connect, $update);
                                
                                echo "<script>alert('Your Post Updated Successfully!')</script>";
                                echo "<script>window.open('home.php', '_self')</script>";
                            }   
                        } 
                    }
                }
            }
        }
    }
    
    //function to show posts
    function get_posts(){
        global $connect;
        $per_page = 4;
        
        if (isset($_GET['page'])){
            $page = $_GET['page'];
        }
        else {
            $page = 1;
        }
        
        $start_from = ($page-1) * $per_page;
        $get_posts = "SELECT * FROM posts ORDER by 1 DESC LIMIT $start_from,$per_page";
        $run_posts = mysqli_query($connect, $get_posts);
        
        while ($row_posts = mysqli_fetch_array($run_posts)){
            $post_id = $row_posts['post_id'];
            $user_id = $row_posts['user_id'];
            $content = substr($row_posts['post_content'], 0, 40);
            $upload_image = $row_posts['upload_image'];
            $post_date = $row_posts['post_date'];
            
            $user = "SELECT * FROM users WHERE user_id = '$user_id' AND posts = 'yes'";
            $run_user = mysqli_query($connect, $user);
            $row_user = mysqli_fetch_array($run_user);
            
            $user_name = $row_user['user_name'];
            $user_image = $row_user['user_image'];
            
            //displaying posts
            if ($content == 'No' && strlen($upload_image) >= 1){
                echo"
                   <div class='row'>
                        <div class='col-sm-3'>
                        </div>
                        <div id='posts' class='col-sm-6'>
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
                                    <img id='posts-img' src='imagepost/$upload_image' style='height:500px;'/>
                                </div>
                            </div><br>
                            <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
                        </div>
                        <div class='col-sm-3'>
                        </div>
                   </div><br><br> 
                ";
            }
            else if (strlen($content) >= 1 && ($upload_image) >= 1) {
                echo"
                   <div class='row'>
                        <div class='col-sm-3'>
                        </div>
                        <div id='posts' class='col-sm-6'>
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
                                    <p>$content</p>
                                    <img id='posts-img' src='imagepost/$upload_image' style='height:500px;'/>
                                </div>
                            </div><br>
                            <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
                        </div>
                        <div class='col-sm-3'>
                        </div>
                   </div><br><br> 
                ";
            }
            else {
                echo"
                   <div class='row'>
                        <div class='col-sm-3'>
                        </div>
                        <div id='posts' class='col-sm-6'>
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
                                </div>
                            </div><br>
                            <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
                        </div>
                        <div class='col-sm-3'>
                        </div>
                   </div><br><br> 
                ";
            }
        }
       include ("pagination.php");
    }
    
    //View post
    function single_post(){
        if (isset($_GET['post_id'])){
            global $connect;
            $get_id = $_GET['post_id'];
            
            $get_post = "SELECT * FROM posts WHERE post_id = '$get_id'";
            $run_post = mysqli_query($connect, $get_post);
            $row_post = mysqli_fetch_array($run_post);
            
            $post_id = $row_post['post_id'];
            $user_id = $row_post['user_id'];
            $content = $row_post['post_content'];
            $upload_image = $row_post['upload_image'];
            $post_date = $row_post['post_date'];
            
            $user = "SELECT * FROM users WHERE user_id = '$user_id' AND posts = 'yes'";
            $run_user = mysqli_query($connect, $user);
            $row_user = mysqli_fetch_array($run_user);
            
            $user_name = $row_user['user_name'];
            $user_image = $row_user['user_image'];
            
            $user_comment = $_SESSION['user_email'];
            $get_comment = "SELECT * FROM users WHERE user_email = '$user_comment'";
            $run_comment = mysqli_query($connect, $get_comment);
            $row_comment = mysqli_fetch_array($run_comment);
            
            $user_comment_id = $row_comment['user_id'];
            $user_comment_name = $row_comment['user_name'];
            
            if (isset ($_GET['post_id'])){
                $post_id = $_GET['post_id'];
            }
            $get_post = "SELECT post_id FROM posts WHERE post_id = '$post_id'";
            $run_user = mysqli_query($connect, $get_post);
            
            $post_id = $_GET['post_id'];
            
            $post = $_GET['post_id'];
            $get_user = "SELECT * from posts WHERE post_id = '$post'";
            $run_user = mysqli_query($connect, $get_user);
            $row = mysqli_fetch_array($run_user);
            
            $p_id = $row['post_id'];
            
            if ($p_id != $post_id){
                echo "<script>alert('Error Occured!')</script>";
                echo "<script>window.open('home.php', '_self')</script>"; 
            }
            else {
                if ($content == 'No' && strlen($upload_image) >= 1){
                echo"
                   <div class='row'>
                        <div class='col-sm-3'>
                        </div>
                        <div id='posts' class='col-sm-6'>
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
                                    <img id='posts-img' src='imagepost/$upload_image' style='height:500px;'/>
                                </div>
                            </div><br>
                        </div>
                        <div class='col-sm-3'>
                        </div>
                   </div><br><br> 
                ";
            }
            else if (strlen($content) >= 1 && ($upload_image) >= 1) {
                echo"
                   <div class='row'>
                        <div class='col-sm-3'>
                        </div>
                        <div id='posts' class='col-sm-6'>
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
                                    <p>$content</p>
                                    <img id='posts-img' src='imagepost/$upload_image' style='height:500px;'/>
                                </div>
                            </div><br>
                        </div>
                        <div class='col-sm-3'>
                        </div>
                   </div><br><br> 
                ";
            }
            else {
                echo"
                   <div class='row'>
                        <div class='col-sm-3'>
                        </div>
                        <div id='posts' class='col-sm-6'>
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
                                </div>
                            </div><br>
                        </div>
                        <div class='col-sm-3'>
                        </div>
                   </div><br><br> 
                ";
            }//ending else
            
            include("comments.php");
                echo "
                  <div class='row'>
                    <div class='col-sm-6 col-sm-offset-3'>
                        <div class='panel panel-info'>
                            <div class='panel-body'>
                                <form action='' method='POST' class=form-inline>
                                    <textarea placeholder='Write your comment here!' class='pb-cmnt-texarea' name='comment'></textarea>
                                    <button class='btn btn-info pull-right' name='reply'>Comment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                  </div>
                ";
                
                if(isset($_POST['reply'])){
                    $comment = htmlentities($_POST['comment']);
                    
                    if ($comment == ""){
                        echo "<script>alert('Enter your comment!')</script>";
                        echo "<script>window.open('single.php?post_id=$post_id', '_self')</script>";
                    }
                    else {
                        $insert = "INSERT INTO comments (post_id, user_id, comment, comment_author, date) VALUES('$post_id', '$user_comment_id', '$comment', '$user_comment_name', NOW())";
                        $run_insert = mysqli_query($connect, $insert);
                        if ($run_insert){
                            echo "<script>alert('Your comment has been added!')</script>";
                            echo "<script>window.open('single.php?post_id=$post_id', '_self')</script>";
                        }
                    }
                }
            }
                    
        }
    }
    //User Posts
    function user_posts(){
        global $connect;
        if(isset($_GET['user_id'])){
            $user_id = $_GET['user_id'];
        }
        $get_posts = "SELECT * FROM posts WHERE user_id = '$user_id' ORDER by 1 DESC LIMIT 5";
        $run_posts = mysqli_query($connect, $get_posts);
        
        while ($row_posts = mysqli_fetch_array($run_posts)){
            $post_id = $row_posts['post_id'];
            $user_id = $row_posts['user_id'];
            $content = $row_posts['post_content'];
            $upload_image = $row_posts['upload_image'];
            $post_date = $row_posts['post_date'];
            
            $user = "SELECT * FROM users WHERE user_id = '$user_id' AND  posts = 'yes'";
            $run_user = mysqli_query($connect, $user);
            $row_user = mysqli_fetch_array($run_user);
            
            $user_name = $row_user['user_name'];
            $user_image = $row_user['user_image'];
            
            if (isset($_GET['user_id'])){
                $user_id = $_GET['user_id'];        
            }
            $get_user = "SELECT user_email FROM users WHERE user_id = '$user_id'";
            $run_user = mysqli_query($connect, $get_user);
            $row = mysqli_fetch_array($run_user);
            
            $user_email = $row['user_email'];
            
            $user = $_SESSION['user_email'];
            $get_user = "SELECT * FROM users WHERE user_email = '$user'";
            $run_user = mysqli_query($connect, $get_user);
            $row = mysqli_fetch_array($run_user);
            
            $user_id = $row['user_id'];
            $u_email = $row['user_email'];
            
            if ($u_email != $user_email){
                echo "<script>widow.open('my_posts.php?user_id=$user_id', '_self')</script>";
            }
            else{
               if ($content == 'No' && strlen($upload_image) >= 1){
                    echo"
                       <div class='row'>
                            <div class='col-sm-3'>
                            </div>
                            <div id='posts' class='col-sm-6'>
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
                                        <img id='posts-img' src='imagepost/$upload_image' style='height:500px;'/>
                                    </div>
                                </div><br>
                            </div>
                            <div class='col-sm-3'>
                            </div>
                       </div><br><br> 
                    ";
                }
                else if (strlen($content) >= 1 && ($upload_image) >= 1) {
                    echo"
                       <div class='row'>
                            <div class='col-sm-3'>
                            </div>
                            <div id='posts' class='col-sm-6'>
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
                                        <p>$content</p>
                                        <img id='posts-img' src='imagepost/$upload_image' style='height:500px;'/>
                                    </div>
                                </div><br>
                            </div>
                            <div class='col-sm-3'>
                            </div>
                       </div><br><br> 
                    ";
                }
                else {
                    echo"
                       <div class='row'>
                            <div class='col-sm-3'>
                            </div>
                            <div id='posts' class='col-sm-6'>
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
                                    </div>
                                </div><br>
                            </div>
                            <div class='col-sm-3'>
                            </div>
                       </div><br><br> 
                    ";
                } 
            }
            
        }
    }
    //Search Result
    function search_result(){
        global $connect;
        if (isset($_GET['search'])){
            $user_query = htmlentities($_GET['user_query']);
        }
        $get_result = "SELECT * FROM posts WHERE post_content like '%$user_query%' OR upload_image like '%$user_query%'";
        $run_result = mysqli_query($connect, $get_result);
        
        while ($row_result = mysqli_fetch_array($run_result)){
            $post_id = $row_result['post_id'];
            $user_id = $row_result['user_id'];
            $content = $row_result['post_content'];
            $upload_image = $row_result['upload_image'];
            $post_date = $row_result['post_date'];
            
            $user = "SELECT * FROM users WHERE user_id = '$user_id' AND posts = 'yes'";
            $run_user = mysqli_query($connect, $user);
            $row_user = mysqli_fetch_array($run_user);
            
            $user_name = $row_user['user_name'];
            $first_name = $row_user['f_name'];
            $last_name = $row_user['l_name'];
            $user_image = $row_user['user_image'];
            
            if ($content == 'No' && strlen($upload_image) >= 1){
                echo"
                    <div class='row'>
                        <div class='col-sm-3'>
                        </div>
                        <div id='posts' class='col-sm-6'>
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
                                    <img id='posts-img' src='imagepost/$upload_image' style='height:500px;'/>
                                </div>
                            </div><br>
                        </div>
                        <div class='col-sm-3'>
                        </div>
                    </div><br><br> 
                ";
            }
            else if (strlen($content) >= 1 && ($upload_image) >= 1) {
                echo"
                    <div class='row'>
                        <div class='col-sm-3'>
                        </div>
                        <div id='posts' class='col-sm-6'>
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
                                    <p>$content</p>
                                    <img id='posts-img' src='imagepost/$upload_image' style='height:500px;'/>
                                </div>
                            </div><br>
                        </div>
                        <div class='col-sm-3'>
                        </div>
                ";
            }
            else {
                echo"
                    <div class='row'>
                        <div class='col-sm-3'>
                        </div>
                        <div id='posts' class='col-sm-6'>
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
                                </div>
                            </div><br>
                        </div>
                        <div class='col-sm-3'>
                        </div>
                    </div><br><br> 
                ";
            } 
        }        
    }
    
    //Search Friend Function
    function search_user(){
        global $connect;
        
        if (isset($_GET['search_user_btn'])){
            $search_query = htmlentities($_GET['search_user']);
            $get_user = "SELECT * FROM users WHERE f_name like '%$search_query%' || l_name like '%$search_query%' || user_name like '%$search_query%'";
        }
        else {
            $get_user = "SELECT * FROM users";
        }
        
        $run_user = mysqli_query($connect, $get_user);
       
        while ($row_user = mysqli_fetch_array($run_user)){
            $user_id = $row_user['user_id'];
            $first_name = $row_user['f_name'];
            $last_name = $row_user['l_name'];
            $user_name = $row_user['user_name'];
            $user_image = $row_user['user_image'];
            
            echo "
                <div class='row'>
                    <div class='col-sm-3'>
                    </div>
                    <div class='col-sm-6' id='find_people'>
                        <div class='col-sm-4'>
                            <a href='user_profile.php?user_id=$user_id'>
                                <img src='users/$user_image' width='150px' height='140px' title='$user_name' style='margin:1px; float:left;'/>
                            </a>
                        </div><br><br>
                        <div class='col-sm-7'>
                            <a style='text-decoration:none; cursor='pointer' color:#3897f0;' href='user_profile.php?user_id=$user_id'>
                                <strong><h2>$first_name $last_name</h2></strong>
                            </a>
                        </div>
                        <div class='col-sm-3'>
                        </div>
                    </div>
                    <div class='col-sm-4'>
                    </div>
                </div><br>
            ";
        }
    }
