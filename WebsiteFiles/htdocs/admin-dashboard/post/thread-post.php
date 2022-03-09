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

            $comments = $customRequest->getData("SELECT user_comment_id AS comment_id FROM populate WHERE thread_id={$threadId};");

            //Delete all thread comment associations
            $db->con->multi_query("DELETE FROM populate WHERE thread_id ={$threadId};");
            
            //Delete every comment from the thread
            foreach($comments as $comment)
            {
                $db->con->multi_query("DELETE FROM user_comment WHERE thread_id={$comment['comment_id']};");
            }

            $db->con->multi_query("DELETE FROM thread WHERE thread_id ={$threadId};");

            //Refresh page in JS success .then()
        }
    }
?>