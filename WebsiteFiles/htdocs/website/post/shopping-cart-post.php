<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        require_once('./../../utilities.php');

        if(isset($_POST["get_shopping_cart_items_data"]) && $_POST["get_shopping_cart_items_data"])
        {
            $productIds = $_POST['productids'];
            $productQuantities = $_POST['quantities'];

            $idsArray = explode(":", $productIds);
            $quantitiesArray = explode(":", $productQuantities);


            $output = 
            "
                <div class='shopping_cart_product_item_container'>
            ";

            $subTotalPrice = 0;
            $totalShippingCost = 0;
            for($i = 0; $i < count($idsArray) - 1; $i++)
            {
                $productId = $idsArray[$i];
                $quantity = $quantitiesArray[$i];

                $product = $customRequest->getData(
                    "SELECT p.name, p.price_excl_tax, p.stock_quantity, p.shipping_cost, t.rate AS tax_rate, i.url AS image_url
                    FROM product p 
                    LEFT JOIN (tax t CROSS JOIN image i) ON (p.tax_id = t.tax_id AND p.image_id = i.image_id)
                    WHERE p.product_id = {$productId};
                ")[0];

                $taxAddedPrice = $product['price_excl_tax'] + ($product['price_excl_tax'] * $product['tax_rate'] / 100);

                $subTotalPrice += $taxAddedPrice * $quantity;

                $totalShippingCost += $product['shipping_cost'] * $quantity;

                $output .=
                "
                    <div class='shopping_cart_product_item'>
                        <div class='shopping_cart_image_container'>
                            <img src='".$product['image_url']."' alt='' class='shopping_cart_product_image'>
                            <p class='shopping_cart_product_quantity'>{$quantity}</p>
                        </div>
                        <div class='shopping_cart_name_stock_container'>
                            <p class='shopping_cart_product_name'>{$product['name']}</p>
                            <p class='shopping_cart_product_stock'>In Stock : {$product['stock_quantity']}</p>
                        </div>
                        <p class='shopping_cart_product_price'>{$taxAddedPrice}$</p>
                    </div>
                ";
            }

            $totalPrice = $subTotalPrice + $totalShippingCost;

            $output .= 
            "
                </div>
                <div class='shopping_cart_spacer'></div>
                <div class='shopping_cart_subtotal_shipping_container'>
                    <div class='shopping_cart_subtotal_container'>
                        <p class='shopping_cart_subtotal_title'>Subtotal</p>
                        <p class='shopping_cart_subtotal_value'>{$subTotalPrice}$</p>
                    </div>
                    <div class='shopping_cart_shipping_container'>
                        <p class='shopping_cart_shipping_title'>Shipping</p>
                        <p class='shopping_cart_shipping_value'>{$totalShippingCost}$</p>
                    </div>
                </div>
                <div class='shopping_cart_spacer'></div>
                <div class='shopping_cart_total_price_container'>
                    <p class='shopping_cart_total_title'>Total</p>
                    <div class='shopping_cart_currency_price_container'>
                        <p class='shopping_cart_currency_title'>USD</p>
                        <p class='shopping_cart_total_price_value'>{$totalPrice}$</p>
                    </div>
                </div>
                <p class='shopping_cart_place_order_button'>Preview Shipping Cart</p>
            ";

            echo $output;
            
            //Refresh page in JS success .then()
        }
    }
?>