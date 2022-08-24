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
        <title>Messages</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="fonts/font-awesome.min.css" type="text/css" media="all"/>
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
        <script src="bootstrap/jquery.min.js"></script>
        <script src="bootstrap/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="styles/home_style.css"/>
        <style>
            #scroll_messages{
                max-height: 500px;
                overflow: scroll;
            }
            #btn-msg{
                width: 20%;
                height: 28px;
                border-radius: 5px;
                margin: 5px;
                border: none;
                color: #fff;
                float: right;
                background: #2ecc71;
            }
            #select_user{
                max-height: 500px;
                overflow: scroll;
            }
            #green{
                background: #2ecc71;
                border-color: #27ae60;
                width: 45%;
                padding: 2.5px;
                border-radius: 3px;
                font-size: 16px;
                float: right;
                margin-bottom: 5px;
            }
            #blue{
                background: #3498db;
                border-color: #2980b9;
                width: 45%;
                padding: 2.5px;
                border-radius: 3px;
                font-size: 16px;
                float: left;
                margin-bottom: 5px; 
            }
        </style>
    </head>
    <body>
        <div class="row">
          <?php
          if (isset($_GET['user_id'])){
              global $connect;
              
              $get_id = $_GET['user_id'];
              $get_reciever = "SELECT * FROM users WHERE user_id = '$get_id'";
              $run_reciever = mysqli_query($connect, $get_reciever);
              $row_reciever = mysqli_fetch_array($run_reciever);
              
              $reciever_id = $row_reciever['user_id'];
              $reciever_name = $row_reciever['user_name'];
          }
            $user = $_SESSION['user_email'];
            $get_user = "SELECT * FROM users WHERE user_email = '$user'";
            $run_user = mysqli_query($connect, $get_user);
            $row_user = mysqli_fetch_array($run_user);
            
            $sender_id = $row_user['user_id'];
            $sender_name = $row_user['user_name'];
          ?>
            <div class="col-sm-3" id="select_user">
                <?php
                    $users = "SELECT * FROM users";
                    $run_users = mysqli_query($connect, $users);
                    
                    while ($row_users = mysqli_fetch_array($run_users)){
                        $user_id = $row_users['user_id'];
                         $user_name = $row_users['user_name'];
                        $first_name = $row_users['f_name'];
                        $last_name = $row_users['l_name'];
                        $user_image = $row_users['user_image'];
                       
                        echo "
                            <div class='container-fluid'>
                                <a style='text-decoration:none cursor:pointer; color:#3897f0:' href='messages.php?user_id=$user_id'>
                                    <img src='users/$user_image' class='img-circle' width='90px' height='80px' title='$user_name'/>
                                    <strong>&nbsp; $first_name $last_name</strong><br><br>
                                </a>
                            </div>
                        ";
                    }
                ?>
            </div>
            <div class="col-sm-6">
                <div class="load_msg" id="scroll_messages">
                    <?php
                        $select_msg = "SELECT * FROM user_messages WHERE (reciever_id = '$reciever_id' AND sender_id = '$sender_id')
                                OR (sender_id = '$reciever_id' AND reciever_id = '$sender_id') ORDER by 1 ASC";
                        $run_msg = mysqli_query($connect, $select_msg);
                        
                        while ($row_msg = mysqli_fetch_array($run_msg)){
                            $reciever = $row_msg['reciever_id'];
                            $sender = $row_msg['sender_id'];
                            $msg_body = $row_msg['msg_body'];
                            $msg_date = $row_msg['date'];
                    ?>
                        <div id="loaded_msg">
                            <p>
                            <?php
                                if ($reciever == $reciever_id AND $sender == $sender_id){
                                    echo "
                                        <div class='messages' id='blue' data-toggle='tooltip' title='$msg_date'>$msg_body</div>
                                        <br><br><br>
                                    ";
                                }
                                else if ($sender == $reciever_id AND $reciever == $sender_id){
                                    echo "
                                        <div class='messages' id='green' data-toggle='tooltip' title='$msg_date'>$msg_body</div>
                                        <br><br><br>
                                    ";
                                }
                            ?>
                            </p>
                        </div>
                    <?php    
                        }
                    ?>
                </div>
                <?php
                    if (isset($_GET['user_id'])){
                        $user_id = $_GET['user_id'];
                        if ($user_id == "new"){
                            echo"
                                <form>
                                    <center><h3>Select someone to start conversation</h3></center>
                                    <textarea disabled class='form-control' placeholder='Type your message'></textarea>
                                    <input type='submit' class='btn btn-default' disabled value='Send'/>
                                </form><br><br>
                            ";
                        }
                        else {
                            echo"
                                <form action='' method='POST'>
                                    <textarea name='msg_box' id='msg_textarea' class='form-control' placeholder='Type your message'></textarea>
                                    <input type='submit' name='send_msg' id='btn-msg' value='Send'/>
                                </form><br><br>
                            ";
                        }
                    }
                ?>
                <?php
                    if (isset($_POST['send_msg'])){
                        $msg = htmlentities($_POST['msg_box']);
                        if ($msg == ""){
                            echo "<h4 style='color:red; text-align:center'>Message was unable to send!</h4>";
                        }
                        else if (strlen ($msg) > 37){
                            echo "<h4 style='color:red; text-align:center'>Message is too long! Use 37 charcters</h4>"; 
                        }
                        else{
                            $insert = "INSERT INTO user_messages (reciever_id,sender_id,msg_body,date,msg_seen) VALUES ('$reciever_id','$sender_id','$msg',NOW(),'no')";
                            $run_insert = mysqli_query($connect, $insert);
                            //echo "<script>window.open('messages.php?user_id=$reciever_id', '_self')</script>";
                        }
                    }
                ?>
            </div>
            <div class="col-sm-3">
                <?php
                    if (isset($_GET['user_id'])){
                        global $connect;
                        $get_id = $_GET['user_id'];
                        
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
                    }    
                    if ($get_id == ""){
                            
                    }
                    else{
                        echo "
                            <div class='row'>
                                <div class='col-sm-3' style='margin-right: 10px;'>
                                </div>
                                <center>
                                    <div style='background:#e6e6e6;' class='col-sm-11'>
                                       <h2>Information About</h2>
                                       <img class='img-circle' src='users/$user_image' width='150px' height='150px'>
                                       <br><br>
                                       <ul class='list-group'>
                                           <li class='list-group-item' title='Username'><strong>$first_name $last_name</strong></li>
                                           <li class='list-group-item' style='color:grey;' title='User Status'><strong>$user_description</strong></li>
                                           <li class='list-group-item' title='User Gender'>$gender</li>
                                           <li class='list-group-item' title='User Country'>$country</li>
                                           <li class='list-group-item' title='User Registration Date'>$user_reg_date</li>
                                       </ul>
                                    </div
                                    <div class='col-sm-2'>
                                    </div>
                                </center>
                            </div>
                        ";
                    }
                ?>
            </div>
        </div>
        <script>
            var div = document.getElementById("scroll_messages");
            div.scrollTop = div.scrollHeight;
        </script>
    </body>
</html>
