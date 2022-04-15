
<div class="user_main_container">
    <script src="/admin-dashboard/js/user-panel.js" defer></script>
    <?php if(!isset($_GET['user_id'])){?>
        <p class="user_title">Users</p>
        <?php 
            $users = $customRequest->getData(
                "SELECT c.customer_id, c.firstname, c.lastname, c.email, c.registration_date
                    FROM customer c
                    ORDER BY c.customer_id ASC
                    ");
    
            setTabTitle("Users Management");
        ?>
        <table class="user_table_content">
            <thead class="user_table_head">
                <tr class="user_head_item_container">
                    <th class="user_head_item">ID</th>
                    <th class="user_head_item">First name</th>
                    <th class="user_head_item">Last name</th>
                    <th class="user_head_item">Email</th>
                    <th class="user_head_item">Registered on</th>
                </tr>
            </thead>
            <tbody class="user_table_body">
                <?php foreach($users as $user) {?>
                    <?php
                        $formattedDate = date("F jS, Y \a\\t H:i:s", strtotime($user['registration_date']));
                    ?>
                    <tr data-id="<?php echo $user['customer_id'] ?>" class="user_body_item">
                        <td class="user_body_item_info">#<?php echo $user['customer_id'] ?></td>
                        <td class="user_body_item_info"><?php echo $user['firstname'] ?></td>
                        <td class="user_body_item_info"><?php echo $user['lastname'] ?></td>
                        <td class="user_body_item_info"><?php echo $user['email'] ?></td>
                        <td class="user_body_item_info"><?php echo $formattedDate ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <?php 
            $customerId = $_GET['user_id'];
            //$customerId = $db->con->query("SELECT customer_id FROM customer WHERE customer_id = {$userId}")->fetch_object()->customer_id;

            $customerInfos = $customRequest->getData(
                "SELECT c.firstname, c.lastname, c.email, c.verified, c.registration_date
                 FROM customer c 
                 WHERE customer_id = {$customerId}")[0];

            $formattedRegistrationDate = date("F jS, Y", strtotime($customerInfos['registration_date']));
        
            $verified = $customerInfos['verified'] ? "slug_verified" : "slug_not_verified";
            $verifiedText = $customerInfos['verified'] ? "Verified" : "Not Verified";
        ?>

        <div class="selected_user_global_content_container">
            <div class="selected_user_left_content_container">
                <img class="selected_user_image" src="/admin-dashboard/graphics/img/no_user_image.jpg" alt="customer_image">
                <div class="selected_user_content_container">
                    <div class="select_user_general_info_content_container">
                        <p class="selected_user_name"><?= $customerInfos['firstname'] ?> <?= $customerInfos['lastname'] ?></p>
                        <p class="selected_user_category_title">Customer</p>
                        <div class="selected_user_send_email_button">
                            <i class="selected_user_send_email_icon far fa-envelope"></i>
                            <p class="selected_user_send_email_title">Send Email</p>
                        </div>
                    </div>
                    <div class="selected_user_design_spacer_content_container">
                        <div class="selected_user_design_spacer">
                            <p class="selected_user_spacer_title">General</p>
                            <div class="selected_user_spacer_line"></div>
                        </div>
                        <div class="selected_user_left_category_container">
                            <div class="selected_user_title_verified_container">
                                <p class="selected_user_left_title">Account</p>
                                <p class="selected_user_left_slug <?= $verified ?>"><?= $verifiedText ?></p>
                            </div>
                            <p class="selected_user_left_info">User ID : <strong>#<?= $customerId ?></strong></p>
                            <p class="selected_user_left_info">Email : <strong><?= $customerInfos['email'] ?></strong></p>
                            <p class="selected_user_left_info">Registration date : <strong><?= $formattedRegistrationDate ?></strong></p>
                        </div>
                    </div>
                </div>
                <div class="selected_user_ban_user_button_container">
                    <div class="selected_user_ban_user_button">
                        <i class="selected_user_ban_icon fas fa-ban"></i>
                        <p class="selected_user_ban_user_title">Ban User</p>
                    </div>
                </div>
            </div>
    <?php } ?>
</div>