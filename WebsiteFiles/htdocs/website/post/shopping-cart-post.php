<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        require_once('./../../utilities.php');

        if(isset($_POST["get_shopping_cart_items_data_modal"]) && $_POST["get_shopping_cart_items_data_modal"])
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
            //Format with two zeros after comma
            $subTotalPrice = number_format((float)$subTotalPrice, 2, '.', '');
            $totalPrice = number_format((float)$totalPrice, 2, '.', '');
            $totalShippingCost = number_format((float)$totalShippingCost, 2, '.', '');

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

            //Fill page with content in js ajax .then()
            echo $output;
        }
        else if(isset($_POST["get_shopping_cart_items_data"]) && $_POST["get_shopping_cart_items_data"])
        {
            $productIds = $_POST['productids'];
            $productQuantities = $_POST['quantities'];

            $idsArray = explode(":", $productIds);
            $quantitiesArray = explode(":", $productQuantities);


            $output = 
            "
            <main>
                <div class='preview_order_main_container'>
                    <div class='top_design_container'>
                        <div class='top_design_left_side'>
                            <div class='top_left_design_bar'></div>
                        </div>
                        <div class='top_design_right_side'>
                        </div>
                    </div>
                    <div class='products_table_titles_container'>
                        <div class='products_product_titles_container'>
                            <p class='product_title'>PRODUCT</p>
                        </div>
                        <div class='product_price_quantity_total_titles_container'>
                            <div class='product_price_quantity_total_titles_container_content'>
                                <p class='product_price_title'>PRICE</p>
                                <p class='product_quantity_title'>QTY</p>
                                <p class='product_total_title'>TOTAL</p>
                            </div>
                        </div>
                    </div>
                    <div class='products_items_content_container'>
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

                $quantityMultipliedPrice = $quantity * $taxAddedPrice;

                $output .=
                "
                <div class='product_item' data-id='{$productId}' data-shippingcost='{$product['shipping_cost']}'>
                    <div class='product_item_left_side'>
                        <img src='{$product['image_url']}' alt='product_plant_image' class='product_item_image'>
                        <div class='product_item_name_stock_container'>
                            <p class='product_item_name'>{$product['name']}</p>
                            <p class='product_item_stock'>In Stock : {$product['stock_quantity']}</p>
                        </div>
                    </div>
                    <div class='product_item_right_side'>
                        <div class='product_item_right_side_content'>
                            <p class='product_item_unit_price'>$ {$taxAddedPrice}</p>
                            <div class='quantity_modifier_container'>
                                <p class='quantity_remove_button' data-id='{$productId}'>-</p>
                                <input type='number' class='product_item_quantity_input' value='{$quantity}' min='0' max='100'>
                                <p class='quantity_add_button' data-id='{$productId}'>+</p>
                            </div>
                            <p class='product_item_total_price' data-price='{$taxAddedPrice}'>$ {$quantityMultipliedPrice}</p>
                            <i class='product_delete_button fal fa-times' data-id='{$productId}'></i>
                        </div>
                    </div>
                </div>
                ";
            }

            $totalPrice = $subTotalPrice + $totalShippingCost;


            //Format with two zeros after comma
            $subTotalPrice = number_format((float)$subTotalPrice, 2, '.', '');
            $totalPrice = number_format((float)$totalPrice, 2, '.', '');
            $totalShippingCost = number_format((float)$totalShippingCost, 2, '.', '');

            $output .= 
            "
                    </div>
                    <div class='before_footer_spacer'>
                        <div class='before_footer_spacer_left'></div>
                        <div class='before_footer_spacer_right'></div>
                    </div>
                    <div class='bottom_design_container'>
                        <div class='bottom_design_left_side'></div>
                        <div class='bottom_design_right_side'>
                            <div class='bottom_left_design_bar'></div>
                        </div>
                    </div>
                </div>
            </main>
            <footer>
                <div class='subtotal_checkout_footer_container'>
                    <i class='subtotal_back_button far fa-long-arrow-left'></i>
                    <div class='subtotal_checkout_terms_container'>
                        <div class='subtotal_price_container'>
                            <p class='subtotal_title'>SUBTOTAL</p>
                            <p class='subtotal_value'>$ {$subTotalPrice}</p>
                        </div>
                        <div class='shipping_price_container'>
                            <p class='shipping_title'>SHIPPING</p>
                            <p class='shipping_value'>$ {$totalShippingCost}</p>
                        </div>
                        <div class='total_price_container'>
                            <p class='total_title'>TOTAL</p>
                            <p class='total_value'>$ {$totalPrice}</p>
                        </div>
                        <div class='terms_and_conditions_container'>
                            <label class='terms_and_condition_checkbox_container'>
                                <input class='terms_and_condition_checkbox' type='checkbox' name=''>
                                <span class='terms_and_condition_checkmark'></span>
                            </label>
                            <p class='terms_agreement_text'>I agree to <a class='therms_and_condition_link'>Terms & Conditions</a></p>
                        </div>
                        <p class='order_checkout_button'>CHECKOUT</p>
                    </div>
                </div>
            </footer>
            ";

            //Fill page with content in js ajax .then()
            echo $output;
        }
    }
?>