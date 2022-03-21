<div class="command_main_container">
    <script src="/admin-dashboard/js/command-panel.js" defer></script>
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
</div>