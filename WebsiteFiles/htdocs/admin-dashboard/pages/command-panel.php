<div class="command_main_container">
    <script src="/admin-dashboard/js/command-panel.js" defer></script>
    <?php if(!isset($_GET['command_id'])){?>
    <div class="command_pending_container">
        <p class="command_title">Pending Commands</p>
        <?php
            $commands = $customRequest->getData(
                "SELECT c.command_id, c.created_at, c.card_last_digits FROM command c;"); 
        ?>
        <?php if(count($commands) > 0) {?>
            <?php foreach($commands as $command) {?>
                <?php 
                    $totalPrice = 0;
                    $productOrders = $customRequest->getData(
                        "SELECT po.quantity, po.product_id, po.product_order_id 
                         FROM product_order po
                         WHERE po.command_id = {$command['command_id']};"); 
                    
                    foreach($productOrders as $productOrder) {
                        $product = $customRequest->getData(
                            "SELECT p.price_excl_tax, p.tax_id 
                             FROM product p
                             WHERE p.product_id = {$productOrder['product_id']} LIMIT 1")[0]; 

                        $taxRate = $db->con->query("SELECT rate FROM tax WHERE tax_id = {$product['tax_id']}")->fetch_object()->rate;
                        $shippingCost = $db->con->query("SELECT price FROM shipping_cost WHERE product_order_id = {$productOrder['product_order_id']}")->fetch_object()->price;

                        $totalPrice += $productOrder['quantity'] * $product['price_excl_tax'] * (1 + $taxRate / 100);
                        $formattedDate = date("F jS, Y", strtotime($command['created_at']));
                    }

                    $totalPrice += $shippingCost;
                ?>
                <div class="command_item" data-id="<?= $command['command_id'] ?>">
                    <img src="../../website/graphics/img/logo.png" alt="command_item_image" class="command_image">
                    <div class="command_info_container">
                        <p class="command_ordered_date">Ordered on <strong><?= $formattedDate ?></strong></p>
                        <p class="command_payment_card_digits">Payment card  : <strong>****<?= $command['card_last_digits'] ?></strong></p>
                        <p class="command_total_price">Total : <strong><?= $totalPrice ?> $</strong></p>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <p class="no_comments_text">No comments on this thread.</p>
        <?php } ?>
    </div>
    <div class="command_finished_container">
        <p class="command_title">Finished Commands</p>
    </div>
    <?php } else { ?>
        <?php 
            $commandId = $_GET['command_id'];
            $customerId = $db->con->query("SELECT customer_id FROM reserve WHERE command_id = {$commandId}")->fetch_object()->customer_id;
            
            $command = $customRequest->getData(
                "SELECT c.command_id, c.created_at, c.card_last_digits, c.facturation_address_id
                 FROM command c 
                 WHERE command_id = {$commandId} LIMIT 1")[0];

            $formattedOrderDate = date("F jS, Y", strtotime($command['created_at']));

            $deliveryAddress = $customRequest->getData(
                "SELECT da.firstname, da.lastname, da.city, da.street, da.zip_code, da.more_info, da.phone_number  
                 FROM delivery_address da 
                 WHERE customer_id = {$customerId}")[0];

            $facturationAddress = $customRequest->getData(
                "SELECT firstname, lastname, city, street, zip_code, email, more_info, phone_number  
                FROM facturation_address
                WHERE facturation_address_id = {$command['facturation_address_id']}")[0];

            $deliveryInfo = $customRequest->getData(
                "SELECT status, tracking_number, delivery_line_link
                FROM delivery
                WHERE command_id = {$commandId}")[0];
        ?>
        <div class="command_details_container">
            <p class="command_page_title">Command details</p>
            <p class="selected_command_title command_order_date">Ordered on <?= $formattedOrderDate ?></p>
            <div class="command_details_content_container">
                <div class="delivery_info_container">
                    <div class="delivery_address_container">
                        <p class="selected_command_title delivery_address_title">Delivery Address</p>
                        <p class="command_info customer_fullname"><?= $deliveryAddress['firstname'] ?> <?= $deliveryAddress['lastname'] ?></p>
                        <p class="command_info customer_street"><?= $deliveryAddress['street'] ?></p>
                        <p class="command_info customer_more_info"><?= $deliveryAddress['more_info'] ?></p>
                        <p class="command_info city_zipcode"><?= $deliveryAddress['city'] ?>, <?= $deliveryAddress['zip_code'] ?></p>
                    </div>
                    <div class="delivery_status_container">
                        <p class="selected_command_title delivery_status_title">Status</p>
                        <p class="delivery_status"><?= $deliveryInfo['status'] ?></p>
                        <p class="selected_command_title tracking_number_title">Tracking Number</p>
                        <a href="<?= $deliveryInfo['delivery_line_link'] ?>" class="tracking_number_link"><?= $deliveryInfo['tracking_number'] ?></a>
                    </div>
                </div>
                <div class="command_spacer"></div>
                <?php 
                    $totalPrice = 0;
                    $productOrders = $customRequest->getData(
                        "SELECT quantity, product_id, product_order_id 
                        FROM product_order
                        WHERE command_id = {$commandId};"); 
                ?>
                <?php foreach($productOrders as $productOrder) {?>
                    <?php 
                        $product = $customRequest->getData(
                            "SELECT name, short_description, price_excl_tax, tax_id, image_id
                             FROM product
                             WHERE product_id = {$productOrder['product_id']} LIMIT 1")[0]; 
        
                        $taxRate = $db->con->query("SELECT rate FROM tax WHERE tax_id = {$product['tax_id']}")->fetch_object()->rate;
                        $shippingCost = $db->con->query("SELECT price FROM shipping_cost WHERE product_order_id = {$productOrder['product_order_id']}")->fetch_object()->price;
                        $productImage = $db->con->query("SELECT url FROM image WHERE image_id = {$product['image_id']}")->fetch_object()->url;

                        $totalPrice += $productOrder['quantity'] * $product['price_excl_tax'] * (1 + $taxRate / 100);
                        $formattedDate = date("F jS, Y", strtotime($command['created_at']));
                    ?>
                    <div class="product_order_item">
                        <img src="<?= $productImage ?>" alt="product_image" class="product_order_image">
                        <div class="product_order_info_container">
                            <p class="product_order_name"><?= $product['name'] ?></p>
                            <div class="d-flex short_desc_info_container">
                                <p class="selected_command_title short_desc_title">Description : </p>
                                <p class="command_info short_desc"><?= $product['short_description'] ?></p>
                            </div>
                            <div class="d-flex quantity_info_container">
                                <p class="selected_command_title quantity_title">Quantity :</p>
                                <p class="command_info quantity_value"><?= $productOrder['quantity'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php $totalPrice += $shippingCost; ?>
            </div>
        </div>
    <?php } ?>
</div>