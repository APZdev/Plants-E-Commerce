<div class="activity_main_container">
    <?php 
        function isTypeButtonSelected($getName)
        {
            echo $_GET['type'] == $getName ? "selected" : "";
        }
    ?>
    <div class="activity_navbar_container">
        <a href="http://localhost/admin-dashboard/dashboard.php?page=activity-panel&type=list" class="<?php isTypeButtonSelected("list"); ?> activity_navbar_title">List</a>
        <a href="http://localhost/admin-dashboard/dashboard.php?page=activity-panel&type=graph"  class="<?php isTypeButtonSelected("graph"); ?> activity_navbar_title">Graph</a>
    </div>
    <?php if($_GET['type'] == "list") {?>
        <?php 
            $logs = $customRequest->getData(
                "SELECT c.firstname, c.lastname, c.email, a.action, a.created_at AS timestamp
                FROM activity_log a
                LEFT JOIN (customer c) ON (c.customer_id = a.customer_id)
                ORDER BY a.created_at DESC
                LIMIT 100
                ");
        ?>
        <p class="activity_title">Activity : List</p>
        <?php setTabTitle("Activity : List"); ?>
        <table class="activity_table_content">
            <thead class="activity_table_head">
                <th class="activity_head_item">First name</th>
                <th class="activity_head_item">Last name</th>
                <th class="activity_head_item">Email</th>
                <th class="activity_head_item">Action</th>
                <th class="activity_head_item">Timestamp</th>
            </thead>
            <tbody class="activity_table_body">
                <?php foreach($logs as $log) {?>
                    <tr class="activity_body_item">
                        <td class="activity_body_item_info"><?php echo $log['firstname'] ?></td>
                        <td class="activity_body_item_info"><?php echo $log['lastname'] ?></td>
                        <td class="activity_body_item_info"><?php echo $log['email'] ?></td>
                        <td class="activity_body_item_info"><?php echo $log['action'] ?></td>
                        <td class="activity_body_item_info"><?php echo $log['timestamp'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else if($_GET['type'] == "graph") { ?>
        <?php 
            $logs = $customRequest->getData(
                "SELECT c.firstname, c.lastname, c.email, a.action, a.created_at AS timestamp
                FROM activity_log a
                LEFT JOIN (customer c) ON (c.customer_id = a.customer_id)
                ORDER BY a.created_at DESC
                ");
        ?>
        <div class="graph_section_container">
            <script src="/admin-dashboard/js/activity-graph.js" defer></script>
            <p class="activity_title">Activity : Graph</p>
            <?php setTabTitle("Activity : Graph"); ?>
            <?php foreach($logs as $log) {?>
                <p class="activity_action" style="display: none;"><?php echo $log['action']?></p>
            <?php } ?>
            <canvas class="graph_canvas">
                    
            </canvas>
        </div>
    <?php } ?>    
</div>