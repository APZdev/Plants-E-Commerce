<div class="user_main_container">
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
                <th class="user_head_item"></th>
            </tr>
        </thead>
        <tbody class="user_table_body">
            <?php foreach($users as $user) {?>
                <?php
                    $formattedDate = date("F jS, Y \a\\t H:i:s", strtotime($user['registration_date']));
                ?>
                
                <tr class="user_body_item">
                    <td class="user_body_item_info">#<?php echo $user['customer_id'] ?></td>
                    <td class="user_body_item_info"><?php echo $user['firstname'] ?></td>
                    <td class="user_body_item_info"><?php echo $user['lastname'] ?></td>
                    <td class="user_body_item_info"><?php echo $user['email'] ?></td>
                    <td class="user_body_item_info"><?php echo $formattedDate ?></td>
                    <td class="user_body_item_info"><i class="user_management_button fas fa-cog"></i></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>