<div class="thread_main_container">
    <script src="/admin-dashboard/js/thread-panel.js" defer></script>
    <?php if(!isset($_GET['thread_id'])){?>
        <?php
            $threads = $customRequest->getData(
                "SELECT t.thread_id, t.title, t.type, c.firstname, c.lastname
                FROM thread t 
                LEFT JOIN customer c ON c.customer_id = t.customer_id;
                "); 
        ?>
        <p class="thread_title">Thread</p>
        <?php foreach($threads as $thread) {?>
            <div class="thread_item_content_container">
                <?php $threadCommentCount = $db->con->query("SELECT COUNT(*) AS count FROM populate WHERE thread_id = {$thread['thread_id']};")->fetch_object()->count; ?>
                <i class="thread_delete_button far fa-trash-alt" data-id="<?php echo $thread['thread_id'] ?>"></i>
                <div class="thread_item" data-id="<?php echo $thread['thread_id'] ?>">
                    <div class="d-flex flex-row title_delete_button_container">
                        <p class="thread_title"><?php echo $thread['title'] ?></p>
                    </div>
                    <p class="thread_description"><?php echo $thread['type'] ?></p>
                    <div class="d-flex flex-row justify-content-between thread_info_container">
                        <div class="d-flex align-items-center flex-row user_container">
                            <i class="user_icon fas fa-user-circle"></i>
                            <p class="thread_publisher">Published by <span class="publisher_name"><?php echo $thread['firstname'] ?> <?php echo $thread['lastname'] ?></span></p>
                        </div>
                        <div class="d-flex flex-row align-items-center comment_amount_container">
                            <i class="comment_icon far fa-comment-alt"></i>
                            <p class="comment_amount"><?php echo $threadCommentCount ?>+</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } else { ?>
        <?php $theadName = $db->con->query("SELECT title FROM thread WHERE thread_id = {$_GET['thread_id']}")->fetch_object()->title; ?>
        <p class="thread_title"><?= $theadName ?></p>
        <?php
            $comments = $customRequest->getData(
                "SELECT uc.user_comment_id AS comment_id, uc.title, c.firstname, c.lastname, uc.created_at AS timestamp, uc.content
                FROM populate p
                LEFT JOIN (user_comment uc CROSS JOIN customer c) ON (uc.user_comment_id = p.user_comment_id AND c.customer_id = uc.customer_id)
                WHERE p.thread_id={$_GET['thread_id']};
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
    <?php } ?>
</div>