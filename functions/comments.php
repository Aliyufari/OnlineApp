<?php
    $get_id = $_GET['post_id'];
    
    $get_comment = "SELECT * FROM comments WHERE post_id = '$get_id' ORDER by 1 DESC";
    $run_comment = mysqli_query($connect, $get_comment);
    
    while ($row_comment = mysqli_fetch_array($run_comment)){
        $comment = $row_comment['comment'];
        $comment_author = $row_comment['comment_author'];
        $date = $row_comment['date'];
        
        echo "
            <div class='row'>
                <div class='col-sm-6 col-sm-offset-3'>
                    <div class='panel panel-info'>
                        <div class='panel-body'>
                            <div>
                                <h4><strong>$comment_author</strong><i> commented on </i>$date</h4>
                                <p class='text-primary' style='margin-left:5px; font-size:20px;'>$comment</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ";
    }
    


