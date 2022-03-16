<div class="command_main_container">
    <p class="command_title">Commands</p>
    <?php
        $comments = $customRequest->getData(
            "SELECT uc.user_comment_id AS comment_id, uc.title, c.firstname, c.lastname, uc.created_at AS timestamp, uc.content
            FROM populate p
            LEFT JOIN (user_comment uc CROSS JOIN customer c) ON (uc.user_comment_id = p.user_comment_id AND c.customer_id = uc.customer_id)
            WHERE p.thread_id=1;
            "); 
    ?>
    <?php if(count($comments) > 0) {?>
        <?php foreach($comments as $comment) {?>
            <div class="comment_item">
                <div class="comment_item_foreground">
                    <p class="comment_title"><?php echo $comment['title'] ?></p>
                    <div class="d-flex d-row align-items-center mb-4 comment_info_container">
                        <i class="comment_user_icon fas fa-user-circle"></i>
                        <div class="info_content">
                            <p class="comment_publisher_info"><?php echo $comment['firstname'] ?> <?php echo $comment['lastname'] ?></p>
                            <p class="comment_publishing_timestamp"><?php echo $comment['timestamp'] ?></p>
                        </div>
                    </div>
                    <p class="comment_content"><?php echo $comment['content'] ?></p>
                </div>
                <div class="comment_item_background">
                    <div class="comment_delete_button_container">
                        <i class="delete_button_icon delete far fa-trash-alt"></i>
                        <button class="delete_comment_button" data-id="<?php echo $comment['comment_id'] ?>" value="">
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } else { ?>
        <p class="no_comments_text">No comments on this thread.</p>
    <?php } ?>
</div>