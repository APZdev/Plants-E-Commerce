<div class="activity_main_container">
    <p class="activity_title">Activity</p>
    <?php 
        $logs = $customRequest->getData(
            "SELECT c.firstname, c.lastname, c.email, a.action, a.created_at AS timestamp
             FROM activity_log a
             LEFT JOIN (customer c) ON (c.customer_id = a.customer_id)
             LIMIT 100;
            ");
    ?>
    <table class="table_content">
        <thead class="table_head">
            <th class="head_item">First name</th>
            <th class="head_item">Last name</th>
            <th class="head_item">Email</th>
            <th class="head_item">Action</th>
            <th class="head_item">Timestamp</th>
        </thead>
        <tbody class="table_body">
            <?php foreach($logs as $log) {?>
            <tr class="body_item">
                <td class="body_item_info"><?php echo $log['firstname'] ?></td>
                <td class="body_item_info"><?php echo $log['lastname'] ?></td>
                <td class="body_item_info"><?php echo $log['email'] ?></td>
                <td class="body_item_info"><?php echo $log['action'] ?></td>
                <td class="body_item_info"><?php echo $log['timestamp'] ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>