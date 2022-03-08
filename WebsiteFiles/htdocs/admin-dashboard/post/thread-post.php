<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        require_once('./../../utilities.php');

        if(isset($_POST["remove_comment"]) && $_POST["remove_comment"])
        {
            $commentId = $_POST['comment_id'];

            $query = "DELETE FROM populate WHERE user_comment_id ={$commentId};";
            $query .="DELETE FROM user_comment WHERE user_comment_id={$commentId};";
            
            $result = $db->con->multi_query($query);
            
            //Refresh page in JS success .then()
        }
        else if(isset($_POST["remove_thread"]) && $_POST["remove_thread"])
        {
            $threadId = $_POST['thread_id'];

            //$query = "DELETE FROM populate WHERE thread_id ={$threadId};";
            //$query .="DELETE FROM user_comment WHERE thread_id={$userCommentId};";
            //$query .="DELETE FROM thread WHERE thread_id={$threadId};";
            
            //$result = $db->con->multi_query($query);

            //Refresh page in JS success .then()
        }
    }
?>